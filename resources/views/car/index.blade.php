@extends('layouts.main')
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Car</li>
    </ol>
</nav>
<div id="userCar">
        <div class="row">
            @if(count($cars) > 0)
                @foreach($cars as $car)
                <div class="col-md-4 mb-3">
                    <div class="card border-success wow zoomInDown">
                        <div class="card-header bg-transparent border-success">
                            <h5 class="card-title">
                                {{$car->registration_num}} <span class="badge badge-success badge-pill">{{$car->car_brand}}</span>
                            </h5>
                            <p class="card-text">
                                <small>Owner</small> {{\App\Owner::findOrFail($car->owner_id)->name}}
                                <a href="{{route('logbook.show', $car->registration_num)}}" class="btn btn-sm btn-outline-success float-right">
                                    <i class="fa fa-book"></i> Log
                                </a>
                            </p>
                        </div>
                        <div class="card-body text-center">
                            <ul class="list-group list-unstyled">
                                <li class="font-weight-bold">
                                    @if($car->company_id)
                                        {{\App\Company::findOrFail($car->company_id)->name}}
                                    @else
                                        None
                                    @endif
                                </li>
                                <li class="">Tax token {{$car->tax_token_expiry_date->diffForHumans()}}</li>
                                <li class="">Fitness {{$car->fitness_expiry_date->diffForHumans()}}</li>
                                <li class="">Insurance {{$car->insurance_expiry_date->diffForHumans()}}</li>
                                <li class="">Road permit {{$car->road_permit_expiry_date->diffForHumans()}}</li>
                            </ul>
                        </div>
                        <div class="card-footer bg-transparent border-success float-right">
                            <span class="float-right">
                                <a href="{{route('car.report', $car->registration_num)}}" class="btn btn-sm btn-outline-success mr-2">
                                    <i class="fa fa-book"></i> Report
                                </a>
                                <a href="{{route('car.edit', $car->registration_num)}}" class="card-link btn btn-sm btn-outline-success">
                                    <i class="fa fa-pencil"></i> Edit
                                </a>
                            </span>

                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <h3>No Cars</h3>
            @endif
        </div>
    </div>
@stop
@section('scripts')
@stop
