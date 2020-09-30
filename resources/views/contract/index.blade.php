@extends('layouts.main')
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Company</li>
    </ol>
</nav>
<div id="userCompany">
    <div class="row">
        @if(count($companies) > 0)
            @foreach($companies as $company)
                <div class="col-sm-12 col-md-4 col-lg-3 col-xl-3">
                    <div class="card border-success">
                        <div class="card-header bg-transparent border-success">
                            <h5 class="card-title">
                                {{$company->name}} <span class="badge badge-primary badge-pill"></span>
                            </h5>
                            <p class="card-text">
                                <small>joined </small> {{$company->created_at->diffForHumans()}}
                                <a href="{{route('contract.show')}}" class="btn btn-sm btn-outline-success float-right">
                                    <i class="fa fa-book"></i> Contract
                                </a>
                            </p>
                        </div>
                        <div class="card-body text-center">
                            <ul class="list-group list-unstyled">
                                <li class="">Rent:  &#x9f3; per month</li>
                            </ul>
                        </div>
                        <div class="card-footer bg-transparent border-success">
                            <a href="{{route('company.edit', $company->name)}}" class="card-link btn btn-sm btn-outline-primary float-right">
                                <i class="fa fa-pencil"></i> Edit
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <h3>No companies</h3>
        @endif
    </div>
</div>
@stop

@section('script')
@stop