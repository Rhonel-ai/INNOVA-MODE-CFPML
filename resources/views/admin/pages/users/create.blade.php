@extends('layouts.admin.app')

@section('content')

<div class="d-flex justify-content-center align-items-center min-vh-100">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-body">

                <div class="mb-4 text-center">
                    <h2>Create New User</h2>
                    <a class="btn btn-sm btn-secondary mt-2" onclick="history.back()" href="#">Back</a>
                </div>

                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                {!! Form::open(['route' => 'users.store','method'=>'POST']) !!}
                <div class="mb-3">
                    <strong>Name:</strong>
                    {!! Form::text('name', null, ['placeholder' => 'Name','class' => 'form-control']) !!}
                </div>

                <div class="mb-3">
                    <strong>Email:</strong>
                    {!! Form::text('email', null, ['placeholder' => 'Email','class' => 'form-control']) !!}
                </div>

                <div class="mb-3">
                    <strong>Password:</strong>
                    {!! Form::password('password', ['placeholder' => 'Password','class' => 'form-control']) !!}
                </div>

                <div class="mb-3">
                    <strong>Confirm Password:</strong>
                    {!! Form::password('confirm-password', ['placeholder' => 'Confirm Password','class' =>
                    'form-control']) !!}
                </div>

                <div class="mb-3">
                    <strong>Role:</strong>
                    {!! Form::select('roles[]', $roles,[], ['class' => 'form-control','multiple']) !!}
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                {!! Form::close() !!}

                <!-- <p class="text-center text-muted mt-4">
                    <small>Tutorial by ItSolutionStuff.com</small>
                </p> -->
            </div>
        </div>
    </div>
</div>

@endsection