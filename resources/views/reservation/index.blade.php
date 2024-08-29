@extends('layouts.admin')
@section('style')
<style>
    .status form {
        display: inline-block;
    }

    .status span {
        display: block;
        /* font-size: 18px; */
        padding: 0 0 8px;
    }
</style>
@endsection
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Rezerwacje</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Rezerwacje</li>
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
                                <a href="{{ route('reservation.create') }}" class="btn btn-block btn-success">Dodaj</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="wrapper" class="datatables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12 col-md-6"></div>
                                <div class="col-sm-12 col-md-6"></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example2" class="table table-bordered table-hover datatable dtr-inline">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Imie</th>
                                                <th>Nazwisko</th>
                                                <th>Telefon</th>
                                                <th>Email</th>
                                                <th>Ilość osób</th>
                                                <th>Data i Godzina</th>
                                                <th>Status</th>
                                                <th>Akcja</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($reservations ?? [] as $reservation)
                                            <tr class="{{ $loop->index / 2 == 0 ? 'odd' : 'even' }}">
                                                <td>{{ ($reservations->currentPage() - 1) * $reservations->count() + $loop->iteration }}</td>
                                                <td>{{ $reservation->firstname }}</td>
                                                <td>{{ $reservation->lastname }}</td>
                                                <td>{{ $reservation->telephone }}</td>
                                                <td>{{ $reservation->email }}</td>
                                                <td>{{ $reservation->persons }}</td>
                                                <td>{{ $reservation->date_time }}</td>
                                                <td class="status">
                                                    @if ($reservation->status == null)
                                                    <span>Oczekujący</span>
                                                    @elseif ($reservation->status == '0')
                                                    <span class="text-danger">Odrzucony</span>
                                                    @elseif ($reservation->status == 1)
                                                    <span class="text-success">Zaakceptowany</span>
                                                    @endif

                                                    <div>
                                                        @if ($reservation->status == null || $reservation->status == '0')
                                                        <form action="{{ route('reservation.status', $reservation->id) }}" method="post">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="status" value="1">
                                                            <button class="btn btn-sm btn-success">Akceptuj</button>
                                                        </form>
                                                        @endif
                                                        @if ($reservation->status == null || $reservation->status == '1')
                                                        <form action="{{ route('reservation.status', $reservation->id) }}" method="post">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="status" value="0">
                                                            <button class="btn btn-sm btn-danger">Odrzuć</button>
                                                        </form>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <form action="{{ route('reservation.destroy', $reservation->id) }}" method="POST" onsubmit="return confirm('Czy na pewno chcesz usunąć ten rekord?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="{{ route('reservation.edit', $reservation->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
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
                        {{ $reservations->links('vendor.pagination.bootstrap-5') }}
                    </div>

                </div>

            </div>

        </div>
</section>
@endsection