@extends('master')

@section('content')

<div class="row">
    <div class="col-sm-6 col-md-4 col-md-offset-4">
        @if ($errors && count($errors))
        <div class="alert alert-danger">
            <strong>Uh oh!</strong>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <h1 class="text-center login-title">Register an account</h1>
        <div class="account-wall">
            
            {{ Form::open(['url' => 'account/register', 'class' => 'form-signin']) }}

                <?php $singleError = '<span class="error">:message</span>'; ?>

                {{ Form::email('email', null, ['placeholder' => 'Email', 'class' => 'form-control top', 'required', 'autofocus'])}}

                {{ Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control middle', 'required'])}}

                {{ Form::password('password_confirmation', ['placeholder' => 'Confirm password', 'class' => 'form-control middle', 'required'])}}

                {{ Form::text('first_name', null, ['placeholder' => 'First Name', 'class' => 'form-control middle', 'required'])}}

                {{ Form::text('last_name', null, ['placeholder' => 'Last Name', 'class' => 'form-control bottom', 'required'])}}

                <label class="checkbox pull-left">
                    {{ Form::checkbox('terms', 'on', false, ['required']) }}
                    I agree to the terms and conditions
                </label>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                
            {{ Form::close() }}
        </div>
    </div>
</div>

@endsection