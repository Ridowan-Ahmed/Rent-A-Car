<?php

namespace App\Http\Controllers;

use App\Car;
use App\Http\Requests\LogRequest;
use App\Logbook;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LogbookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LogRequest $request)
    {
        $input = $request->except('registration_num');
        $car = Car::whereRegistrationNum($request->registration_num)->first();
        $car->logbooks()->create($input);
        $request->session()->flash('msg', 'New Log Added');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param $registration_num
     * @return \Illuminate\Http\Response
     */
    public function show($registration_num)
    {
        session(['url' => request()->path()]);
        $car = Car::whereRegistrationNum($registration_num)->get()->first();
        return view('logbook.show', [
            'car' => $car,
            'logbooks' =>$car->logOfThisMonth()->sortBy('log_date')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('logbook.edit', [
            'logbook' => Logbook::findOrFail($id)
        ]);
    }

    public function editLog($registration_num, $id)
    {
        return view('logbook.edit', [
            'registration_num' => $registration_num,
            'logbook' => Logbook::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param LogRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(LogRequest $request, $id)
    {
        $input = $request->except('registration_num');
        $logbook = Logbook::findOrFail($id);
        Session::flash('msg', 'Log updated');
        $logbook->update($input);
        return redirect('/logbook/'. $request->registration_num);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $logbook = Logbook::findOrFail($id);
        Session::flash('msg', 'Log deleted');
        $logbook->delete();
        return redirect(Session('url'));
    }

    public function showPast($registration_num)
    {
        $car = Car::whereRegistrationNum($registration_num)->get()->first();
        return view('logbook.show_past', [
            'car' => $car,
            'logbooks' =>$car->logOfPastMonth()->sortBy('log_date')
        ]);
    }

    public function showPastTwo($registration_num)
    {
        $car = Car::whereRegistrationNum($registration_num)->get()->first();
        return view('logbook.show_past', [
            'car' => $car,
            'logbooks' =>$car->logOfPastTwoMonth()->sortBy('log_date')
        ]);
    }

    public function import(Request $request)
    {
        $car_id = Car::whereRegistrationNum($request->registration_num)->first()->id;
        //validate the xls file
        $this->validate($request, array(
            'excel_file'      => 'required'
        ));

        if($request->hasFile('excel_file')){
            $extension = File::extension($request->excel_file->getClientOriginalName());
            if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {
                $path = $request->excel_file->getRealPath();
                $data = Excel::load($path, function($reader) {
                })->get();
                if(!empty($data) && $data->count()){
                    foreach ($data as $key => $value) {
                        $insert[] = [
                            'car_id' => $car_id,
                            'log_date' => (new Carbon($value->log_date))->toDateString(),
                            'octane_starting_km' => $value->octane_starting_km,
                            'octane_ending_km' => $value->octane_ending_km,
                            'diesel_starting_km' => $value->diesel_starting_km,
                            'diesel_ending_km' => $value->diesel_ending_km,
                            'cng_starting_km' => $value->cng_starting_km,
                            'cng_ending_km' => $value->cng_ending_km,
                            'starting_time' => $value->starting_time->toTimeString(),
                            'ending_time' => $value->ending_time->toTimeString(),
                            'payment_amount' => $value->payment_amount,
                            'payment_type' => $value->payment_type,
                            'payment_reason' => $value->payment_reason,
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s'),
                        ];
                    }
                    if(!empty($insert)){
                        $insertData = DB::table('logbooks')->insert($insert);
//                        $insertData = $car->logbooks()->create($insert);
                        if ($insertData) {
                            Session::flash('msg', 'Your Data has successfully imported');
                        }else {
                            Session::flash('msg', 'Error inserting the data..');
                            return back();
                        }
                    }
                }
                return back();
            }else {
                Session::flash('msg', 'File is a '.$extension.' file.!! Please upload a valid xls/csv file..!!');
                return back();
            }
        }
    }

    public function bill()
    {
        return view('logbook.bill', [
            'companies' => Auth::user()->companies
        ]);
    }

    public function payment()
    {
        return view('logbook.payment', [
            'owners' => Auth::user()->owners
        ]);
    }

}
