@extends('layouts.default')

@section('style')
<style>
    .stars-rate {
        color: #ffd700;
    }

    .tab-content>.active {
        display: flex !important;
    }

    /* Stylizacja kontenera modala */
    .modal-content {
        background-color: #222831;
        /* Ciemne tło */
        border-radius: 15px;
        /* Zaokrąglone rogi dla nowoczesnego wyglądu */
        border: none;
        /* Brak zewnętrznej obramówki */
        box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.3);
        /* Subtelny cień dla efektu głębi */
        color: #FFF;
        /* Biały tekst */
    }

    /* Stylizacja nagłówka modala */
    .modal-header {
        background-color: #222831;
        /* Ciemne tło nagłówka */
        color: #FFF;
        /* Biały tekst */
        border-top-left-radius: 15px;
        /* Dopasowanie zaokrąglonych rogów */
        border-top-right-radius: 15px;
        padding: 20px;
    }

    .modal-title {
        font-family: 'Pacifico', cursive;
        /* Font przypominający ręczne pismo, elegancki i przyjazny */
        font-size: 28px;
        margin: 0;
        color: #ffbe33;
        /* Żółty kolor dla tytułu */
    }

    /* Stylizacja ciała modala */
    .modal-body {
        font-family: 'Arial', sans-serif;
        color: #FFF;
        /* Biały tekst */
        padding: 20px;
        line-height: 1.6;
    }

    .modal-body p {
        margin-bottom: 15px;
        /* Odstęp między akapitami */
    }

    /* Stylizacja stopki modala */
    .modal-footer {
        background-color: #393e46;
        /* Trochę jaśniejszy odcień tła */
        border-bottom-left-radius: 15px;
        /* Dopasowanie zaokrąglonych rogów */
        border-bottom-right-radius: 15px;
        padding: 15px;
        border-top: 1px solid #222831;
        /* Subtelna linia oddzielająca stopkę */
    }

    /* Stylizacja przycisków */
    .btn-primary {
        background-color: #ffbe33;
        /* Żółty kolor inspirowany serem */
        border-color: #ffbe33;
        color: #222831;
        /* Ciemny kolor tekstu na żółtym tle */
        font-family: 'Arial', sans-serif;
        font-size: 16px;
        padding: 10px 20px;
        transition: background-color 0.3s ease;
        /* Łagodna animacja zmiany koloru */
    }

    .btn-primary:hover {
        background-color: #e6a900;
        /* Ciemniejszy odcień żółtego przy hover */
        border-color: #e6a900;
    }

    .btn-danger {
        background-color: #393e46;
        /* Ciemny kolor przycisku */
        border-color: #393e46;
        color: #FFF;
        /* Biały tekst */
        font-family: 'Arial', sans-serif;
        font-size: 16px;
        padding: 10px 20px;
        transition: background-color 0.3s ease;
    }

    .btn-danger:hover {
        background-color: #222831;
        /* Ciemniejszy kolor przy hover */
        border-color: #222831;
    }

    .btn-secondary {
        background-color: #393e46;
        /* Ciemniejszy przycisk zamknięcia */
        border-color: #393e46;
        color: #FFF;
        /* Biały tekst */
        font-family: 'Arial', sans-serif;
        font-size: 16px;
        padding: 10px 20px;
        transition: background-color 0.3s ease;
    }

    .btn-secondary:hover {
        background-color: #222831;
        /* Ciemniejszy odcień dla efektu hover */
        border-color: #222831;
    }

    /* Stylizacja przycisku zamknięcia */
    .btn-close {
        color: #FFF;
        /* Biały kolor krzyżyka */
        opacity: 1;
        /* Pełna widoczność */
    }

    .btn-close:hover {
        color: #ffbe33;
        /* Żółty kolor po najechaniu */
    }

    /* Dodatkowe szczegóły */
    .modal-header .btn-close {
        padding: 10px;
        margin: -10px;
    }

    .modal-dialog {
        max-width: 550px;
    }

    .modal-size .quantity-button {
        background-color: #222831;
        padding: 5px 10px;
        cursor: pointer;
        border: 2px solid #333942;
        border-radius: 100%;
        color: #FFF;
    }

    .modal-size #quantity {
        width: 50px;
        text-align: center;
        height: 34px;
        margin: 3px 5px;
        background-color: #222831;
        color: #FFF;
        border: 0;
    }

    .modal-size input::-webkit-outer-spin-button,
    .modal-size input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>
@endsection
@section('slider')
<!-- slider section -->
<section class="slider_section">
    <div id="customCarousel1" class="slide carousel" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach ($settings['headers'] ?? [] as $key => $setting)
            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                <div class="container">
                    <div class="row">
                        <div class="col-md-7 col-lg-6 ">
                            <div class="detail-box">
                                <h1>
                                    {{ setting('headers.' . $key . '_title') }}
                                </h1>
                                <p>
                                    {{ setting('headers.' . $key . '_description') }}
                                </p>
                                <div class="btn-box">
                                    <a href="" class="btn1">
                                        Zobacz menu
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="container">
            <ol class="carousel-indicators">
                @foreach ($settings['headers'] ?? [] as $key => $setting)
                <li data-bs-target="#customCarousel1" data-bs-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
                @endforeach
            </ol>
        </div>
    </div>
</section>
<!-- end slider section -->
@endsection
@section('content')
<!-- offer section -->

<section class="offer_section layout_padding-bottom">
    <div class="offer_container">
        <div class="container ">
            <div class="row">
                @foreach ($settings['promotions'] ?? [] as $key => $setting)
                <div class="col-md-6">
                    <div class="box">
                        <div class="img-box">
                            @if (!empty(setting('promotions.' . $key . '_image')))
                            <img src="{{ Storage::url(setting('promotions.' . $key . '_image')) }}" alt="Zdjęcia dania">
                            @else
                            <img src="{{ asset('additional/placeholder.png') }}" alt="Zdjęcia dania">
                            @endif
                        </div>
                        <div class="detail-box">
                            <h5>
                                {{ setting('promotions.' . $key . '_name') }}
                            </h5>
                            <h6>
                                @if (!empty(setting('promotions.' . $key . '_percent')))<span>{{ setting('promotions.' . $key . '_percent') }}%</span> Mniej @elseif (setting('promotions.' . $key . '_price') > 0) <span>{{ setting('promotions.' . $key . '_price') }} zł</span> Mniej @endif
                            </h6>
                            <a href="">
                                Zamów teraz <i class="fa fa-cart-shopping"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- end offer section -->

<!-- food section -->

<section class="food_section layout_padding-bottom">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Nasze Menu
            </h2>
        </div>

        <ul class="nav nav-tabs filters_menu" id="menu" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" role="tab">Wszystko</button>
            </li>
            @foreach ($categories as $category)
            @if ($category->dishes->count() < 1) @continue @endif
                <li class="nav-item" role="presentation">
                <button class="nav-link" id="{{ $category->name }}-tab" data-bs-toggle="tab" data-bs-target="#{{ $category->name }}" role="tab">{{ $category->name }}
                </button>
                </li>
                @endforeach
        </ul>

        <div class="filters-content tab-content" id="menuContent">
            <div class="row grid tab-pane fade show active" id="all" role="tabpanel">
                @foreach ($dishes as $dish)
                <div class="col-sm-6 col-lg-4">
                    <div class="box">
                        <div>
                            <div class="img-box">
                                @if ($dish->image)
                                <img src="{{ Storage::url($dish->image) }}" alt="Zdjęcia dania">
                                @else
                                <img src="{{ asset('additional/placeholder.png') }}" alt="Zdjęcia dania">
                                @endif
                            </div>
                            <div class="detail-box">
                                <h5>
                                    {{ $dish->name }}
                                </h5>
                                <p>
                                    {{ $dish->description }}
                                </p>
                                <div class="options">
                                    <h6>
                                        @if ($dish->sizes->isNotEmpty())
                                        {{ $dish->sizes[0]->price }} zł
                                        @else
                                        {{ $dish->price }} zł
                                        @endif
                                    </h6>
                                    <a class="cart-shopping" data-sizes="{{ $dish->sizes->count() > 0 }}" data-dish_id="{{ $dish->id }}" onclick="modalCart($(this))">
                                        <i class="fa fa-cart-shopping"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($dishes->count() > 10)
                <div class="btn-box">
                    <a href="">
                        View More
                    </a>
                </div>
                @endif
                @endforeach
            </div>
            @foreach ($categories as $category)
            @if ($category->dishes->count() < 1) @continue @endif
                <div class="row grid tab-pane fade" id="{{ $category->name }}" role="tabpanel">
                @foreach ($category->dishes as $dish)
                <div class="col-sm-6 col-lg-4">
                    <div class="box">
                        <div>
                            <div class="img-box">
                                @if ($dish->image)
                                <img src="{{ Storage::url($dish->image) }}" alt="Zdjęcia dania">
                                @else
                                <img src="{{ asset('additional/placeholder.png') }}" alt="Zdjęcia dania">
                                @endif
                            </div>
                            <div class="detail-box">
                                <h5>
                                    {{ $dish->name }}
                                </h5>
                                <p>
                                    {{ $dish->description }}
                                </p>
                                <div class="options">
                                    <h6>
                                        {{ $dish->price }} zł
                                    </h6>
                                    <a href="" class="cart-shopping">
                                        <i class="fa fa-cart-shopping"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($category->dishes->count() > 10)
                <div class="btn-box">
                    <a href="">
                        View More
                    </a>
                </div>
                @endif
                @endforeach
        </div>
        @endforeach
    </div>
    </div>
</section>

<!-- end food section -->

<!-- about section -->

<section class="about_section layout_padding">
    <div class="container  ">

        <div class="row">
            <div class="col-md-6 ">
                <div class="img-box">
                    <img src="images/about-img.png" alt="">
                </div>
            </div>
            <div class="col-md-6">
                <div class="detail-box">
                    <div class="heading_container">
                        <h2>
                            {{ setting('about.title') }}
                        </h2>
                    </div>
                    <p>
                        {{ setting('about.description') }}
                    </p>
                    <a href="">
                        Czytaj więcej
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- end about section -->

<!-- book section -->
<section class="book_section layout_padding">
    <div class="container">
        <div class="heading_container">
            <h2>
                Zarezerwuj stolik
            </h2>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form_container">
                    <form action="{{ route('reservation.book') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Imię" name="firstname">
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Nazwisko" name="lastname">
                            </div>
                        </div>
                        <div>
                            <input type="text" class="form-control" placeholder="Telefon" name="telephone">
                        </div>
                        <div>
                            <input type="email" class="form-control" placeholder="Email" name="email">
                        </div>
                        <div>
                            <select class="form-control nice-select wide" name="persons">
                                <option value="" disabled selected>Ilość osób</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                        <div>
                            <input type="datetime-local" class="form-control" name="date_time">
                        </div>
                        <div class="btn_box">
                            <button type="submit">Zarezerwuj</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="map_container">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d19738.373065842523!2d16.30059304414937!3d51.8007403!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x470593681fbfcd25%3A0x528da0bd3a29b139!2sBiedronka!5e0!3m2!1spl!2spl!4v1724500261465!5m2!1spl!2spl" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end book section -->

<!-- client section -->

<section class="client_section layout_padding-bottom">
    <div class="container">
        <div class="heading_container heading_center psudo_white_primary mb_45">
            <h2>
                Opinie naszych klientów
            </h2>
        </div>
        <div class="carousel-wrap row ">
            <div class="owl-carousel client_owl-carousel">
                @foreach ($settings['opinions'] ?? [] as $key => $setting)
                <div class="item">
                    <div class="box">
                        <div class="detail-box">
                            <p>
                                {{ setting('opinions.' . $key . '_opinion') }}
                            </p>
                            <h6>
                                {{ setting('opinions.' . $key . '_firstname') }} {{ setting('opinions.' . $key . '_lastname') }}
                            </h6>
                            <p class="stars-rate">
                                @for ($i = 0; $i < setting('opinions.' . $key . '_rate' ); $i++)<i class="fa fa-star"></i>@endfor
                            </p>
                        </div>
                        <div class="img-box">
                            @if (!empty(setting('opinions.' . $key . '_image')))
                            <img src="{{ Storage::url(setting('opinions.' . $key . '_image')) }}" alt="Zdjęcia dania">
                            @else
                            <img src="{{ asset('additional/placeholder.png') }}" alt="Zdjęcia dania">
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@include('foundation.modal', ['title' => 'Dodaj do koszyka'])
<!-- end client section -->
@endsection
@section('script')
<script>
    var addToCartRoute = "{{ route('cart.add') }}";
    var modalCartRoute = "{{ route('home.modalCart') }}";
    var token = '@csrf';

    function modalCart(e) {
        $.ajax({
            method: "GET",
            url: modalCartRoute,
            data: {
                '_token': $(token).val(),
                'dish_id': $(e).data('dish_id')
            },
            success: function(response) {
                $('.modal .modal-body').html(response);

                var price = $('#price').val() ? $('#price').val() : $('.sizes input[type="radio"]:checked').data('price');

                $('button.add-to-cart').text('Dodaj do koszyka (' + price * 1 + ' zł)');

                $('.quantity-box button').on('click', function() {
                    var quantity = $('.quantity-box #quantity').val();

                    if ($(this).hasClass('plus')) {
                        quantity++;
                    } else if ($(this).hasClass('minus')) {
                        quantity--;
                    }

                    if (quantity < 1) {
                        quantity = 1;
                    }

                    $('.quantity-box #quantity').val(quantity);

                    var price = $('#price').val() ? $('#price').val() : $('.sizes input[type="radio"]:checked').data('price');

                    $('button.add-to-cart').text('Dodaj do koszyka (' + price * quantity + ' zł)');
                });

                $('.sizes input[type="radio"]').on('click', function() {
                    var price = $('#price').val() ? $('#price').val() : $('.sizes input[type="radio"]:checked').data('price');
                    var quantity = $('.quantity-box #quantity').val();

                    $('button.add-to-cart').text('Dodaj do koszyka (' + price * quantity + ' zł)');
                });


                $('.modal').modal('show');
            }
        });
    }

    $('button.add-to-cart').on('click', function() {
        addDishToCart();
    });

    function addDishToCart() {
        var dish_id = $('#dish_id').val();
        var quantity = $('.quantity-box #quantity').val();
        var size_id = $('.sizes input[type="radio"]:checked').val();
        $.ajax({
            method: "POST",
            url: addToCartRoute,
            data: {
                '_token': $(token).val(),
                'dish_id': dish_id,
                'quantity': quantity,
                'size_id': size_id,
            },
            success: function(response) {
                if (response.success) {
                    toastr.success(response.message);
                    $('.modal').modal('hide');
                }
            }
        });
    }
</script>
@endsection