@extends('layouts.admin')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edytuj użytkownika</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Strona główna</a></li>
                    <li class="breadcrumb-item">Użytkownicy</li>
                    <li class="breadcrumb-item">Edytuj</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-11"></div>
                            <div class="col-sm-1">
                                <button type="button" class="btn btn-block btn-primary" onclick="$('#user_edit_form').submit();">Zapisz</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <form action="{{ route('user.update', $user->id) }}" method="POST" id="user_edit_form">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-sm-12 col-md-6"></div>
                                    <div class="col-sm-12 col-md-6"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="login">Wpisz login</label>
                                            <input type="text" class="form-control @error('login') is-invalid @enderror" id="login" placeholder="Wpisz login" name="login" value="{{ $user->login }}">
                                            @error('login')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Wpisz email</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Wpisz email" name="email" value="{{ $user->email }}">
                                            @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Wpisz hasło</label>
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Wpisz hasło" name="password">
                                            @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="password_confirmation">Potwórz hasło</label>
                                            <input type="password" class="form-control" id="password_confirmation" placeholder="Potwórz hasło" name="password_confirmation">
                                        </div>
                                        <div class="form-group">
                                            <label for="admin">Rola</label>
                                            <select class="form-select" id="admin" name="admin">
                                                <option value="0" @if ($user->admin == 0) selected @endif>Użytkownik</option>
                                                <option value="1" @if ($user->admin == 1) selected @endif>Administrator</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>

            </div>

        </div>
</section>
@endsection