@extends('master')

@section('content')
<div class="row">
    <div class="col-sm-6 col-md-4 col-md-offset-4">
        <h1 class="text-center login-title">Sign in to Routine Manager</h1>
        <div class="account-wall">
           
            <img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120" alt="">
            
            <form action="{{ url('account/login') }}" class="form-signin" method="post">
                <input type="text" name="email" class="form-control" placeholder="Email" required autofocus>
                <input type="password" name="password" class="form-control" placeholder="Password" required>
                <label class="checkbox pull-left">
                    <input type="checkbox" value="remember-me">
                    Remember me
                </label>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                
                <!-- <a href="#" class="pull-right need-help">Need help? </a><span class="clearfix"></span> -->
            </form>
        </div>
        {{ link_to('account/create', 'Create an account', ['class' => 'text-center new-account']) }}
    </div>
</div>
@endsection