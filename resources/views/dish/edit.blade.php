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
                    <li class="breadcrumb-item">Dania</li>
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
                                <button type="button" class="btn btn-block btn-primary" onclick="$('#dish_edit_form').submit();">Zapisz</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <form action="{{ route('dish.update', $dish->id) }}" method="POST" id="dish_edit_form">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-sm-12 col-md-6"></div>
                                    <div class="col-sm-12 col-md-6"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="name">Wpisz nazwe</label>
                                            <input type="text" class="form-control" id="name" placeholder="Wpisz nazwe" name="name" value="{{ $dish->name }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Wpisz opis</label>
                                            <textarea class="form-control" id="description" placeholder="Wpisz opis" name="description">{{ $dish->description }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="ingredients">Wpisz Składniki</label>
                                            @foreach ($dish->ingredients as $ingredients)
                                            <div class="ingredients">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="ingredients" placeholder="Wpisz składnik" name="ingredients[]" value="{{ $ingredients }}">
                                                    <div class="input-group-btn">
                                                        <button class="btn btn-danger" onclick="removeIngredients($(this))" type="button"><i class="fa fa-minus"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            <div class="ingredients">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="ingredients" placeholder="Wpisz składnik" name="ingredients[]">
                                                    <div class="input-group-btn">
                                                        <button class="btn btn-success" onclick="addIngredients()" type="button"><i class="fa fa-plus"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="category_id">Wybierz kategorie</label>
                                            <!-- <textarea class="form-control" id="category" placeholder="Wpisz opis" name="description"></textarea> -->
                                            <select class="form-control" name="category_id">
                                                @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" {{ $dish->category_id == $category->id ? ' selected' : '' }}>{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="price">Wpisz cene</label>
                                            <input type="number" class="form-control" id="price" placeholder="Wpisz cene" name="price" value="{{ $dish->price }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="file">Wybierz Zdjęcie</label>
                                            <div class="input-group custom-file-button">
                                                <input type="file" class="form-control" id="image" name="image">
                                                <label class="input-group-text" for="image">Wybierz plik</label>
                                            </div>
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