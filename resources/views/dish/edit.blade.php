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

    .image {
        margin: 10px 0;

    }

    .image img {
        width: 150px;
        height: 150px;
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
                            <form action="{{ route('dish.update', $dish->id) }}" method="POST" enctype="multipart/form-data" id="dish_edit_form">
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
                                        <div class="form-group price-box" @if ($dish->sizes->isNotEmpty() && !$dish->price) style="display: none;" @endif>
                                            <label for="price">Wpisz cenę</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control price" id="price" placeholder="Wpisz cenę" name="price" step="0.01" value="{{ $dish->price }}">
                                                <div class="input-group-btn">
                                                    <button class="btn btn-success" onclick="addSize()" type="button">Dodaj rozmiary <i class="fa fa-plus"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group sizes-box" @if ($dish->sizes->isEmpty()) style="display: none;" @endif>
                                            <label for="sizes">Wpisz Rozmiary</label>
                                            <div class="sizes">
                                                @foreach ($dish->sizes ?? [] as $size)
                                                <div class="row size size{{ $loop->iteration }}-box my-1" data-iteration="{{ $loop->iteration }}">
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" id="name" placeholder="Wpisz nazwe" name="sizes[1][name]" value="{{ $size->name }}">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <input type="number" class="form-control" id="price" placeholder="Wpisz cenę" name="dishes[1][price]" step="0.01" value="{{ $size->price }}">
                                                            <div class="input-group-btn">
                                                                @if ($dish->sizes->count() == 1)
                                                                <button class="btn btn-danger" onclick="removeSize($(this))" type="button"><i class="fa fa-minus"></i></button><button class="btn btn-success" onclick="addSize()" type="button"><i class="fa fa-plus"></i></button>
                                                                @elseif ($loop->last)
                                                                <button class="btn btn-success" onclick="addSize()" type="button"><i class="fa fa-plus"></i></button>
                                                                @else
                                                                <button class="btn btn-danger" onclick="removeSize($(this))" type="button"><i class="fa fa-minus"></i></button>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="image">Wybierz Zdjęcie</label>
                                            @if ($dish->image)
                                            <div class="image">
                                                <img src="{{ Storage::url($dish->image) }}" alt="Zdjęcia dania">
                                                <button class="btn btn-sm btn-danger"><i class="fa fa-solid fa-remove"></i></button>
                                            </div>
                                            @endif
                                            <div class="input-group custom-file-button">
                                                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                                                <input type="hidden" name="path" value="{{ $dish->image }}">
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
    $(function() {
        $('.image button').on('click', function() {
            $('.image').remove();
            $('input[name="path"]').val('');
        });
    });

    function addIngredients() {
        $('.ingredients').first().before('<div class="ingredients"><div class="input-group"><input type="text" class="form-control" id="ingredients" placeholder="Wpisz składnik"><div class="input-group-btn"><button class="btn btn-danger" onclick="removeIngredients($(this))" type="button"><i class="fa fa-remove"></i></button></div></div></div>');
    }

    function addSize() {
        var iteration = $('.size').last().data('iteration') ?? 0;
        iteration++;

        if (!$('.sizes-box').is(':visible')) {
            var price = $('.price-box').find('.price').val() ? $('.price-box').find('.price').val() : '';
        }

        $('.sizes').find('.btn-success').closest('button').each(function() {
            $(this).closest('.size').find('.btn-danger').first().remove();
            $('.sizes').find('.btn-success').closest('button').each(function() {
                $(this).replaceWith('<button class="btn btn-danger" onclick="removeSize($(this))" type="button"><i class="fa fa-minus"></i></button>');
            });

        });

        $('.sizes').append('<div class="row size size' + iteration + '-box my-1" data-iteration="' + iteration + '"><div class="col-sm-6"><input type="text" class="form-control" id="name" placeholder="Wpisz nazwe" name="sizes[' + iteration + '][name]"></div><div class="col-sm-6"><div class="input-group"><input type="number" class="form-control" id="price" placeholder="Wpisz cenę" name="sizes[' + iteration + '][price]" step="0.01" value="' + price + '"><div class="input-group-btn"><button class="btn btn-success" onclick="addSize()" type="button"><i class="fa fa-plus"></i></button></div></div></div></div>');

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