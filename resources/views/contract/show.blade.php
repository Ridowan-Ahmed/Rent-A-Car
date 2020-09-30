@extends('layouts.main')
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/car">Car</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{$car->registration_num}}</li>
    </ol>
</nav>
<div class="container img-thumbanil">
    <div class="row">
        <div class="col">
            @if($company_contract && $owner_contract)
            <table class="table table-striped table-hover">
                <caption>List car cost</caption>
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{$company->name}}</th>
                    <th scope="col">{{$owner->name}}</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">Octane Cost</th>
                    <td>{{$company_contract->octane_cost}}</td>
                    <td>{{$owner_contract->octane_cost}}</td>
                </tr>
                <tr>
                    <th scope="row">Diesel Cost</th>
                    <td>{{$company_contract->diesel_cost}}</td>
                    <td>{{$owner_contract->diesel_cost}}</td>
                </tr>
                <tr>
                    <th scope="row">Cng Cost</th>
                    <td>{{$company_contract->cng_cost}}</td>
                    <td>{{$owner_contract->cng_cost}}</td>
                </tr>
                <tr>
                    <th scope="row">Parking Mode</th>
                    <td>{{$company_contract->parking_mode}}</td>
                    <td>{{$owner_contract->parking_mode}}</td>
                </tr>
                <tr>
                    <th scope="row">Car Rent</th>
                    <td>{{$company_contract->car_rent}}</td>
                    <td>{{$owner_contract->car_rent}}</td>
                </tr>
                <tr>
                    <th scope="row">Driver Salary</th>
                    <td>{{$company_contract->driver_salary}}</td>
                    <td>{{$owner_contract->driver_salary}}</td>
                </tr>
                <tr>
                    <th scope="row">Overtime Cost</th>
                    <td>{{$company_contract->overtime_cost}}</td>
                    <td>{{$owner_contract->overtime_cost}}</td>
                </tr>
                <tr>
                    <th scope="row">Breakfast Cost</th>
                    <td>{{$company_contract->breakfast_cost}}</td>
                    <td>{{$owner_contract->breakfast_cost}}</td>
                </tr>
                <tr>
                    <th scope="row">Launch Cost</th>
                    <td>{{$company_contract->launch_cost}}</td>
                    <td>{{$owner_contract->launch_cost}}</td>
                </tr>
                <tr>
                    <th scope="row">Dinner Cost</th>
                    <td>{{$company_contract->dinner_cost}}</td>
                    <td>{{$owner_contract->dinner_cost}}</td>
                </tr>
                <tr>
                    <th scope="row">Contract Type</th>
                    <td>{{$company_contract->contract_type}}</td>
                    <td>{{$owner_contract->contract_type}}</td>
                </tr>
                <tr>
                    <th scope="row">Contract Duration</th>
                    <td>{{$company_contract->contract_duration}}</td>
                    <td>{{$owner_contract->contract_duration}}</td>
                </tr>
                <tr>
                    <th scope="row">Remarks</th>
                    <td>{{$company_contract->remarks}}</td>
                    <td>{{$owner_contract->remarks}}</td>
                </tr>

                </tbody>
            </table>
            @else
            <p>No Contract added yet</p>
            @endif
        </div>
    </div>
</div>
@stop

@section('script')
@stop