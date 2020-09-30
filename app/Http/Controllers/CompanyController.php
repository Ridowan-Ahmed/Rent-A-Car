<?php

namespace App\Http\Controllers;

use App\Photo;
use App\Brand;
use App\Company;
use App\Contract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('company.index', [
            'companies' => Auth::user()->companies
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'address' => 'required',
            'phone_num' => 'required | numeric',
        ]);

        $input = $this->formInput($request);
        $user = Auth::user();
        $user->companies()->create($input);
        $request->session()->flash('msg', 'New Company added by ' . $user->name);
        return redirect('/company');
    }

    /**
     * Display the specified resource.
     *
     * @param $name
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        session(['company_url' => request()->path()]);
        session(['contract_url' => request()->path()]);
        return view('company.show', [
            'company' => Company::findBySlugOrFail($slug)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $name
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        return view('company.edit', [
            'company' => Company::findBySlugOrFail($slug)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $this->validate($request, [
            'name' => 'required',
            'address' => 'required',
            'phone_num' => 'required | numeric',
        ]);

        $input = $this->formInput($request);
        $company = Company::findBySlugOrFail($slug);
        Session::flash('msg', "Company " . $company->name . " updated");
        $company->update($input);
        return redirect(Session('company_url'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $name
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $company = Company::findBySlugOrFail($slug);
        Session::flash('msg', $company->name . ' deleted');
        if ($company->photo_id != 1) {
            unlink(public_path() . $company->photo->photo_path);
            $company->photo->delete();
        }
        $company->delete();
        return redirect(Session('company_url'));
    }

    public function formInput($request)
    {
        $input = $request->all();

        if ($photoFile = $request->file('photo_id')) {
            $photoName = time() . " " . $photoFile->getClientOriginalName();
            $photoFile->move('images', $photoName);

            $photo = Photo::create(['photo_path'=> $photoName]);
            $input['photo_id'] = $photo->id;
        }
        return $input;
    }

    public function contractCreate($slug)
    {
        return view('contract.create', [
            'vendor' => Company::findBySlugOrFail($slug),
            'brand' => Brand::all()->pluck('name','id')
        ]);
    }

    public function contractEdit($slug, $id)
    {
        return view('contract.edit', [
            'vendor' => Company::findBySlugOrFail($slug),
            'contract' => Contract::findOrFail($id),
            'brand' => Brand::all()->pluck('name','id')
        ]);
    }
}
