@extends('layouts.admin')
@section('style')
<style>
    .cart h1 {
        text-align: center;
        color: #333;
    }

    .cart .dishes,
    .cart .time,
    .cart .address,
    .cart .payment,
    .cart .contact_details,
    .cart .note,
    .cart .realization {
        font-weight: bold;
        margin: 20px 0;
    }

    .cart .dishes {
        margin: 0 0 20px;
    }

    .cart .note {
        font-style: italic;
    }

    .required label::after {
        content: "*";
        color: red;
        margin-left: 4px;
    }
</style>
@endsection
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edytuj zamówienie</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Strona główna</a></li>
                    <li class="breadcrumb-item">Zamówienia</li>
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
                                <button type="button" class="btn btn-block btn-primary" onclick="$('#order_store_form').submit();">Zapisz</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="wrapper" class="dataTables_wrapper dt-bootstrap4 cart">
                            <form action="{{ route('order.add') }}" method="post" id="order_store_form">
                                @csrf
                                <div>
                                    <h2>Dania</h2>
                                    <div class="dishes">
                                        @foreach ($order->dishes as $dish)
                                        <div class="row dish dish{{ $loop->iteration }}-box my-1" data-iteration="{{ $loop->iteration }}">
                                            <div class="col-sm-3">
                                                <select class="form-control" name="dishes[{{ $loop->iteration }}][id]" id="dish">
                                                    <option value="" disabled selected>Wybierz danie</option>
                                                    @foreach ($dishes as $value)
                                                    <option value="{{ $value->id }}" data-price="{{ $value->price }}" @if ($value->id == $dish->id) selected @endif>{{ $value->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="number" class="form-control" id="quantity" placeholder="Wpisz ilość" name="dishes[{{ $loop->iteration }}][pivot][quantity]" step="1" value="{{ $dish->pivot->quantity }}">
                                            </div>
                                            <div class="col-sm-3">
                                                <select class="form-control" name="dishes[{{ $loop->iteration }}][size][name]" id="sizes">
                                                    <option value="" disabled selected>Brak rozmiarów</option>
                                                    @foreach ($dish->sizes as $size)
                                                    <option value="{{ $size->name }}" data-price="{{ $size->price }}" @if($size->name == $dish->pivot->size) selected @endif>{{ $size->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="input-group">
                                                    <input type="number" class="form-control" id="price" placeholder="Wpisz cenę" name="dishes[{{ $loop->iteration }}][price]" step="0.01" value="{{ $dish->pivot->price }}">
                                                    <div class="input-group-btn">
                                                        <button class="btn btn-danger" onclick="removeDish($(this))" type="button"><i class="fa fa-minus"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        <div class="row dish dish{{ $order->dishes->count() + 1 }}-box my-1" data-iteration="{{ $order->dishes->count() + 1 }}">
                                            <div class="col-sm-3">
                                                <select class="form-control" name="dishes[{{ $order->dishes->count() + 1 }}][id]" id="dish">
                                                    <option value="" disabled selected>Wybierz danie</option>
                                                    @foreach ($dishes as $value)
                                                    <option value="{{ $value->id }}" data-price="{{ $value->price }}">{{ $value->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="number" class="form-control" id="quantity" placeholder="Wpisz ilość" name="dishes[{{ $order->dishes->count() + 1 }}][pivot][quantity]" step="1">
                                            </div>
                                            <div class="col-sm-3">
                                                <select class="form-control" name="dishes[{{ $order->dishes->count() + 1 }}][size][name]" id="sizes">
                                                    <option value="" disabled selected>Brak rozmiarów</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="input-group">
                                                    <input type="number" class="form-control" id="price" placeholder="Wpisz cenę" name="dishes[{{ $order->dishes->count() + 1 }}][price]" step="0.01">
                                                    <div class="input-group-btn">
                                                        <button class="btn btn-success" onclick="addDish($(this))" type="button"><i class="fa fa-plus"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="time">
                                    <h2>Zamówienie na</h2>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="time" id="asap" value="asap" @if ($order->time == 'asap') checked @endif>
                                        <label class="form-check-label" for="asap">
                                            Jak najszybciej
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="time" id="today" value="today" @if ($order->time == 'today') checked @endif>
                                        <label class="form-check-label" for="today">
                                            Wybierz godzinę
                                        </label>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group hours" style="display: none;">
                                            <hr>
                                            <select class="form-control" name="hours">
                                                <option value="" disabled selected>Wybierz godzinę</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>

                                <div class="realization">
                                    <h2>Sposób realizacji</h2>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="realization" id="delivery" value="delivery" @if ($order->realization == 'delivery') checked @endif>
                                        <label class="form-check-label" for="delivery">
                                            Dostawa
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="realization" id="reception" value="reception" @if ($order->realization == 'reception') checked @endif>
                                        <label class="form-check-label" for="reception">
                                            Odbiór własny
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="realization" id="site" value="site" @if ($order->realization == 'site') checked @endif>
                                        <label class="form-check-label" for="site">
                                            Zjem na miejscu
                                        </label>
                                    </div>
                                </div>

                                <div class="address" @if ($order->realization != 'delivery') style="display: none;" @endif>
                                    <h2>Adres dostawy</h2>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="form-group required">
                                                <label for="street">Ulica</label>
                                                <input type="text" class="form-control" id="street" placeholder="Ulica" name="street" required value="{{ $order->street }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group required">
                                                <label for="house_number">Numer domu</label>
                                                <input type="text" class="form-control" id="house_number" placeholder="Numer domu" name="house_number" required value="{{ $order->house_number }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="form-group required">
                                                <label for="city">Miasto</label>
                                                <input type="text" class="form-control" id="city" placeholder="Miasto" name="city" required value="{{ $order->city }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group required">
                                                <label for="zip_code">Kod pocztowy</label>
                                                <input type="text" class="form-control" id="zip_code" placeholder="Kod pocztowy" name="zip_code" required value="{{ $order->zip_code }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="apartment_number">Numer mieszkania</label>
                                                <input type="text" class="form-control" id="apartment_number" placeholder="Numer mieszkania" name="apartment_number" value="{{ $order->apartment_number }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="floor">Piętro</label>
                                                <input type="text" class="form-control" id="floor" placeholder="Piętro" name="floor" value="{{ $order->floor }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="payment">
                                    <h2>Sposób płatności</h2>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment" id="payment_delivery" value="payment_delivery" @if ($order->payment == 'payment_delivery') checked @endif>
                                        <label class="form-check-label" for="payment_delivery">
                                            Płatność przy odbiorze
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment" id="credit_card" value="credit_card" @if ($order->payment == 'credit_card') checked @endif>
                                        <label class="form-check-label" for="credit_card">
                                            Karta kredytowa/debetowa
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment" id="online_transfer" value="online_transfer" @if ($order->payment == 'online_transfer') checked @endif>
                                        <label class="form-check-label" for="online_transfer">
                                            Przelew online
                                        </label>
                                    </div>
                                </div>

                                <div class="contact_details">
                                    <h2>Dane Kontaktowe</h2>
                                    <div class="form-group required">
                                        <label for="full_name">Imie i nazwisko</label>
                                        <input type="text" class="form-control" id="full_name" placeholder="Imie i nazwisko" name="full_name" required value="{{ $order->firstname }} {{ $order->lastname }}">
                                    </div>
                                    <div class="form-group required">
                                        <label for="telephone">Telefon</label>
                                        <input type="text" class="form-control" id="telephone" placeholder="Telefon" name="telephone" required value="{{ $order->telephone }}">
                                    </div>
                                    <div class="form-group required">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" id="email" placeholder="Email" name="email" required value="{{ $order->email }}">
                                    </div>
                                </div>

                                <div class="note">
                                    <h2>Uwagi do zamówienia</h2>
                                    <textarea class="form-control" placeholder="Uwagi do zamówienia" name="note" rows="4">{{ $order->note }}</textarea>
                                    <p>[Wpisz swoje uwagi, np. preferencje dotyczące czasu dostawy, alergie, itp.]</p>
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
    var showSizes = "{{ route('dish.showSizes') }}";
    $(function() {
        $('input[name="realization"]').on('change', function() {
            if ($('input[name="realization"]:checked').val() == 'reception' || $('input[name="realization"]:checked').val() == 'site') {
                $('.address').hide();
            } else {
                $('.address').show();

            }
        });

        $('input[name="time"]').on('change', function() {
            $('select[name="hours"] .option').remove();
            if ($('input[name="time"]:checked').val() == 'today') {
                const now = new Date();
                let startHour = now.getHours();
                let startMinute = now.getMinutes() >= 30 ? 30 : 0;

                if (startMinute === 30) {
                    startHour += 1;
                    startMinute = 0;
                } else {
                    startMinute = 30;
                }

                for (let hour = startHour; hour < 24; hour++) {
                    for (let minute = startMinute; minute < 60; minute += 30) {
                        const formattedHour = hour.toString().padStart(2, '0');
                        const formattedMinute = minute.toString().padStart(2, '0');
                        $('select[name="hours"]').append(`<option class="option" value="${formattedHour}:${formattedMinute}">${formattedHour}:${formattedMinute}</option>`);
                    }
                    startMinute = 0;
                }

                $('.hours').show();
            } else {
                $('.hours').hide();
            }
        });

        $('.dish #sizes').on('change', function() {
            var price = $(this).find('option:selected').data('price');
            $(this).closest('.dish').find('#price').val(price);
        });

        $('.dish select#dish').on('change', function() {
            var dish_id = $(this).find('option:selected').val()
            var price = $(this).find('option:selected').data('price');
            $(this).closest('.dish').find('#price').val(price);
            $(this).closest('.dish').find('#quantity').val(1);

            $.ajax({
                url: showSizes,
                type: 'GET',
                data: {
                    'dish_id': dish_id
                },
                success: function(response) {
                    $(this).closest('.dish').find('#sizes').html(response);
                }.bind(this),
            });
        });
    });

    function addDish() {
        var iteration = $('.dish').last().data('iteration') ?? 0;
        iteration++;

        $('.dishes').find('.btn-success').closest('button').each(function() {
            $(this).replaceWith('<button class="btn btn-danger" onclick="removeDish($(this))" type="button"><i class="fa fa-minus"></i></button>');
        });

        $('.dishes').append('<div class="row dish dish' + iteration + '-box my-1" data-iteration="' + iteration + '"><div class="col-sm-3"><select class="form-control" name="dishes[' + iteration + '][id]" id="dish"><option value="" disabled selected>Wybierz danie</option>@foreach ($dishes as $dish)<option value="{{ $dish->id }}" data-price="{{ $dish->price }}">{{ $dish->name }}</option>@endforeach</select></div><div class="col-sm-3"><input type="number" class="form-control" id="quantity" placeholder="Wpisz ilość" name="dishes[' + iteration + '][pivot][quantity]" step="1"></div><div class="col-sm-3"><select class="form-control" name="dishes[' + iteration + '][size][name]" id="sizes"><option value="" disabled selected>Brak rozmiarów</option></select></div><div class="col-sm-3"><div class="input-group"><input type="number" class="form-control" id="price" placeholder="Wpisz cenę" name="dishes[' + iteration + '][price]" step="0.01"><div class="input-group-btn"><button class="btn btn-success" onclick="addDish()" type="button"><i class="fa fa-plus"></i></button></div></div></div></div>');

        $('.dish #sizes').on('change', function() {
            var price = $(this).find('option:selected').data('price');
            $(this).closest('.dish').find('#price').val(price);
        });

        $('.dish select#dish').on('change', function() {
            var dish_id = $(this).find('option:selected').val()
            var price = $(this).find('option:selected').data('price');
            $(this).closest('.dish').find('#price').val(price);
            $(this).closest('.dish').find('#quantity').val(1);

            $.ajax({
                url: showSizes,
                type: 'GET',
                data: {
                    'dish_id': dish_id
                },
                success: function(response) {
                    $(this).closest('.dish').find('#sizes').html(response);
                }.bind(this),
            });
        });
    }

    function removeDish(e) {
        $(e).closest('.dish').remove();
    }
</script>
@endsection