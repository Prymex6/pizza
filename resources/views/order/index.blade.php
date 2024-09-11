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
                                                <th>Status</th>
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
                                                    {{ $order->hour }}
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
                                                    @if ($order->status_paid) <span class="text-success">- Opłacone</span> @else <span class="text-danger">- Nieopłacone</span> @endif
                                                </td>
                                                <td>
                                                    {{ $order->note }}
                                                </td>
                                                <td class="status" data-status_id="{{ $order->status_id }}" data-order_id="{{ $order->id }}">
                                                    @include('order.statuses', ['status_id' => $order->status_id])
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
                                                <td colspan="12">
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
                                                                <td>{{ $dish->name }}@if ($dish->pivot->size) - {{ $dish->pivot->size }} @endif </td>
                                                                <td>{{ $dish->ingredients }}</td>
                                                                <td>{{ $dish->pivot->quantity }}</td>
                                                                <td>{{ $dish->pivot->price }} zł x {{ $dish->pivot->quantity }} = {{ $dish->pivot->price * $dish->pivot->quantity }} zł</td>
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
@section('script')
<script>
    var showStatuses = "{{ route('order.showStatuses') }}";
    var updateStatuses = "{{ route('order.updateStatuses') }}";
    var token = '@csrf';

    $(function() {
        $('.btn-edit-status').on('click', function() {
            let status_id = $(this).closest('.status').data('status_id');
            $.ajax({
                url: showStatuses,
                type: 'GET',
                data: {
                    'status_id': status_id
                },
                success: function(response) {
                    $(this).closest('.status').addClass('edit');
                    $(this).closest('.status').html(response);
                }.bind(this),
            });
        });

        $(document).click(function(event) {
            if ($('.status.edit').length > 0) {
                if (!$(event.target).closest('.status').find('select').length) {
                    let order_id = $('.status.edit').data('order_id');
                    let status_id = $('.status.edit').find('option:selected').val();

                    $.ajax({
                        url: updateStatuses,
                        type: 'PUT',
                        data: {
                            '_token': $(token).val(),
                            '_method': 'PUT',
                            'order_id': order_id,
                            'status_id': status_id
                        },
                        success: function(response) {
                            console.log(response);
                            $('.status.edit').removeClass('edit').html(response);
                        }
                    });
                }
            }
        });
    });
</script>
@endsection