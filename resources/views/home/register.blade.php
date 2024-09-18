@extends('layouts.default')
@section('style')
<style>
    .register_section {
        width: 600px;
        margin: auto;
    }

    hr.line {
        border: 1px solid #222831;
    }
</style>
@endsection
@section('content')
<section class="register_section layout_padding">
    <div class="container">
        <div class="header">
            Rejestracja
        </div>
        <hr class="line">
        <div class="row">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group required">
                    <label for="login">Login: </label>
                    <input type="text" class="form-control" id="login" placeholder="Login" name="login" required>
                </div>
                <div class="form-group required">
                    <label for="email">Email: </label>
                    <input type="text" class="form-control" id="email" placeholder="Email" name="email" required>
                </div>
                <div class="form-group required">
                    <label for="password">Hasło: </label>
                    <input type="password" class="form-control" id="password" placeholder="Hasło" name="password" required>
                </div>
                <div class="form-group required">
                    <label for="password_confirmation">Potwórz Hasło: </label>
                    <input type="password" class="form-control" id="password_confirmation" placeholder="Potwórz Hasło" name="password_confirmation" required>
                </div>
                <div class="btn-box">
                    <button class="btn-login">Zarejestruj się</button>
                </div>
            </form>
        </div>
        <hr class="line">
        <div class="register">
            Masz już konto? <a href="{{ route('login') }}">Zaloguj się</a>
        </div>
    </div>
</section>

@endsection