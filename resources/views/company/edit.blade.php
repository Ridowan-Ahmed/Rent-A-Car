@extends('layouts.main')
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/company">Company</a></li>
        <li class="breadcrumb-item"><a href="{{route('company.show', $company->slug)}}">{{$company->name}}</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit</li>
    </ol>
</nav>
<h3 class="h3">Edit {{$company->name}}</h3>
<div class="container img-thumbnail">
    <div class="row">
        <div class="col-md-12">
            {!! Form::model($company, ['method'=>'PATCH', 'action'=>['CompanyController@update', $company->name], 'files'=>true]) !!}
            <div class="from-group row mb-3">
                {!! Form::label('name', 'Name', ['class'=>'col-sm-2 col-form-label font-weight-bold']) !!}
                <div class="col-sm-10">
                    {!! Form::text('name', null, ['placeholder' => 'Company Name...','class'=>'form-control']) !!}
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
                {!! Form::label('photo_id', "Company's Logo", ['class'=>'col-sm-2 col-form-label font-weight-bold']) !!}
                <div class="col-sm-10">
                    {!! Form::file('photo_id', null, ['class'=>'form-control']) !!}
                </div>
            </div>
            <div class="from-group float-right ml-5">
                {!! Form::button('<i class="fa fa-pencil"></i> Update', ['type' => 'submit', 'class'=>'btn btn-outline-success float-left mr-5']) !!}
            </div>
            {!! Form::close() !!}
            {!! Form::open(['method'=>'DELETE', 'action'=>['CompanyController@destroy', $company->name]]) !!}
                {!! Form::button('<i class="fa fa-trash"></i> Delete', ['type' => 'submit', 'class' => 'btn btn-outline-danger float-right'] ) !!}
            {!! Form::close() !!}
        </div>
    </div>

</div>
@stop

@section('script')
@stop