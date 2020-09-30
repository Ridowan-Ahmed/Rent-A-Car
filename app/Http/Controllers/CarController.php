<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Car;
use App\Company;
use App\Owner;
use App\Photo;
use Carbon\Carbon;
use App\Http\Requests\CarRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('car.index', [
            'cars' => Auth::user()->cars
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
//        return view('car.create', [
//            'owners' => Auth::user()->owners()->pluck('name', 'id'),
//            'companies' => Auth::user()->companies()->pluck('name', 'id'),
//        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CarRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CarRequest $request)
    {
        $input = $this->formInput($request);
        $owner = Owner::findBySlugOrFail($request->slug);
        $owner->car()->create($input);
        $request->session()->flash('msg', $request->registration_num . ' car added');
        return redirect(Session('owner_url'));
    }

    /**
     * Display the specified resource.
     *
     * @param $registration_num
     * @return \Illuminate\Http\Response
     */
    public function show($registration_num)
    {
        return view('car.show', [
            'car' => Car::whereRegistrationNum($registration_num)->first()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $registration_num
     * @return \Illuminate\Http\Response
     */
    public function edit($registration_num)
    {
        return view('car.edit', [
            'brand' => Brand::all()->pluck('name', 'id'),
            'companies' => Auth::user()->companies()->pluck('name', 'id'),
            'car' => Car::whereRegistrationNum($registration_num)->first()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CarRequest $request
     * @param $registration_num
     * @return \Illuminate\Http\Response
     */
    public function update(CarRequest $request, $registration_num)
    {
        $input = $this->formInput($request);
        $car = Car::whereregistrationNum($registration_num)->get()->first();
        Session::flash('msg', $car->registration_num . " updated");
        $car->update($input);
        return redirect(Session('owner_url'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $registration_num
     * @return \Illuminate\Http\Response
     */
    public function destroy($registration_num)
    {
        $car = Car::whereRegistrationNum($registration_num)->get()->first();
        Session::flash('msg', $car->registration_num . ' deleted');
        $car->delete();
        return redirect(Session('owner_url'));
    }

    public function formInput($request)
    {
        $input = $request->except('slug');

        if ($photoFile = $request->file('photo_id')) {
            $photoName = time() . " " . $photoFile->getClientOriginalName();
            $photoFile->move('images', $photoName);

            $photo = Photo::create(['photo_path'=> $photoName]);
            $input['photo_id'] = $photo->id;
        }
        return $input;
    }

    public function calculateReport($car){
        $logbooks = $car->logOfThisMonth();
        $report = (object) [
            'registration_num' => $car->registration_num,
            'cnt' => count($logbooks),
            'octane_km' => 0,
            'diesel_km' => 0,
            'cng_km' => 0,
            'overtime_hour' => 0,
            'breakfast' => 0,
            'launch' => 0,
            'dinner' => 0,
            'daily_payment' => 0,
        ];
        foreach ($logbooks as $log){
            $start = new Carbon($log->starting_time);
            $end = new Carbon($log->ending_time);
            $working_time = $end->diffInHours($start);
            $overtime = $working_time - $car->driver_duty;
            $report->overtime_hour += $overtime > 0 ? $overtime : 0;
            $report->octane_km += $log->octane_ending_km - $log->octane_starting_km;
            $report->diesel_km += $log->diesel_ending_km - $log->diesel_starting_km;
            $report->cng_km += $log->cng_ending_km - $log->cng_starting_km;
            $report->daily_payment += $log->payment_amount;
        }

        return $report;
    }

    public function report($registration_num)
    {
        $car = Car::whereRegistrationNum($registration_num)->first();
        $report = $this->calculateReport($car);
        return view('car.report', [
            'car' => $car,
            'report' => $report
        ]);
    }

    public function ownerReport($slug) {
        $owner = Owner::findBySlugOrFail($slug);
        $cars = $owner->car->all();
        $reports = collect();
        foreach ($cars as $car){
            $reports[] = $this->calculateReport($car);
        }
        return view('owner.report', [
            'owner' => $owner,
            'reports' => $reports
        ]);
    }

    public function companyReport($slug) {
        $company = Company::findBySlugOrFail($slug);
        $cars = $company->car->all();
        $reports = collect();
        foreach ($cars as $car){
            $reports[] = $this->calculateReport($car);
        }
        return view('company.report', [
            'company' => $company,
            'reports' => $reports
        ]);
    }
}
