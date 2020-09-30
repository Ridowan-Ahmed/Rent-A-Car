@extends('layouts.main')

@section('content')
<div id="userProfile">
    <div class="row mt-5">

        <div class="col-md-5">
            {!! Form::model($user, ['method'=>'PATCH', 'action'=>['UserController@update', $user->id], 'files'=>true]) !!}
            <img src="{{$user->photoSrc()}} " alt="Image" class="img-fluid img-thumbnail rounded-circle mb-4">
            <div class="from-group mt-4">
                {!! Form::label('photo_id', 'Upload Image') !!}
                {!! Form::file('photo_id', null, ['class'=>'form-control']) !!}<br>
            </div>
        </div>
        <div class="col-md-7 mt-5">
            <div class="form-group">
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa fa-user"></i></div>
                    </div>
                    {!! Form::text('name', null, ['class'=>'form-control']) !!}
                </div>
            </div>
            <br>
            <div class="form-group">
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa fa-envelope"></i></div>
                    </div>
                    {!! Form::email('email', null, ['class'=>'form-control']) !!}
                </div>
            </div>
            <br>
            <div class="form-group">
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa fa-lock"></i></div>
                    </div>
                    {!! Form::password('password', ['class'=>'form-control']) !!}
                </div>
            </div>
            <hr>
            <div class="from-group ml-5 float-right">
                {!! Form::submit('Update Info', ['class'=>'btn btn-success float-left']) !!}
            </div>
            {!! Form::close() !!}

            {!! Form::open(['id'=>'deleteForm','method'=>'DELETE','action'=>['UserController@destroy', $user->id]]) !!}
            <div class="from-group mr-5">
                {!! Form::submit('Delete Account', ['id'=>'deleteButton','class'=>'btn btn-danger float-right']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection

@section('scripts')
@stop

