@extends('layouts.admin')
@section('style')
<style>
    .table-dishes tr {
        background-color: #eee;
    }
</style>
@endsection
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Zamówienia</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Zamówienia</li>
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
                                <a href="{{ route('order.create') }}" class="btn btn-block btn-success">Dodaj</a>
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
                                    <table class="table table-bordered table-hover dataTable dtr-inline" style="margin-bottom: 0;">
                                        @foreach ($orders ?? [] as $order)
                                        @if ($loop->index == 0)
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Imie i nazwisko</th>
                                                <th>Telefon</th>
                                                <th>Email</th>
                                                <th>Miasto i kod pocztowy</th>
                                                <th>Adres</th>
                                                <th>Zamówienie na</th>
                                                <th>Sposób realizacji</th>
                                                <th>Sposób płatności</th>
                                                <th>Uwagi</th>
                                                <th>Akcje</th>
                                            </tr>
                                        </thead>
                                        @endif
                                        <tbody>
                                            <tr class="{{ $loop->index / 2 == 0 ? 'odd' : 'even' }}">
                                                <td>{{ ($orders->currentPage() - 1) * $orders->count() + $loop->iteration }}</td>
                                                <td>{{ $order->firstname }} {{ $order->lastname }}</td>
                                                <td>{{ $order->telephone }}</td>
                                                <td>{{ $order->email }}</td>
                                                <td>{{ $order->city }} {{ $order->zip_code }}</td>
                                                <td>{{ $order->street }} {{ $order->house_number }}{{ $order->apartament_number ? '/' . $order->apartament_number : ''}}<br> {{ $order->floor ? 'Piętro ' . $order->floor : '' }}</td>
                                                <td>
                                                    @if ($order->time == 'asap')
                                                    Teraz
                                                    @elseif ($order->time == 'today')
                                                    {{ $order->hours }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($order->realization == 'delivery')
                                                    Dostawa
                                                    @elseif ($order->realization == 'reception')
                                                    Odbiór własny
                                                    @elseif ($order->realization == 'site')
                                                    Zjem na miejscu
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($order->payment == 'payment_delivery')
                                                    Płatność przy odbiorze
                                                    @elseif ($order->payment == 'credit_card')
                                                    Karta kredytowa/debetowa
                                                    @elseif ($order->payment == 'online_transfer')
                                                    Przelew online
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $order->note }}
                                                </td>
                                                <td>
                                                    <form action="{{ route('order.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Czy na pewno chcesz usunąć ten rekord?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="{{ route('order.edit', $order->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-remove"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @if (!$order->dishes->isEmpty())
                                            <tr>
                                                <td colspan="11">
                                                    <table class="table table-bordered table-hover table-dishes">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Nazwa dania</th>
                                                                <th>Składniki</th>
                                                                <th>Ilość</th>
                                                                <th>Cena</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($order->dishes as $dish)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $dish->name }}</td>
                                                                <td>{{ $dish->ingredients }}</td>
                                                                <td>{{ $dish->pivot->quantity }}</td>
                                                                <td>{{ $dish->price }} zł x {{ $dish->pivot->quantity }} = {{ $dish->price * $dish->pivot->quantity }} zł</td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            @endif
                                        </tbody>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                        {{ $orders->links('vendor.pagination.bootstrap-5') }}
                    </div>

                </div>

            </div>

        </div>
</section>
@endsection