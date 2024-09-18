@extends('layouts.default')
@section('style')
<style>
    .login_section {
        width: 600px;
        margin: auto;
    }

    hr.line {
        border: 1px solid #222831;
    }
</style>
@endsection
@section('content')
<section class="login_section layout_padding">
    <div class="container">
        <div class="header">
            Logowanie
        </div>
        <hr class="line">
        <div class="row">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group required">
                    <label for="Login">Login: </label>
                    <input type="text" class="form-control" id="login" placeholder="Login" name="login" required>
                </div>
                <div class="form-group required">
                    <label for="password">Hasło: </label>
                    <input type="password" class="form-control" id="password" placeholder="Hasło" name="password" required>
                </div>
                <div class="btn-box">
                    <button class="btn-login">Zaloguj się</button>
                </div>
            </form>
        </div>
        <hr class="line">
        <div class="register">
            Nie masz konta? <a href="{{ route('register') }}">Zarejestruj się</a>
        </div>
    </div>
</section>

@endsection