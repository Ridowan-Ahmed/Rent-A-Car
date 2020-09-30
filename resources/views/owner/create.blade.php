@extends('layouts.main')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/owner">Owner</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create</li>
        </ol>
    </nav>
    <h3 class="h3"><i class="fa fa-audio-description"></i> Owner</h3>
    <div class="container img-thumbnail">
        {!! Form::open(['method'=>'POST', 'action'=>'OwnerController@store', 'files'=>true]) !!}
        <div class="from-group row mb-3">
            {!! Form::label('name', 'Name', ['class'=>'col-sm-2 col-form-label font-weight-bold']) !!}
            <div class="col-sm-10">
                {!! Form::text('name', null, ['placeholder' => 'Owner Name...','class'=>'form-control']) !!}
                <span class="text-danger">{{$errors->first('name')}}</span>
            </div>
        </div>
        <div class="from-group row mb-3">
            {!! Form::label('address', 'Address', ['class'=>'col-sm-2 col-form-label font-weight-bold']) !!}
            <div class="col-sm-10">
                {!! Form::text('address', null, ['placeholder' => 'Current Address...','class'=>'form-control']) !!}
                <span class="text-danger">{{$errors->first('address')}}</span>
            </div>
        </div>
        <div class="from-group row mb-3">
            {!! Form::label('phone_num', 'Phone Number', ['class'=>'col-sm-2 col-form-label font-weight-bold']) !!}
            <div class="col-sm-10">
                {!! Form::text('phone_num', null, ['placeholder' => '01XXXXXXXXX','class'=>'form-control']) !!}
                <span class="text-danger">{{$errors->first('phone_num')}}</span>
            </div>
        </div>
        <div class="from-group row mb-3">
            {!! Form::label('remarks', 'Remarks', ['class'=>'col-sm-2 col-form-label font-weight-bold']) !!}
            <div class="col-sm-10">
                {!! Form::text('remarks', null, ['placeholder' => 'A short note about the company','class'=>'form-control']) !!}
            </div>
        </div>
        <div class="from-group row mb-3">
            {!! Form::label('photo_id', "Owner's Photo", ['class'=>'col-sm-2 col-form-label font-weight-bold']) !!}
            <div class="col-sm-10">
                {!! Form::file('photo_id', null, ['class'=>'form-control']) !!}
            </div>
        </div>
        <div class="from-group">
            {!! Form::submit('Submit', ['class'=>'btn btn-primary float-right mr-5']) !!}
        </div>
    </div>
@stop

@section('script')
@stop