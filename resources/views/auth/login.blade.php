@extends('layouts.master')

@section('title', 'Login')

@section('content')

<div class="unix-login purple-bg">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <div class="login-content card">
                    <div class="login-form m-t-30 m-b-30">
                        <h4><strong>BIG SMILE DASHBOARD</strong></h4>
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
                                <input type="email" name="email" class="form-control input-sm" placeholder="Masukkan alamat email...">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control input-sm" placeholder="Masukkan password...">
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
@section('addScript')
<script src="{{ asset('js/dashboard/login.js') }}"></script>
@endsection