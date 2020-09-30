@extends('layouts.main')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a href="/owner">Owner</a></li>
            <li class="breadcrumb-item"><a href="{{route('owner.show', $car->owner->slug)}}">{{$car->owner->name}}</a>
            </li>
            <li class="breadcrumb-item"><a
                        href="{{route('logbook.show', $car->registration_num)}}">{{$car->registration_num}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Report</li>
        </ol>
    </nav>
    <h1 class="display-5" id="logIndex">
        <i class="fa fa-taxi"></i> {{$car->registration_num}}
    </h1>
    <div id="accordion">
        <div class="card">
            <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                            aria-controls="collapseOne">
                        <span data-toggle="tooltip" data-html="true" data-placement="top"
                              title="<i class='fa fa-money'></i> Click here to view contract"><i
                                    class="fa fa-money"></i> Contract</span>
                    </button>
                </h5>
            </div>

            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                    @php
                        $contract_owner = $car->owner->contract->where('brand_id',$car->brand->id)->first();
                        $contract_company = $car->company->contract->where('brand_id',$car->brand->id)->first();
                    @endphp
                    @if($contract_owner === null)
                        <p>No Contract with {{$car->owner->name}}</p>
                    @elseif($contract_company === null)
                        <p>No Contract with {{$car->company->name}}</p>
                    @else
                        <table class="table table-sm table-responsive-sm table-bordered table-hover table-stripped">
                            <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>{{$car->company->name}}</th>
                                <th>{{$car->owner->name}}</th>
                                <th>Gain</th>
                            </tr>
                            </thead>
                            <tbody class="wow fadeInDownBig">
                            <tr>
                                <td>Octane Cost</td>
                                <td>{{$contract_company->octane_cost}} &#x9f3;</td>
                                <td>{{$contract_owner->octane_cost}} &#x9f3;</td>
                                <td>{{$contract_company->octane_cost-$contract_owner->octane_cost}} &#x9f3;</td>
                            </tr>
                            <tr>
                                <td>Diesel Cost</td>
                                <td>{{$contract_company->diesel_cost}} &#x9f3;</td>
                                <td>{{$contract_owner->diesel_cost}} &#x9f3;</td>
                                <td>{{$contract_company->diesel_cost-$contract_owner->diesel_cost}} &#x9f3;</td>
                            </tr>
                            <tr>
                                <td>CNG Cost</td>
                                <td>{{$contract_company->cng_cost}} &#x9f3;</td>
                                <td>{{$contract_owner->cng_cost}} &#x9f3;</td>
                                <td>{{$contract_company->cng_cost-$contract_owner->cng_cost}} &#x9f3;</td>
                            </tr>
                            <tr>
                                <td>Starting Octane</td>
                                <td>{{$contract_company->starting_octane}} litre</td>
                                <td>{{$contract_owner->starting_octane}} litre</td>
                                <td>{{$contract_company->starting_octane-$contract_owner->starting_octane}} litre</td>
                            </tr>
                            <tr>
                                <td>Car Cost</td>
                                <td>{{$contract_company->car_rent}} &#x9f3;</td>
                                <td>{{$contract_owner->car_rent}} &#x9f3;</td>
                                <td>{{$contract_company->car_rent-$contract_owner->car_rent}} &#x9f3;</td>
                            </tr>
                            <tr>
                                <td>Overtime Cost</td>
                                <td>{{$contract_company->overtime_cost}} &#x9f3;</td>
                                <td>{{$contract_owner->overtime_cost}} &#x9f3;</td>
                                <td>{{$contract_company->overtime_cost-$contract_owner->overtime_cost}} &#x9f3;</td>
                            </tr>
                            <tr>
                                <td>Breakfast Cost</td>
                                <td>{{$contract_company->breakfast_cost}} &#x9f3;</td>
                                <td>{{$contract_owner->breakfast_cost}} &#x9f3;</td>
                                <td>{{$contract_company->breakfast_cost-$contract_owner->breakfast_cost}} &#x9f3;</td>
                            </tr>
                            <tr>
                                <td>Launch Cost</td>
                                <td>{{$contract_company->launch_cost}} &#x9f3;</td>
                                <td>{{$contract_owner->launch_cost}} &#x9f3;</td>
                                <td>{{$contract_company->launch_cost-$contract_owner->launch_cost}} &#x9f3;</td>
                            </tr>
                            <tr>
                                <td>Dinner Cost</td>
                                <td>{{$contract_company->dinner_cost}} &#x9f3;</td>
                                <td>{{$contract_owner->dinner_cost}} &#x9f3;</td>
                                <td>{{$contract_company->dinner_cost-$contract_owner->dinner_cost}} &#x9f3;</td>
                            </tr>
                            <tr>
                                <td>Contract Type</td>
                                <td>{{$contract_company->contract_type}}</td>
                                <td>{{$contract_owner->contract_type}}</td>
                            </tr>
                            <tr>
                                <td>Contract Duration</td>
                                <td>{{$contract_company->contract_duration}}</td>
                                <td>{{$contract_owner->contract_duration}}</td>
                            </tr>
                            <tr>
                                <td>Remarks</td>
                                <td>{{$contract_company->remarks}}</td>
                                <td>{{$contract_owner->remarks}}</td>
                            </tr>
                            @endif
                            </tbody>
                        </table></div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingTwo">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo"
                            aria-expanded="false" aria-controls="collapseTwo">
                        <span data-toggle="tooltip" data-html="true" data-placement="top"
                              title="<i class='fa fa-google-wallet'></i> Click here to view Company Bill"><i
                                    class="fa fa-google-wallet"></i> Company Bill</span>
                    </button>
                </h5>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                <div class="card-body">
                    @if($contract_company === null)
                        <p>No Contract with {{$car->company->name}}</p>
                    @else
                        @php
                        $total = $report->octane_km*$contract_company->octane_cost;
                        $total += $report->diesel_km*$contract_company->diesel_cost;
                        $total += $report->cng_km*$contract_company->cng_cost;
                        $total += $contract_company->starting_octane*$contract_company->octane_cost;
                        $total += $report->overtime_hour*$contract_company->overtime_cost;
                        $total += $report->cnt*$contract_company->breakfast_cost;
                        $total += $report->cnt*$contract_company->launch_cost;
                        $total += $report->cnt*$contract_company->dinner_cost;
                        @endphp
                        <table class="table table-sm table-responsive-sm table-bordered table-hover table-stripped">
                            <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Items</th>
                                <th>Amount</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Octane</td>
                                <td>{{$report->octane_km}} KM</td>
                                <td>{{$report->octane_km*$contract_company->octane_cost}} &#x9f3;</td>
                            </tr>
                            <tr>
                                <td>Diesel</td>
                                <td>{{$report->diesel_km}} KM</td>
                                <td>{{$report->diesel_km*$contract_company->diesel_cost}} &#x9f3;</td>
                            </tr>
                            <tr>
                                <td>CNG</td>
                                <td>{{$report->cng_km}} KM</td>
                                <td>{{$report->cng_km*$contract_company->cng_cost}} &#x9f3;</td>
                            </tr>
                            <tr>
                                <td>Starting Octane</td>
                                <td>{{$contract_company->starting_octane}} litre</td>
                                <td>{{$contract_company->starting_octane*$contract_company->octane_cost}} &#x9f3;</td>
                            </tr>
                            <tr>
                                <td>Overtime</td>
                                <td>{{$report->overtime_hour}} hour</td>
                                <td>{{$report->overtime_hour*$contract_company->overtime_cost}} &#x9f3;</td>
                            </tr>
                            <tr>
                                <td>Breakfast</td>
                                <td>{{$report->cnt}} day</td>
                                <td>{{$report->cnt*$contract_company->breakfast_cost}} &#x9f3;</td>
                            </tr>
                            <tr>
                                <td>Launch</td>
                                <td>{{$report->cnt}} day</td>
                                <td>{{$report->cnt*$contract_company->launch_cost}} &#x9f3;</td>
                            </tr>
                            <tr>
                                <td>Dinner</td>
                                <td>{{$report->cnt}} day</td>
                                <td>{{$report->cnt*$contract_company->dinner_cost}} &#x9f3;</td>
                            </tr>
                            <tr>
                                <td class="text-sm-right">Total (with car rent)</td>
                                <td colspan="2" class="text-sm-left">{{$total + $contract_company->car_rent}} &#x9f3;</td>
                            </tr>
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingThree">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree"
                            aria-expanded="false" aria-controls="collapseThree">
                        <span data-toggle="tooltip" data-html="true" data-placement="top"
                              title="<i class='fa fa-dollar'></i> Click here to view Owner Payment"><i
                                    class="fa fa-dollar"></i> Owner Payment</span>
                    </button>
                </h5>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                <div class="card-body">
                    @if($contract_owner === null)
                        <p>No Contract with {{$car->owner->name}}</p>
                    @else
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
                        @endphp
                        <table class="table table-sm table-responsive-sm table-bordered table-hover table-stripped">
                            <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Items</th>
                                <th>Amount</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Octane</td>
                                <td>{{$report->octane_km}} KM</td>
                                <td>{{$report->octane_km*$contract_owner->octane_cost}} &#x9f3;</td>
                            </tr>
                            <tr>
                                <td>Diesel</td>
                                <td>{{$report->diesel_km}} KM</td>
                                <td>{{$report->diesel_km*$contract_owner->diesel_cost}} &#x9f3;</td>
                            </tr>
                            <tr>
                                <td>CNG</td>
                                <td>{{$report->cng_km}} KM</td>
                                <td>{{$report->cng_km*$contract_owner->cng_cost}} &#x9f3;</td>
                            </tr>
                            <tr>
                                <td>Starting Octane</td>
                                <td>{{$contract_owner->starting_octane}} litre</td>
                                <td>{{$contract_owner->starting_octane*$contract_owner->octane_cost}} &#x9f3;</td>
                            </tr>
                            <tr>
                                <td>Overtime</td>
                                <td>{{$report->overtime_hour}} hour</td>
                                <td>{{$report->overtime_hour*$contract_owner->overtime_cost}} &#x9f3;</td>
                            </tr>
                            <tr>
                                <td>Breakfast</td>
                                <td>{{$report->cnt}} day</td>
                                <td>{{$report->cnt*$contract_owner->breakfast_cost}} &#x9f3;</td>

                            <tr>
                                <td>Launch</td>
                                <td>{{$report->cnt}} day</td>
                                <td>{{$report->cnt*$contract_owner->launch_cost}} &#x9f3;</td>
                            </tr>
                            <tr>
                                <td>Dinner</td>
                                <td>{{$report->cnt}} day</td>
                                <td>{{$report->cnt*$contract_owner->dinner_cost}} &#x9f3;</td>
                            </tr>
                            <tr>
                                <td class="text-sm-right">Total (with car rent)</td>
                                <td colspan="2" class="text-sm-left">{{$total}} &#x9f3;</td>
                            </tr>
                            <tr>
                                <td class="text-sm-right">Advance</td>
                                <td colspan="2" class="text-sm-left">{{$report->daily_payment}} &#x9f3;</td>
                            </tr>
                            <tr>
                                <td class="text-sm-right">Owe</td>
                                <td colspan="2" class="text-sm-left">{{$total-$report->daily_payment}} &#x9f3;</td>
                            </tr>
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
@stop