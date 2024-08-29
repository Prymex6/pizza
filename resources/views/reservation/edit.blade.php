@extends('layouts.admin')
@section('style')
<style>
    .custom-file-button {
        input[type="file"] {
            margin-right: -2px !important;

            &::-webkit-file-upload-button {
                display: none;
            }

            &::file-selector-button {
                display: none;
            }
        }

        &:hover {
            label {
                background-color: #dde0e3;
                cursor: pointer;
            }
        }
    }
</style>
@endsection
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edytuj danie</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Strona główna</a></li>
                    <li class="breadcrumb-item">Rezerwacje</li>
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
                                <button type="button" class="btn btn-block btn-primary" onclick="$('#reservation_edit_form').submit();">Zapisz</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <form action="{{ route('reservation.update', $reservation->id) }}" method="POST" id="reservation_edit_form">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-sm-12 col-md-6"></div>
                                    <div class="col-sm-12 col-md-6"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="name">Wpisz imie</label>
                                                    <input type="text" class="form-control" id="firstname" placeholder="Wpisz imie" name="firstname" value="{{ $reservation->firstname }}">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="description">Wpisz nazwisko</label>
                                                    <input class="form-control" id="lastname" placeholder="Wpisz nazwisko" name="lastname" value="{{ $reservation->lastname }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="telephone">Wpisz telefon</label>
                                            <input type="telephone" class="form-control" id="telephone" placeholder="Wpisz telefon" name="telephone" value="{{ $reservation->telephone }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Wpisz email</label>
                                            <input type="email" class="form-control" id="email" placeholder="Wpisz email" name="email" value="{{ $reservation->email }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="persons">Ilość osób</label>
                                            <select class="form-control nice-select wide" id="persons" name="persons">
                                                <option value="2" @if ($reservation->persons == 2) selected @endif>2</option>
                                                <option value="3" @if ($reservation->persons == 3) selected @endif>3</option>
                                                <option value="4" @if ($reservation->persons == 4) selected @endif>4</option>
                                                <option value="5" @if ($reservation->persons == 5) selected @endif>5</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="date_time">Data i Godzina</label>
                                            <input type="datetime-local" class="form-control" id="date_time" name="date_time" value="{{ $reservation->date_time }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select class="form-control nice-select wide" id="status" name="status">
                                                <option value="" @if ($reservation->status == null) selected @endif>Oczekujący</option>
                                                <option value="1" @if ($reservation->status == '1') selected @endif>Zaakaceptowany</option>
                                                <option value="0" @if ($reservation->status == '2') selected @endif>Odrzucony</option>
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
@section('script')
<script>
    function addIngredients() {
        $('.ingredients').first().before('<div class="ingredients"><div class="input-group"><input type="text" class="form-control" id="ingredients" placeholder="Wpisz składnik"><div class="input-group-btn"><button class="btn btn-danger" onclick="removeIngredients($(this))" type="button"><i class="fa fa-remove"></i></button></div></div></div>');
    }

    function removeIngredients(e) {
        $(e).closest('.ingredients').remove();
    }
</script>
@endsection