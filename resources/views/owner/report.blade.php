@extends('layouts.main')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/owner">Owner</a></li>
            <li class="breadcrumb-item"><a href="{{route('owner.show', $owner->slug)}}">{{$owner->name}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Full Report</li>
        </ol>
    </nav>
    <div id="ownerReport dark-overlay">
        <table class="table table-sm table-responsive-sm table-bordered table-hover table-stripped">
            <thead class="table-dark">
            <tr>
                <th>Car</th>
                <th>Total</th>
                <th>Advance</th>
                <th>Due</th>
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
                        $contract_owner =  $car->owner->contract->where('brand_id',$car->brand->id)->first();
                    @endphp
                    @if($contract_owner)
                        @php
                            $total = $report->octane_km*$contract_owner->octane_cost;
                            $total += $report->diesel_km*$contract_owner->diesel_cost;
                            $total += $report->cng_km*$contract_owner->cng_cost;
                            $total += $contract_owner->starting_octane*$contract_owner->octane_cost;
                            $total += $report->overtime_hour*$contract_owner->overtime_cost;
                            $total += $report->cnt*$contract_owner->breakfast_cost;
                            $total += $report->cnt*$contract_owner->launch_cost;
                            $total += $report->cnt*$contract_owner->dinner_cost;
                            $total += $contract_owner->car_rent;
                            $due = $total-$report->daily_payment;
                            $total_due += $due;
                        @endphp
                        <td class="text-right">{{$total}} &#x9f3;</td>
                        <td class="text-right">{{$report->daily_payment}} &#x9f3;</td>
                        <td class="text-right">{{$due}} &#x9f3;</td>
                    @else
                        <td colspan="3" class="bg-warning text-center">No Contract</td>
                    @endif
                </tr>
            @endforeach
            <tr class="font-weight-bold">
                <td class="text-right" colspan="3">Total Due</td>
                <td class="bg-success text-right">{{$total_due}} &#x9f3;</td>
            </tr>
            </tbody>
        </table>
    </div>
@stop

@section('script')
@stop