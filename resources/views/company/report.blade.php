@extends('layouts.main')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/company">Company</a></li>
            <li class="breadcrumb-item"><a href="{{route('company.show', $company->slug)}}">{{$company->name}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Full Report</li>
        </ol>
    </nav>
    <div id="ownerReport dark-overlay">
        <table class="table table-sm table-responsive-sm table-bordered table-hover table-stripped">
            <thead class="table-dark">
            <tr>
                <th>Car</th>
                <th>Total</th>
            </tr>
            </thead>
            <tbody>
            @php
                $total_due = 0;
            @endphp
            @foreach($reports as $report)
                <tr>
                    <td><a href="{{route('car.report', $report->registration_num)}}">{{$report->registration_num}}</a></td>
                    @php
                        $car = App\Car::whereRegistrationNum($report->registration_num)->first();
                        $contract_company =  $car->company->contract->where('brand_id',$car->brand->id)->first();
                    @endphp
                    @if($contract_company)
                        @php
                            $total = $report->octane_km*$contract_company->octane_cost;
                            $total += $report->diesel_km*$contract_company->diesel_cost;
                            $total += $report->cng_km*$contract_company->cng_cost;
                            $total += $contract_company->starting_octane*$contract_company->octane_cost;
                            $total += $report->overtime_hour*$contract_company->overtime_cost;
                            $total += $report->cnt*$contract_company->breakfast_cost;
                            $total += $report->cnt*$contract_company->launch_cost;
                            $total += $report->cnt*$contract_company->dinner_cost;
                            $total += $contract_company->car_rent;
                            $total_due += $total;
                        @endphp
                        <td class="text-right">{{$total}} &#x9f3;</td>
                    @else
                        <td colspan="3" class="bg-warning text-center">No Contract</td>
                    @endif
                </tr>
            @endforeach
            <tr class="font-weight-bold">
                <td class="text-right">Total Due</td>
                <td class="bg-success text-right">{{$total_due}} &#x9f3;</td>
            </tr>
            </tbody>
        </table>
    </div>
@stop

@section('script')
@stop