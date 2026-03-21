@extends('layouts.admin.app')
@section('content')
<!-- <p class="text-center text-primary"><small>Tutorial by ItSolutionStuff.com</small></p> -->
<div class="d-flex justify-content-center align-items-center min-vh-100">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-body">

                <div class="mb-4 text-center">
                    <h2>Edit New User</h2>
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

                {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}
                <div class="mb-3">
                    <strong>Name:</strong>
                    {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                </div>

                <div class="mb-3">
                    <strong>Email:</strong>
                    {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
                </div>

                <div class="mb-3">
                    <strong>Password:</strong>
                    {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
                </div>

                <div class="mb-3">
                    <strong>Confirm Password:</strong>
                    {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' =>
                    'form-control'))
                    !!}
                </div>

                <div class="mb-3">
                    <strong>Role:</strong>
                    {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple')) !!}
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