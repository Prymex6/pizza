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
                <h1 class="m-0">Dodaj danie</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Strona główna</a></li>
                    <li class="breadcrumb-item">Dania</li>
                    <li class="breadcrumb-item">Dodaj</li>
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
                                <button type="button" class="btn btn-block btn-primary" onclick="$('#dish_store_form').submit();">Zapisz</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <form action="{{ route('dish.store') }}" method="POST" enctype="multipart/form-data" id="dish_store_form">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12 col-md-6"></div>
                                    <div class="col-sm-12 col-md-6"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="name">Wpisz nazwe</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Wpisz nazwe" name="name" value="{{ old('name') }}">
                                            @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Wpisz opis</label>
                                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" placeholder="Wpisz opis" name="description">{{ old('description') }}</textarea>
                                            @error('description')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="ingredients">Wpisz Składniki</label>
                                            <div class="ingredients">
                                                <div class="input-group">
                                                    <input type="text" class="form-control @error('ingredients') is-invalid @enderror" id="ingredients" placeholder="Wpisz składnik" name="ingredients[]">
                                                    <div class="input-group-btn">
                                                        <button class="btn btn-success" onclick="addIngredients()" type="button"><i class="fa fa-plus"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                            @error('ingredients')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="category_id">Wybierz kategorie</label>
                                            <!-- <textarea class="form-control" id="category" placeholder="Wpisz opis" name="description"></textarea> -->
                                            <select class="form-control" name="category_id">
                                                @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group price-box">
                                            <label for="price">Wpisz cenę</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control price" id="price" placeholder="Wpisz cenę" name="price" step="0.01">
                                                <div class="input-group-btn">
                                                    <button class="btn btn-success" onclick="addSize()" type="button">Dodaj rozmiary <i class="fa fa-plus"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group sizes-box" style="display: none;">
                                            <label for="sizes">Wpisz Rozmiary</label>
                                            <div class="sizes">
                                                <!-- <div class="row size size1-box my-1" data-iteration="1">
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" id="name" placeholder="Wpisz nazwe" name="sizes[1][name]">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <input type="number" class="form-control" id="price" placeholder="Wpisz cenę" name="sizes[1][price]" step="0.01">
                                                            <div class="input-group-btn">
                                                                <button class="btn btn-success" onclick="addSize()" type="button"><i class="fa fa-plus"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> -->
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="image">Wybierz Zdjęcie</label>
                                            <div class="input-group custom-file-button">
                                                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                                                <label class="input-group-text" for="image">Wybierz plik</label>
                                                @error('image')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
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

    function addSize() {
        var iteration = $('.size').last().data('iteration') ?? 0;
        iteration++;

        if (!$('.sizes-box').is(':visible')) {
            var price = $('.price-box').find('price').val() ? $('.price-box').find('price').val() : '';
        }

        $('.sizes').find('.btn-success').closest('button').each(function() {
            $(this).closest('.size').find('.btn-danger').first().remove();
            $('.sizes').find('.btn-success').closest('button').each(function() {
                $(this).replaceWith('<button class="btn btn-danger" onclick="removeSize($(this))" type="button"><i class="fa fa-minus"></i></button>');
            });

        });

        $('.sizes').append('<div class="row size size1-box my-1" data-iteration="1"><div class="col-sm-6"><input type="text" class="form-control" id="name" placeholder="Wpisz nazwe" name="sizes[' + iteration + '][name]"></div><div class="col-sm-6"><div class="input-group"><input type="number" class="form-control" id="price" placeholder="Wpisz cenę" name="sizes[' + iteration + '][price]" step="0.01" value="' + price + '"><div class="input-group-btn"><button class="btn btn-success" onclick="addSize()" type="button"><i class="fa fa-plus"></i></button></div></div></div></div>');

        if ($('.size').length == 1) {
            $('.sizes').find('.btn-success').closest('button').each(function() {
                $(this).replaceWith('<button class="btn btn-danger" onclick="removeSize($(this))" type="button"><i class="fa fa-minus"></i></button><button class="btn btn-success" onclick="addSize()" type="button"><i class="fa fa-plus"></i></button>');
            });
        }

        if (!$('.sizes-box').is(':visible')) {
            var price = $('.price-box').find('price').val();
            $('.price-box').hide();
            $('.sizes-box').show();
        }
    }

    function removeIngredients(e) {
        $(e).closest('.ingredients').remove();
    }

    function removeSize(e) {
        $(e).closest('.size').remove();
        if ($('.size').length == 1) {
            $('.sizes').find('.btn-success').closest('button').each(function() {
                $(this).replaceWith('<button class="btn btn-danger" onclick="removeSize($(this))" type="button"><i class="fa fa-minus"></i></button><button class="btn btn-success" onclick="addSize()" type="button"><i class="fa fa-plus"></i></button>');
            });
        }

        if ($('.size').length == 0) {
            $('.price-box').show();
            $('.sizes-box').hide();
        }
    }
</script>
@endsection