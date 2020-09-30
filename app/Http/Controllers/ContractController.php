<?php

namespace App\Http\Controllers;

use App\Company;
use App\Owner;
use App\Car;
use App\Contract;
use App\Http\Requests\ContractRequest;
use Illuminate\Support\Facades\Session;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
    public function store(ContractRequest $request)
    {
        $input = $request->except(['id', 'role']);

        if($request->role === 'App\Company') {
            $company = Company::findOrFail($request->id);
            $company->contract()->create($input);
        } else {
            $owner = Owner::findOrFail($request->id);
            $owner->contract()->create($input);
        }
        $request->session()->flash('msg', 'Contract added ');
        return redirect(Session('contract_url'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($registration_num)
    {
        $car = Car::whereRegistrationNum($registration_num)->get()->first();
        $company = Company::findOrFail($car->company_id);
        $company_contract = $company->contract;
        $owner = Owner::findOrFail($car->owner_id);
        $owner_contract = $owner->contract;
        return view('contract.show', compact('car','company','company_contract','owner','owner_contract'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContractRequest $request, $id)
    {
        $input = $request->except('role');
        $contract = Contract::findOrFail($id);
        Session::flash('msg', 'Contract Updated');
        $contract->update($input);
        return redirect(Session('contract_url'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contract = Contract::findOrFail($id);
        Session::flash('msg', 'Contract deleted');
        $contract->delete();
        return redirect(Session('contract_url'));
    }
}
