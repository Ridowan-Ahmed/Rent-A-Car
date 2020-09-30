@extends('layouts.main')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/owner">Owner</a></li>
                    <li class="breadcrumb-item"><a href="{{route('owner.show', $logbook->car->owner->slug)}}">{{$logbook->car->owner->name}}</a></li>
                    <li class="breadcrumb-item"><a href="{{route('logbook.show', $logbook->car->registration_num)}}">{{$logbook->car->registration_num}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Daily Log</li>
                </ol>
            </nav>
        </ol>
    </nav>
    <div id="carEditLog" class="">
        <h1 class="display-5" id="logIndex">
            <i class="fa fa-taxi"></i> {{$logbook->car->registration_num}}
            <span data-toggle='tooltip' data-placement='top' title= 'Add New Log'>
                <button class="btn btn-outline-secondary" data-toggle="modal" data-target="#logCreateModal">
                    <i class="fa fa-plus-circle"></i>
                </button>
            </span>
        </h1>
        {!! Form::model($logbook, ['method'=>'PATCH', 'action'=>['LogbookController@update', $logbook->id]]) !!}
        {!! Form::hidden('registration_num', $logbook->car->registration_num) !!}
        <div class="form-row">
            <div class="form-group col-sm-6">
                {!! Form::label('log_date', 'Date') !!}
                {!! Form::date('log_date', null,['class' => 'form-control']) !!}
                <span class="text-danger">{{$errors->first('log_date')}}</span>
            </div>
            <div class="form-group col-sm-6">

            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-sm-6">
                {!! Form::label('octane_starting_km', 'Octane Starting Kilometer', ['class'=>'font-weight-bold']) !!}
                {!! Form::number('octane_starting_km', null, ['class'=>'form-control', 'min'=>'0']) !!}
                <span class="text-danger">{{$errors->first('octane_starting_km')}}</span>
            </div>
            <div class="form-group col-sm-6">
                {!! Form::label('octane_ending_km', 'Octane Ending Kilometer', ['class'=>'font-weight-bold']) !!}
                {!! Form::number('octane_ending_km', null, ['class'=>'form-control', 'min'=>'0']) !!}
                <span class="text-danger">{{$errors->first('octane_ending_km')}}</span>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-sm-6">
                {!! Form::label('diesel_starting_km', 'Diesel Starting Kilometer', ['class'=>'font-weight-bold']) !!}
                {!! Form::number('diesel_starting_km', null, ['class'=>'form-control', 'min'=>'0']) !!}
                <span class="text-danger">{{$errors->first('diesel_starting_km')}}</span>
            </div>
            <div class="form-group col-sm-6">
                {!! Form::label('diesel_ending_km', 'Diesel Ending Kilometer', ['class'=>'font-weight-bold']) !!}
                {!! Form::number('diesel_ending_km', null, ['class'=>'form-control', 'min'=>'0']) !!}
                <span class="text-danger">{{$errors->first('diesel_ending_km')}}</span>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-sm-6">
                {!! Form::label('cng_starting_km', 'CNG Starting Kilometer', ['class'=>'font-weight-bold']) !!}
                {!! Form::number('cng_starting_km', null, ['class'=>'form-control', 'min'=>'0']) !!}
                <span class="text-danger">{{$errors->first('cng_starting_km')}}</span>
            </div>
            <div class="form-group col-sm-6">
                {!! Form::label('cng_ending_km', 'CNG Ending Kilometer', ['class'=>'font-weight-bold']) !!}
                {!! Form::number('cng_ending_km', null, ['class'=>'form-control', 'min'=>'0']) !!}
                <span class="text-danger">{{$errors->first('cng_ending_km')}}</span>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-sm-6">
                {!! Form::label('starting_time', 'Staring Time') !!}
                {!! Form::time('starting_time', null, ['class' => 'form-control']) !!}
                <span class="text-danger">{{$errors->first('starting_time')}}</span>
            </div>
            <div class="form-group col-sm-6">
                {!! Form::label('ending_time', 'Ending Time') !!}
                {!! Form::time('ending_time', null,['class' => 'form-control']) !!}
                <span class="text-danger">{{$errors->first('ending_time')}}</span>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-sm-6">
                {!! Form::label('payment_amount', 'Payment Amount') !!}
                {!! Form::number('payment_amount', null, ['class'=>'form-control', 'min'=>'0']) !!}
                <span class="text-danger">{{$errors->first('payment_amount')}}</span>
            </div>
            <div class="form-group col-sm-6">
                {!! Form::label('payment_type', 'Payment Type') !!}
                {!! Form::select('payment_type', [null=>'Select A Type','Cash' => 'Cash', 'Bkash' => 'Bkash', 'Check' => 'Check'], null, ['class' => 'form-control']) !!}
                <span class="text-danger">{{$errors->first('payment_type')}}</span>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('payment_reason', 'Payment Reason') !!}
            {!! Form::text('payment_reason', null, ['class' => 'form-control']) !!}
        </div>
        {!! Form::button('Update <i class="fa fa-paper-plane-o ml-"></i>', ['type' => 'submit', 'class' => 'btn btn-outline-success float-right mr-5']) !!}
    {!! Form::close() !!}
    {!! Form::open(['method'=>'DELETE', 'action'=>['LogbookController@destroy', $logbook->id]]) !!}
        {!! Form::button('<i class="fa fa-trash"></i> Delete', ['type'=>'submit','class'=>'btn btn-outline-danger float-right mr-5','data-toggle'=>'tooltip','data-placement'=>'top','title'=>'Delete Log'] ) !!}
    {!! Form::close() !!}
    </div>
@stop

@section('script')
@stop