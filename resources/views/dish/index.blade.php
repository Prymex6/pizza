@extends('layouts.app')
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
                                <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nazwa</th>
                                            <th>Opis</th>
                                            <th>Składniki</th>
                                            <th>Cena</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dishes as $dish)
                                        <tr class="{{ $loop->index / 2 == 0 ? 'odd' : 'even' }}">
                                            <td>{{ ($dishes->currentPage() - 1) * $dishes->count() + $loop->iteration }}</td>
                                            <td>{{ $dish->name }}</td>
                                            <td>{{ $dish->description }}</td>
                                            <td>{{ $dish->ingredients }}</td>
                                            <td>{{ $dish->price }} zł</td>
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