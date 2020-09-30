@extends('layouts.main')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/owner">Owner</a></li>
                    <li class="breadcrumb-item"><a
                                href="{{route('owner.show', $car->owner->slug)}}">{{$car->owner->name}}</a></li>
                    <li class="breadcrumb-item"><a
                                href="{{route('logbook.show', $car->registration_num)}}">{{$car->registration_num}}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Daily Log</li>
                </ol>
            </nav>
        </ol>
    </nav>
    <div id="carLog" class="">
        <h1 class="display-5" id="logIndex">
            <i class="fa fa-taxi"></i> {{$car->registration_num}} <span
                    class="badge badge-primary badge-pill">{{$car->car_brand}}</span>
            <span class="mr-2" data-toggle='tooltip' data-placement='top' title='Add New Log'>
                <button class="btn btn-outline-secondary" data-toggle="modal" data-target="#logCreateModal">
                    <i class="fa fa-plus-circle"></i> Add Log
                </button>
            </span> Or
            <span class="h5 ml-2" data-toggle='tooltip' data-placement='top' title='Add Excel Log'>
                {!! Form::open(['method'=>'POST', 'action'=>'LogbookController@import', 'files'=>true]) !!}
                {!! Form::hidden('registration_num', $car->registration_num) !!}
                {!! Form::file('excel_file', null, ['class'=>'mr-0']) !!}
                {!! Form::submit('Submit', ['class'=>'btn btn-sm btn-outline-primary']) !!}
                {!! Form::close() !!}
            </span>

        </h1>
        <div class="media mb-3">
            <img class="align-self-end mr-3 d-none d-sm-block wow wobble" src="{{$car->photoSrc()}}"
                 alt="owner image" width="20%">
            <div class="media-body">
                <h3 class="mt-0"><span class="small">Driver</span> {{$car->driver_name}}</h3>
                <p>Lives at <span class="font-weight-bold">{{$car->driver_address}}</span></p>
                <p>Contract Number <span class="font-weight-bold">{{$car->driver_phone_num}}</span></p>
                <p>National Id <span class="font-weight-bold">{{$car->driver_nid}} </span></p>
                <p>{{$car->remarks}}</p>
                <p class="mb-0">
                    <a href="{{route('car.report', $car->registration_num)}}" class="btn btn-outline-primary"
                       class="btn btn-outline-primary"
                       data-toggle="tooltip" data-placement="top" title="Full report of {{$car->registration_num}}"><i
                                class="fa fa-book"></i>Full Report</a>
                </p>
            </div>
        </div>
        <p>
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#expiaryInfo"
                    aria-expanded="false" aria-controls="expiaryInfo">
                Expiry Date
            </button>
        </p>
        <div class="collapse" id="expiryInfo">
            <div class="card card-body">
                Tax Token will expire {{$car->tax_token_expiry_date->diffForHumans()}}<br>
                Fitness will expire {{$car->fitness_expiry_date->diffForHumans()}}<br>
                Insurance will expire {{$car->insurance_expiry_date->diffForHumans()}}<br>
                Road Permit will expire {{$car->road_permit_expiry_date->diffForHumans()}}<br>
            </div>
        </div>

    </div>
    <section id="showLog">
        @include('includes.form_errors')
        <div id="logControl" class="text-center my-2">
            <a href="{{route('logbook.showPastTwo', $car->registration_num)}}" class="btn btn-outline-primary">Past Two
                Month</a>
            <a href="{{route('logbook.showPast', $car->registration_num)}}" class="btn btn-outline-success">Past
                Month</a>
            <a href="{{route('logbook.show', $car->registration_num)}}" class="btn btn-outline-secondary">This Month</a>
        </div>
        @if(count($logbooks) > 0)
            <table class="table table-responsive-sm table-bordered table-hover table-stripped">
                <thead class="thead-dark">
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
                        <td>
                            <a class="font-weight-bold" href="{{route('logbook.edit',$logbook->id)}}"
                               data-toggle="tooltip" data-html="true" data-placement="top"
                               title="<i class='fa fa-pencil'></i> Edit Log">
                                {{$date->toFormattedDateString()}}
                            </a>
                        </td>
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
    </section>
    <div class="modal fade" id="logCreateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg modal-notify modal-warning" role="document">
            <div class="modal-content">
                <!--Header-->
                <div class="modal-header text-center">
                    <h4 class="modal-title white-text w-100 font-weight-bold py-2">Daily Log</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="white-text">&times;</span>
                    </button>
                </div>
                <!--Body-->
                <div class="modal-body">
                    {!! Form::open(['method'=>'POST', 'action'=>'LogbookController@store']) !!}
                    {!! Form::hidden('registration_num', $car->registration_num) !!}
                    <div class="form-row">
                        <div class="form-group col-sm-6">
                            {!! Form::label('log_date', 'Date', ['class'=>'font-weight-bold']) !!}
                            {!! Form::date('log_date', \Carbon\Carbon::now(),['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group col-sm-6">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-6">
                            {!! Form::label('octane_starting_km', 'Octane Starting Kilometer', ['class'=>'font-weight-bold']) !!}
                            {!! Form::number('octane_starting_km', null, ['class'=>'form-control', 'min'=>'0']) !!}
                        </div>
                        <div class="form-group col-sm-6">
                            {!! Form::label('octane_ending_km', 'Octane Ending Kilometer', ['class'=>'font-weight-bold']) !!}
                            {!! Form::number('octane_ending_km', null, ['class'=>'form-control', 'min'=>'0']) !!}
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-6">
                            {!! Form::label('diesel_starting_km', 'Diesel Starting Kilometer', ['class'=>'font-weight-bold']) !!}
                            {!! Form::number('diesel_starting_km', null, ['class'=>'form-control', 'min'=>'0']) !!}
                        </div>
                        <div class="form-group col-sm-6">
                            {!! Form::label('diesel_ending_km', 'Diesel Ending Kilometer', ['class'=>'font-weight-bold']) !!}
                            {!! Form::number('diesel_ending_km', null, ['class'=>'form-control', 'min'=>'0']) !!}
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-6">
                            {!! Form::label('cng_starting_km', 'CNG Starting Kilometer', ['class'=>'font-weight-bold']) !!}
                            {!! Form::number('cng_starting_km', null, ['class'=>'form-control', 'min'=>'0']) !!}
                        </div>
                        <div class="form-group col-sm-6">
                            {!! Form::label('cng_ending_km', 'CNG Ending Kilometer', ['class'=>'font-weight-bold']) !!}
                            {!! Form::number('cng_ending_km', null, ['class'=>'form-control', 'min'=>'0']) !!}
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm">
                            {!! Form::label('starting_time', 'Staring Time', ['class'=>'font-weight-bold']) !!}
                            {!! Form::time('starting_time', Carbon\Carbon::now()->format('H:i'), ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group col-sm">
                            {!! Form::label('ending_time', 'Ending Time', ['class'=>'font-weight-bold']) !!}
                            {!! Form::time('ending_time', \Carbon\Carbon::now()->format('H:i'),['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-6">
                            {!! Form::label('payment_amount', 'Payment Amount', ['class'=>'font-weight-bold']) !!}
                            {!! Form::number('payment_amount', null, ['placeholder'=>'Taka give today', 'class'=>'form-control', 'min'=>'0']) !!}
                        </div>
                        <div class="form-group col-sm-6">
                            {!! Form::label('payment_type', 'Payment Type', ['class'=>'font-weight-bold']) !!}
                            {!! Form::select('payment_type', [null=>'Select A Type','Cash' => 'Cash', 'Bkash' => 'Bkash', 'Check' => 'Check'], null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('payment_reason', 'Payment Reason', ['class'=>'font-weight-bold']) !!}
                        {!! Form::text('payment_reason', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <!--Footer-->
                <div class="modal-footer justify-content-center">
                    {!! Form::button('Submit <i class="fa fa-paper-plane-o ml-"></i>', ['type' => 'submit', 'class' => 'btn btn-outline-secondary waves-effect font-weight-bold']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>

    </div>
@stop

@section('script')
@stop