@extends('layouts.main')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Owner</li>
        </ol>
    </nav>
    <div id="userCompany dark-overlay">
        @if(count($owners))
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
            @foreach($owners as $owner)
                <tr>
                    <th scope="row">{{$owner->id}}</th>
                    <td><a href="{{route('owner.show',$owner->slug)}}">{{$owner->name}}</a></td>
                    <td>{{count($owner->car)}}</td>
                    <td>{{$owner->address}}</td>
                    <td>{{$owner->phone_num}}</td>
                    <td>{{$owner->remarks}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @else
        <p>No Owner added yet</p>
        @endif
    </div>
@stop

@section('script')
@stop