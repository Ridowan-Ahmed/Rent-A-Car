@extends('layouts.main')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/car">Car</a></li>
            <li class="breadcrumb-item"><a href="{{route('owner.show', $owner->slug)}}">{{$owner->name}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create</li>
        </ol>
    </nav>
    <h1 class="display-5"><i class="fa fa-truck"></i> Add a Car</h1>
    <div class="container img-thumbnail">
    {!! Form::open(['method'=>'POST', 'action'=>'CarController@store', 'files'=>true]) !!}
        {!! Form::hidden('slug', $owner->slug) !!}
        <div class="from-group row mb-3">
            <div class="col-sm-6">
                <div class="form-row">
                    <div class="col-sm-4">
                        {!! Form::Label('registration_num', 'Registration No.', ['class'=>'col-form-label font-weight-bold']) !!}
                    </div>
                    <div class="col-sm-8">
                        {!! Form::text('registration_num', null, ['placeholder' => 'Registration number...like BMW-12556','class'=>'form-control']) !!}
                        <span class="text-danger">{{$errors->first('registration_num')}}</span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-row">
                    <div class="col-sm-4">
                        {!! Form::Label('model_no', 'Model No.', ['class'=>'col-form-label font-weight-bold']) !!}
                    </div>
                    <div class="col-sm-8">
                        {!! Form::text('model_no', null, ['placeholder' => 'Model number...like 2017', 'class'=>'form-control']) !!}
                        <span class="text-danger">{{$errors->first('model_no')}}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="from-group row mb-3">
            <div class="col-sm-6">
                <div class="form-row">
                    <div class="col-sm-4">
                        {!! Form::Label('brand_id', 'Car Brand', ['class'=>'col-form-label font-weight-bold']) !!}
                    </div>
                    <div class="col-sm-8">
                        {!! Form::select('brand_id', $brand, null, ['placeholder' => 'Pick a brand','class'=>'form-control']) !!}
                        <span class="text-danger">{{$errors->first('brand_id')}}</span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-row">
                    <div class="col-sm-4">
                        {!! Form::Label('company_id', 'Company', ['class'=>'col-form-label font-weight-bold']) !!}
                    </div>
                    <div class="col-sm-8">
                        {!! Form::select('company_id', $companies, null, ['placeholder'=>'Pick a company name', 'class' => 'form-control']) !!}
                        <span class="text-danger">{{$errors->first('company_id')}}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row mb-3">
            <div class="col-sm-6">
                <div class="form-row">
                    <div class="col-sm-4">
                        {!! Form::Label('parking_mode', 'Parking Mode', ['class'=>'col-form-label font-weight-bold']) !!}
                    </div>
                    <div class="col-sm-8">
                        {!! Form::select('parking_mode', ['owner'=>'Owner', 'company'=>'Company'], null, ['class' => 'form-control']) !!}
                        <span class="text-danger">{{$errors->first('parking_mode')}}</span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-row">
                    <div class="col-sm-4">
                        {!! Form::Label('driver_duty', 'Duty Hour', ['class'=>'col-form-label font-weight-bold']) !!}
                    </div>
                    <div class="col-sm-8">
                        {!! Form::number('driver_duty', null, ['placeholder'=>"Driver's daily duty hour", 'class'=>'form-control', 'min'=>'0']) !!}
                        <span class="text-danger">{{$errors->first('driver_duty')}}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row mb-3">
            <div class="col-sm-6">
                <div class="form-row">
                    <div class="col-sm-4">
                        {!! Form::Label('tax_token_expiry_date', 'Tax Expiry', ['class'=>'col-form-label font-weight-bold']) !!}
                    </div>
                    <div class="col-sm-8">
                        {!! Form::date('tax_token_expiry_date', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
                        <span class="text-danger">{{$errors->first('tax_token_expiry_date')}}</span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-row">
                    <div class="col-sm-4">
                        {!! Form::Label('fitness_expiry_date', 'Fitness Expiry', ['class'=>'col-form-label font-weight-bold']) !!}
                    </div>
                    <div class="col-sm-8">
                        {!! Form::date('fitness_expiry_date', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
                        <span class="text-danger">{{$errors->first('fitness_expiry_date')}}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row mb-3">
            <div class="col-sm-6">
                <div class="form-row">
                    <div class="col-sm-4">
                        {!! Form::Label('insurance_expiry_date', 'Insurance Expiry', ['class'=>'col-form-label font-weight-bold']) !!}
                    </div>
                    <div class="col-sm-8">
                        {!! Form::date('insurance_expiry_date', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
                        <span class="text-danger">{{$errors->first('insurance_expiry_date')}}</span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-row">
                    <div class="col-sm-4">
                        {!! Form::Label('road_permit_expiry_date', 'Road Permit Expiry', ['class'=>'col-form-label font-weight-bold']) !!}
                    </div>
                    <div class="col-sm-8">
                        {!! Form::date('road_permit_expiry_date', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
                        <span class="text-danger">{{$errors->first('road_permit_expiry_date')}}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row mb-3">
            <div class="col-sm-6">
                <div class="form-row">
                    <div class="col-sm-4">
                        {!! Form::Label('driver_name', 'Driver Name', ['class'=>'col-form-label font-weight-bold']) !!}
                    </div>
                    <div class="col-sm-8">
                        {!! Form::text('driver_name', null, ['placeholder'=>"Driver's name...",'class' => 'form-control']) !!}
                        <span class="text-danger">{{$errors->first('driver_name')}}</span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-row">
                    <div class="col-sm-4">
                        {!! Form::Label('driver_nid', 'Driver NID', ['class'=>'col-form-label font-weight-bold']) !!}
                    </div>
                    <div class="col-sm-8">
                        {!! Form::text('driver_nid', null, ['placeholder'=>"Driver's national id...",'class' => 'form-control']) !!}
                        <span class="text-danger">{{$errors->first('driver_nid')}}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row mb-3">
            <div class="col-sm-6">
                <div class="form-row">
                    <div class="col-sm-4">
                        {!! Form::Label('driver_address', 'Driver Address', ['class'=>'col-form-label font-weight-bold']) !!}
                    </div>
                    <div class="col-sm-8">
                        {!! Form::text('driver_address', null, ['placeholder'=>"Driver's address...",'class' => 'form-control']) !!}
                        <span class="text-danger">{{$errors->first('driver_address')}}</span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-row">
                    <div class="col-sm-4">
                        {!! Form::Label('driver_phone_num', 'Driver Phone', ['class'=>'col-form-label font-weight-bold']) !!}
                    </div>
                    <div class="col-sm-8">
                        {!! Form::text('driver_phone_num', null, ['placeholder'=>'01XXXXXXXXX','class' => 'form-control']) !!}
                        <span class="text-danger">{{$errors->first('driver_phone_num')}}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row mb-3">
            {!! Form::Label('remarks', 'Remarks:', ['class'=>'col-sm-2 col-form-label font-weight-bold']) !!}
            <div class="col-sm-10">
                {!! Form::text('remarks', null, ['placeholder' => 'Short note about the car...', 'class' => 'form-control']) !!}
            </div>
        </div>
        <div class="from-group row mb-3">
            {!! Form::label('photo_id', "Driver's Photo", ['class'=>'col-sm-2 col-form-label font-weight-bold']) !!}
            <div class="col-sm-10">
                {!! Form::file('photo_id', null, ['class'=>'form-control']) !!}
            </div>
        </div>
        <div class="from-group">
            {!! Form::submit('Submit', ['class'=>'btn btn-primary float-right mr-5']) !!}
        </div>
    {!! Form::close() !!}
    </div>

@stop

@section('scripts')
@stop