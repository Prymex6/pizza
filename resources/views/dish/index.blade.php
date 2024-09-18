@extends('layouts.admin')
@section('style')
<style>
    table td {
        vertical-align: middle !important;
    }

    table td.image {
        text-align: center;
    }

    .image img {
        width: 50px;
        height: 50px;
    }
</style>
@endsection
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dania</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dania</li>
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
                                <a href="{{ route('dish.create') }}" class="btn btn-block btn-success">Dodaj</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12 col-md-6"></div>
                                <div class="col-sm-12 col-md-6"></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example2" class="table table-bordered table-hover dataTable dtr-inline">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Zdjęcie</th>
                                                <th>Nazwa</th>
                                                <th>Opis</th>
                                                <th>Składniki</th>
                                                <th>Kategoria</th>
                                                <th>Rozmiar i cena</th>
                                                <th>Akcja</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dishes ?? [] as $dish)
                                            <tr class="{{ $loop->index / 2 == 0 ? 'odd' : 'even' }}">
                                                <td>{{ ($dishes->currentPage() - 1) * $dishes->count() + $loop->iteration }}</td>
                                                <td class="image">
                                                    @if ($dish->image)
                                                    <img src="{{ Storage::url($dish->image) }}" alt="Zdjęcia dania">
                                                    @else
                                                    <img src="{{ asset('additional/placeholder.png') }}" alt="Zdjęcia dania">
                                                    @endif
                                                </td>
                                                <td>{{ $dish->name }}</td>
                                                <td>{{ $dish->description }}</td>
                                                <td>{{ $dish->ingredients }}</td>
                                                <td>{{ $dish->category->name }}</td>
                                                <td>
                                                    @if ($dish->price)
                                                    {{ $dish->price }} zł
                                                    @else
                                                    @foreach ($dish->sizes as $size)
                                                    {{ $size->name }} - {{ $size->price }} zł <br>
                                                    @endforeach
                                                    @endif
                                                </td>
                                                <td>
                                                    <form action="{{ route('dish.destroy', $dish->id) }}" method="POST" onsubmit="return confirm('Czy na pewno chcesz usunąć ten rekord?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="{{ route('dish.edit', $dish->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-remove"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        {{ $dishes->links('vendor.pagination.bootstrap-5') }}
                    </div>

                </div>

            </div>

        </div>
</section>
@endsection