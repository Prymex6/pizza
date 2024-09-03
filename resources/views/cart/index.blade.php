@extends('layouts.default')
@section('style')
<style>
    .cart {
        width: 50%;
        margin: auto;
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .cart h1,
    .cart h3 {
        text-align: center;
        color: #333;
    }

    .cart table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    .cart th,
    .cart td {
        padding: 10px;
        border-bottom: 1px solid #ddd;
        text-align: left;
    }

    .cart th {
        background-color: #f4f4f4;
    }

    .cart .total,
    .cart .address,
    .cart .payment {
        font-weight: bold;
        margin: 20px 0;
    }

    .cart .note {
        font-style: italic;
    }

    .cart .btn {
        display: block;
        width: 100%;
        padding: 10px;
        background-color: #28a745;
        color: #fff;
        border: none;
        border-radius: 5px;
        text-align: center;
        font-size: 16px;
        cursor: pointer;
        text-decoration: none;
    }

    .cart .btn:hover {
        background-color: #218838;
    }

    .required label::after {
        content: "*";
        color: red;
        margin-left: 4px;
    }
</style>
@endsection
@section('content')
<div class="cart">
    @if ($dishes->isNotEmpty())
    <h1>Koszyk</h1>

    <table>
        <thead>
            <tr>
                <th>Nazwa Dania</th>
                <th>Składniki</th>
                <th>Ilość</th>
                <th>Cena</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dishes ?? [] as $dish)
            <tr>
                <td>{{ $dish->name }}</td>
                <td>{{ $dish->ingredients }}</td>
                <td>{{ $dish->pivot->quantity }}</td>
                <td>{{ $dish->price }} zł x {{ $dish->pivot->quantity }} = {{ $dish->price * $dish->pivot->quantity }} zł</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">Razem do zapłaty: {{ $total }} zł</div>

    <!-- <table>
        <thead>
            <tr>
                <th colspan="2">Dodatki</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Sos czosnkowy x 2</td>
                <td>4 PLN</td>
            </tr>
            <tr>
                <td>Sos pomidorowy x 1</td>
                <td>2 PLN</td>
            </tr>
        </tbody>
    </table>

    <div class="total">Razem z dodatkami: 116 PLN</div> -->
    <form action="{{ route('order.add') }}" method="post" novalidate>
        @csrf
        <div class="time">
            <h2>Zamówienie na</h2>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="time" id="asap" value="asap" checked>
                <label class="form-check-label" for="asap">
                    Jak najszybciej
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="time" id="today" value="today">
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
                <input class="form-check-input" type="radio" name="realization" id="delivery" value="delivery" checked>
                <label class="form-check-label" for="delivery">
                    Dostawa
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="realization" id="reception" value="reception">
                <label class="form-check-label" for="reception">
                    Odbiór własny
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="realization" id="site" value="site">
                <label class="form-check-label" for="site">
                    Zjem na miejscu
                </label>
            </div>
        </div>

        <div class="address">
            <h2>Adres dostawy</h2>
            <div class="row">
                <div class="col-sm-8">
                    <div class="form-group required">
                        <label for="street">Ulica</label>
                        <input type="text" class="form-control" id="street" placeholder="Ulica" name="street" required>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group required">
                        <label for="house_number">Numer domu</label>
                        <input type="text" class="form-control" id="house_number" placeholder="Numer domu" name="house_number" required>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="form-group required">
                        <label for="city">Miasto</label>
                        <input type="text" class="form-control" id="city" placeholder="Miasto" name="city" required>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group required">
                        <label for="zip_code">Kod pocztowy</label>
                        <input type="text" class="form-control" id="zip_code" placeholder="Kod pocztowy" name="zip_code" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="apartment_number">Numer mieszkania</label>
                        <input type="text" class="form-control" id="apartment_number" placeholder="Numer mieszkania" name="apartment_number">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="floor">Piętro</label>
                        <input type="text" class="form-control" id="floor" placeholder="Piętro" name="floor">
                    </div>
                </div>
            </div>
        </div>

        <div class="payment">
            <h2>Sposób płatności</h2>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="payment" id="payment_delivery" value="payment_delivery" checked>
                <label class="form-check-label" for="payment_delivery">
                    Płatność przy odbiorze
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="payment" id="credit_card" value="credit_card">
                <label class="form-check-label" for="credit_card">
                    Karta kredytowa/debetowa
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="payment" id="online_transfer" value="online_transfer">
                <label class="form-check-label" for="online_transfer">
                    Przelew online
                </label>
            </div>
        </div>

        <div class="contact_details">
            <h2>Dane Kontaktowe</h2>
            <div class="form-group required">
                <label for="full_name">Imie i nazwisko</label>
                <input type="text" class="form-control" id="full_name" placeholder="Imie i nazwisko" name="full_name" required>
            </div>
            <div class="form-group required">
                <label for="telephone">Telefon</label>
                <input type="text" class="form-control" id="telephone" placeholder="Telefon" name="telephone" required>
            </div>
            <div class="form-group required">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" placeholder="Email" name="email" required>
            </div>
        </div>

        <div class="note">
            <h2>Uwagi do zamówienia</h2>
            <textarea class="form-control" placeholder="Uwagi do zamówienia" name="note" rows="4"></textarea>
            <p>[Wpisz swoje uwagi, np. preferencje dotyczące czasu dostawy, alergie, itp.]</p>
        </div>

        <button href="#" class="btn">Złóż zamówienie</button>
    </form>
    @else
    <h3>Koszyk jest pusty</h3>
    @endif
</div>
@endsection
@section('script')
<script>
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
                    startMinute = 0; // Reset minute to 0 for the next hour loop
                }

                $('.hours').show();
            } else {
                $('.hours').hide();
            }
        });

        setTimeout(function() {
            $('select[name="hours"]').niceSelect('destroy');
        }, 1000);
    });
</script>
@endsection

<!-- Rozmiar pizzy + Dodatki
Składniki do pizzy
Polecane dania
Kategoria dodatków
Dodawanie i odejmowanie quantity
Czas na zamówienie -->