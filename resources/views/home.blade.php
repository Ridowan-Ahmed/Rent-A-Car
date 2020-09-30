@extends('layouts.main')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                    <div class="card-header"><i class="fa fa-building"></i> Company</div>
                    <div class="card-body text-center">
                        <h5 class="card-title">Total {{count(Auth::user()->companies)}} Company</h5>
                        <div class="card-footer bg-transparent border-secondary">
                            <a href="{{route('company.index')}}" class="btn btn-secondary">View Company</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                    <div class="card-header"><i class="fa fa-blind"></i> Owner</div>
                    <div class="card-body text-center">
                        <h5 class="card-title">Total {{count(Auth::user()->owners)}} Owner</h5>
                        <div class="card-footer bg-transparent border-secondary">
                            <a href="{{route('owner.index')}}" class="btn btn-secondary">View Owner</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
                    <div class="card-header"><i class="fa fa-taxi"></i> Car</div>
                    <div class="card-body">
                        <h5 class="card-title text-center">Total {{count(Auth::user()->cars)}} Car</h5>
                        <div class="card-footer bg-transparent border-secondary">
                            <a href="{{route('car.index')}}" class="btn btn-secondary">View Car</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
