@extends('layouts.main')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Company</li>
        </ol>
    </nav>
    <div id="userCompany dark-overlay">
        @if(count($companies))
        <table class="table table-responsive-sm">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Car</th>
                <th scope="col">Address</th>
                <th scope="col">Phone No.</th>
                <th scope="col">Remarks</th>
            </tr>
            </thead>
            <tbody>
            @foreach($companies as $company)
                <tr>
                    <th scope="row">{{$company->id}}</th>
                    <td><a href="{{route('company.show',$company->slug)}}">{{$company->name}}</a></td>
                    <td>{{count($company->car)}}</td>
                    <td>{{$company->address}}</td>
                    <td>{{$company->phone_num}}</td>
                    <td>{{$company->remarks}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @else
            <p>No Company added yet</p>
        @endif
    </div>
@stop

@section('script')
@stop