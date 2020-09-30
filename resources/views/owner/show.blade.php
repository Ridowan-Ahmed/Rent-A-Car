@extends('layouts.main')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/owner">Owner</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$owner->name}}</li>
        </ol>
    </nav>
    <div id="showOwner">
        <div class="media mb-3">
            <img class="align-self-end mr-3 d-none d-sm-block wow wobble" src="{{$owner->photoSrc()}}" alt="owner image"
                 width="20%">
            <div class="media-body">
                <h3 class="mt-0">{{$owner->name}}</h3>
                <p>Lives at <span class="font-weight-bold">{{$owner->address}}</span></p>
                <p>Contract Number <span class="font-weight-bold">{{$owner->phone_num}}</span></p>
                <p>Has <a href="{{route('car.ownerReport', $owner->slug)}}"
                          class="font-weight-bold" data-toggle="tooltip" data-html="true"
                          data-toggle="tooltip" data-html="true" data-placement="top"
                          title="<i class='fa fa-taxi'></i> Details">{{count($owner->car)}} Car <i
                                class="fa fa-taxi"></i></a></p>
                <p>{{$owner->remarks}}</p>
                <p class="mb-0">
                    <a href="{{route('owner.carCreate', $owner->slug)}}" class="btn btn-outline-primary"
                       data-toggle="tooltip" data-html="true" data-placement="top"
                       title="<i class='fa fa-ambulance'></i> Add Car of {{$owner->name}}"><i
                                class="fa fa-ambulance"></i> Add Car</a>
                    <a href="{{route('owner.contractCreate', $owner->slug)}}" class="btn btn-outline-success"
                       data-toggle="tooltip" data-html="true" data-placement="top"
                       title="<i class='fa fa-book'></i> Add contract with {{$owner->name}}"><i class="fa fa-book"></i>
                        Add Contract</a>
                    <a href="{{route('owner.edit', $owner->slug)}}" class="btn btn-outline-warning"
                       data-toggle="tooltip" data-html="true" data-placement="top"
                       title="<i class='fa fa-pencil'></i> Edit {{$owner->name}}"><i class="fa fa-pencil"></i> Edit</a>
                </p>
            </div>
        </div>
    </div>
    <div id="showCar">
        @if($owner->car)
            @php
                $id = 0;
            @endphp
            <details open>
                <summary>
                    <span class="badge badge-success font-weight-bold">Cars {{count($owner->car)}}</span>
                </summary>
                <table class="table table-responsive-sm">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Registration No.</th>
                        <th scope="col">Company</th>
                        <th scope="col">Driver</th>
                        <th scope="col">Driver's Address</th>
                        <th scope="col">Phone No.</th>
                        <th scope="col">Remarks</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($owner->car->sortBy('company_id') as $car)
                        <tr>
                            <th scope="row">{{++$id}}</th>
                            <td><a href="{{route('logbook.show', $car->registration_num)}}" data-toggle="tooltip"
                                   data-html="true" data-placement="top"
                                   title="<i class='fa fa-commenting'></i> Daily Log of {{$car->registration_num}}">{{$car->registration_num}}</a><span
                                        class="badge badge-secondary">{{$car->brand->name}}</span>
                            </td>
                            <td><a href="{{route('company.show', $car->company->slug)}}" data-toggle="tooltip"
                                   data-html="true" data-placement="top"
                                   title="<i class='fa fa-user'></i> Show {{$car->company->name}}">{{$car->company->name}}</a>
                            </td>
                            <td>{{$car->driver_name}}</td>
                            <td>{{$car->driver_address}}</td>
                            <td>{{$car->driver_phone_num}}</td>
                            <td>{{$car->remarks}}</td>
                            <td><a href="{{route('car.edit', $car->registration_num)}}"><i class="fa fa-pencil"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </details>
        @else
            <p>No Car added yet</p>
        @endif
    </div>
    <hr>
    <div id="showContract">
        @if($owner->contract)
            @php
                $id = 0;
            @endphp
            <details open>
                <summary>
                    Contracts <span class="badge badge-primary">{{count($owner->contract)}}</span>
                </summary>
                <div class="contractInfo">
                    @foreach($owner->contract as $contract)
                        <details class="ml-3 mb-3">
                            <summary>
                                <span class="font-weight-bold"><i
                                            class="fa fa-car"></i> {{$contract->brand->name}}</span>
                            </summary>
                            <a href="{{route('owner.contractEdit', [$owner->slug, $contract->id])}}"
                               class="btn btn-sm btn-outline-primary my-2"><i class="fa fa-pencil-square-o"></i>
                                Edit</a>
                            <div class="row">
                                <div class="col-sm-4">
                                    <ul class="list-group">
                                        <li class="list-group-item">Octane Cost <span class="font-weight-bold">{{$contract->octane_cost}}
                                                &#x9f3;</span></li>
                                        <li class="list-group-item">Diesel Cost <span class="font-weight-bold">{{$contract->diesel_cost}}
                                                &#x9f3;</span></li>
                                        <li class="list-group-item">CNG Cost <span class="font-weight-bold">{{$contract->cng_cost}}
                                                &#x9f3;</span></li>
                                        <li class="list-group-item">Car Rent <span class="font-weight-bold">{{$contract->car_rent}}
                                                &#x9f3;</span></li>
                                    </ul>
                                </div>
                                <div class="col-sm-4">
                                    <ul class="list-group">
                                        <li class="list-group-item">Overtime Cost <span class="font-weight-bold">{{$contract->overtime_cost}}
                                                &#x9f3;</span></li>
                                        <li class="list-group-item">Breakfast Cost <span class="font-weight-bold">{{$contract->breakfast_cost}}
                                                &#x9f3;</span></li>
                                        <li class="list-group-item">Launch Cost <span class="font-weight-bold">{{$contract->launch_cost}}
                                                &#x9f3;</span></li>
                                        <li class="list-group-item">Dinner Cost <span class="font-weight-bold">{{$contract->dinner_cost}}
                                                &#x9f3;</span></li>
                                    </ul>
                                </div>
                                <div class="col-sm-4">
                                    <ul class="list-group">
                                        <li class="list-group-item">Contract Type <span
                                                    class="font-weight-bold">{{ucwords($contract->contract_type)}}</span>
                                        </li>
                                        <li class="list-group-item">Contract Duration <span
                                                    class="font-weight-bold">{{$contract->contract_duration}}</span>
                                        </li>
                                        <li class="list-group-item"><span
                                                    class="font-italic">{{$contract->remarks}}</span></li>
                                    </ul>
                                </div>
                            </div>
                        </details>
                    @endforeach
                </div>
            </details>
        @else
            <p>No Contract added yet</p>
        @endif
    </div>

@stop

@section('script')
@stop