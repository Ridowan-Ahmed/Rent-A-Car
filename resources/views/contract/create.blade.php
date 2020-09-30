@extends('layouts.main')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            @if(get_class($vendor) === 'App\Owner')
                <li class="breadcrumb-item"><a href="/owner">Owner</a></li>
                <li class="breadcrumb-item"><a href="{{route('owner.show', $vendor->slug)}}">{{$vendor->name}}</a></li>
            @else
                <li class="breadcrumb-item"><a href="/company">Company</a></li>
                <li class="breadcrumb-item"><a href="{{route('company.show', $vendor->slug)}}">{{$vendor->name}}</a></li>
            @endif
            <li class="breadcrumb-item" aria-current="page">Contract</li>
            <li class="breadcrumb-item active" aria-current="page">Create</li>
        </ol>
    </nav>
    <h3 class="h3"><i class="fa fa-audio-description"></i> Contract with {{$vendor->name}}</h3>
    <div class="container img-thumbnail">
        {!! Form::open(['method'=>'POST', 'action'=>'ContractController@store']) !!}
        {!! Form::hidden('role',  get_class($vendor)) !!}
        {!! Form::hidden('id', $vendor->id) !!}
        <div class="form-group row mb-3">
            <div class="col-sm-6">
                <div class="form-row">
                    <div class="col-sm-4">
                        {!! Form::Label('octane_cost', 'Octane Cost', ['class'=>'col-form-label font-weight-bold']) !!}
                    </div>
                    <div class="col-sm-8">
                        {!! Form::number('octane_cost', null, ['placeholder' => 'Octane cost per litre...', 'class' => 'form-control']) !!}
                        <span class="text-danger">{{$errors->first('octane_cost')}}</span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-row">
                    <div class="col-sm-4">
                        {!! Form::Label('diesel_cost', 'Diesel Cost', ['class'=>'col-form-label font-weight-bold']) !!}
                    </div>
                    <div class="col-sm-8">
                        {!! Form::number('diesel_cost', null, ['placeholder' => 'Diesel cost per litre...', 'class' => 'form-control']) !!}
                        <span class="text-danger">{{$errors->first('diesel_cost')}}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row mb-3">
            <div class="col-sm-6">
                <div class="form-row">
                    <div class="col-sm-4">
                        {!! Form::Label('cng_cost', 'Cng Cost', ['class'=>'col-form-label font-weight-bold']) !!}
                    </div>
                    <div class="col-sm-8">
                        {!! Form::number('cng_cost', null, ['placeholder' => 'CNG cost per litre...', 'class' => 'form-control']) !!}
                        <span class="text-danger">{{$errors->first('cng_cost')}}</span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-row">
                    <div class="col-sm-4">
                        {!! Form::Label('starting_octane', 'Starting Octane', ['class'=>'col-form-label font-weight-bold']) !!}
                    </div>
                    <div class="col-sm-8">
                        {!! Form::number('starting_octane', null, ['placeholder' => 'Staring octane per month...', 'class' => 'form-control']) !!}
                        <span class="text-danger">{{$errors->first('starting_octane')}}</span>
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
                        {!! Form::Label('car_rent', 'Car Rent', ['class'=>'col-form-label font-weight-bold']) !!}
                    </div>
                    <div class="col-sm-8">
                        {!! Form::number('car_rent', null, ['placeholder' => 'Car rent per month...', 'class' => 'form-control']) !!}
                        <span class="text-danger">{{$errors->first('car_rent')}}</span>
                    </div>
                </div>

            </div>
        </div>
        <div class="form-group row mb-3">
            <div class="col-sm-6">
                <div class="form-row">
                    <div class="col-sm-4">
                        {!! Form::Label('overtime_cost', 'Overtime Cost', ['class'=>'col-form-label font-weight-bold']) !!}
                    </div>
                    <div class="col-sm-8">
                        {!! Form::number('overtime_cost', null, ['placeholder' => 'Overtime money per hour...','class' => 'form-control']) !!}
                        <span class="text-danger">{{$errors->first('overtime_cost')}}</span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-row">
                    <div class="col-sm-4">
                        {!! Form::Label('breakfast_cost', 'Breakfast Cost', ['class'=>'col-form-label font-weight-bold']) !!}
                    </div>
                    <div class="col-sm-8">
                        {!! Form::number('breakfast_cost', null, ['placeholder' => 'Breakfast money per day', 'class' => 'form-control']) !!}
                        <span class="text-danger">{{$errors->first('breakfast_cost')}}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row mb-3">
            <div class="col-sm-6">
                <div class="form-row">
                    <div class="col-sm-4">
                        {!! Form::Label('launch_cost', 'Launch Cost', ['class'=>'col-form-label font-weight-bold']) !!}
                    </div>
                    <div class="col-sm-8">
                        {!! Form::number('launch_cost', null, ['placeholder' => 'Launch money per day...','class' => 'form-control']) !!}
                        <span class="text-danger">{{$errors->first('launch_cost')}}</span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-row">
                    <div class="col-sm-4">
                        {!! Form::Label('dinner_cost', 'Dinner Cost', ['class'=>'col-form-label font-weight-bold']) !!}
                    </div>
                    <div class="col-sm-8">
                        {!! Form::number('dinner_cost', null, ['placeholder' => 'Dinner money per day...', 'class' => 'form-control']) !!}
                        <span class="text-danger">{{$errors->first('dinner_cost')}}</span>
                    </div>
                </div>
            </div>
        </div>
        @if(get_class($vendor) === 'App\Company')
            <div class="form-group row mb-3">
                <div class="col-sm-6">
                    <div class="form-row">
                        <div class="col-sm-4">
                            {!! Form::Label('num_of_car', 'Number of Car', ['class'=>'col-form-label font-weight-bold']) !!}
                        </div>
                        <div class="col-sm-8">
                            {!! Form::number('num_of_car', null, ['placeholder' => 'How many car?', 'class' => 'form-control']) !!}
                            <span class="text-danger">{{$errors->first('num_of_car')}}</span>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="form-group row mb-3">
            <div class="col-sm-6">
                <div class="form-row">
                    <div class="col-sm-4">
                        {!! Form::Label('contract_type', 'Contract Type', ['class'=>'col-form-label font-weight-bold']) !!}
                    </div>
                    <div class="col-sm-8">
                        {!! Form::select('contract_type', ['weekly'=>'Weekly', 'monthly'=>'Monthly', 'yearly'=>'Yearly', ], null, ['placeholder' => 'Select Contract Type','class' => 'form-control']) !!}
                        <span class="text-danger">{{$errors->first('contract_type')}}</span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-row">
                    <div class="col-sm-4">
                        {!! Form::Label('contract_duration', 'Contract Duration', ['class'=>'col-form-label font-weight-bold']) !!}
                    </div>
                    <div class="col-sm-8">
                        {!! Form::number('contract_duration', null, ['placeholder' => 'For how long ?...', 'class' => 'form-control']) !!}
                        <span class="text-danger">{{$errors->first('contract_duration')}}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="from-group row mb-3">
            {!! Form::label('remarks', 'Remarks', ['class'=>'col-sm-2 col-form-label font-weight-bold']) !!}
            <div class="col-sm-10">
                {!! Form::text('remarks', null, ['placeholder' => 'A short note about the company','class'=>'form-control']) !!}
            </div>
        </div>
        <br>
        <div class="from-group">
            {!! Form::submit('Submit', ['class'=>'btn btn-success float-right mr-5']) !!}
        </div>
    </div>
@stop

@section('script')
@stop