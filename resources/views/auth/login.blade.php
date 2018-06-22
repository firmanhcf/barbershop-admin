@extends('layouts.master')

@section('title', 'Login')

@section('content')

<div class="unix-login">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <div class="login-content card">
                    <div class="login-form">
                        <h4>Login</h4>
                        @if (count($errors))
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                                @foreach($errors->all() as $error)
                                    {{ $error }}
                                @endforeach
                                
                            </div>
                        @endif
                        <form method="POST">
                            <div class="form-group">
                                <label>Email address</label>
                                <input type="email" name="email" class="form-control input-sm" placeholder="Type your email...">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control input-sm" placeholder="Type your password...">
                            </div>
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-15">Sign in</button>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection