@extends('layouts.main')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/owner">Owner</a></li>
                    <li class="breadcrumb-item"><a href="{{route('owner.show', $car->owner->slug)}}">{{$car->owner->name}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Daily Log</li>
                </ol>
            </nav>
        </ol>
    </nav>
    <div id="carLog" class="">
        <h1 class="display-5" id="logIndex">
            <i class="fa fa-taxi"></i> {{$car->registration_num}} <span class="badge badge-primary badge-pill">{{$car->car_brand}}</span>
        </h1>
        <div id="logControl" class="text-center my-2">
            <a href="{{route('logbook.showPastTwo', $car->registration_num)}}" class="btn btn-outline-primary">Past Two Month</a>
            <a href="{{route('logbook.showPast', $car->registration_num)}}" class="btn btn-outline-success">Past Month</a>
            <a href="{{route('logbook.show', $car->registration_num)}}" class="btn btn-outline-secondary">This Month</a>
        </div>
        @if(count($logbooks) > 0)
        <table class="table table-danger table-responsive-sm table-bordered table-hover table-stripped">
            <thead class="">
            <tr>
                <th>Date</th>
                <th>Total Run</th>
                <th>Starting Time</th>
                <th>Ending Time</th>
                <th>Working</th>
                <th>Overtime</th>
                <th>Payment Reason</th>
                <th>Payment Type</th>
                <th>Amount</th>
            </tr>
            </thead>
            <tbody class="wow fadeInDownBig">
                @foreach($logbooks as $logbook)
                    <tr>
                        @php
                            $date = new \Carbon\Carbon($logbook->log_date);
                            $start = new \Carbon\Carbon($logbook->starting_time);
                            $end = new \Carbon\Carbon($logbook->ending_time);
                            $working_time = $end->diffInHours($start);
                            $total_run = $logbook->octane_ending_km-$logbook->octane_starting_km;
                            $total_run += $logbook->diesel_ending_km-$logbook->diesel_starting_km;
                            $total_run += $logbook->cng_ending_km-$logbook->cng_starting_km;
                        @endphp
                        <td>{{$date->toFormattedDateString()}}</td>
                        <td>{{$total_run}} KM</td>
                        <td>{{$start->format('h:i A')}}</td>
                        <td>{{$end->format('h:i A')}}</td>
                        <td>{{$working_time}} h</td>
                        <td>
                            @if($working_time === $car->driver_duty)
                                <h5><span class="badge badge-primary badge-pill"><i class="fa fa-check-circle-o"></i> OK</span>
                                </h5>
                            @elseif($working_time > $car->driver_duty)
                                <h5><span class="badge badge-danger badge-pill"><i
                                                class="fa fa-check-circle-o"></i> {{$working_time - $car->driver_duty}}
                                        h</span></h5>
                            @else
                                {{$car->driver_duty - $working_time}} h less
                            @endif
                        </td>
                        <td>{{$logbook->payment_reason}}</td>
                        <td>{{$logbook->payment_type}}</td>
                        <td>{{$logbook->payment_amount}}</td>
                    </tr>
                @endforeach
            @else
                <p>No Entry yet</p>
            @endif
            </tbody>
        </table>
    </div>
@stop

@section('script')
@stop