@extends('layouts.auth')

@section('content')
    <div class="login-container">
        <div class="login-left">
            <img src="{{ URL::asset('assets/img/rb_7963.png') }}" alt="Illustration">
        </div>
        <div class="login-right">
            <h2>Sing In</h2>
            <p>Enter your email and password to sign in</p>
            <form action="{{ route('login.post') }}" method="POST">
                @csrf
                <input type="email" class="form-control" name="email" placeholder="Email">
                <input type="password" class="form-control" name="password" placeholder="Password">
                <button type="submit" class="btn btn-sign btn-dark">Sign In</button>
            </form>
        </div>
    </div>
@endsection
