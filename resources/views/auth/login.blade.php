@extends('layouts.auth')

@section('content')
    <div class="login-container">
        <div class="login-left">
            <img src="{{ URL::asset('assets/img/rb_7963.png') }}" alt="Illustration">
        </div>
        <div class="login-right">
            <h2>Sing In</h2>
            <p>Enter your email and password to sign in</p>
            <form>
                <input type="email" class="form-control" placeholder="Email">
                <input type="password" class="form-control" placeholder="Password">
                <button type="submit" class="btn btn-sign">Sign In</button>
            </form>
        </div>
    </div>
@endsection
