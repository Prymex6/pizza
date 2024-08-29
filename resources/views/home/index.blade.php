@extends('layouts.default')

@section('style')
<style>
    .stars-rate {
        color: #ffd700;
    }
</style>
@endsection
@section('slider')
<!-- slider section -->
<section class="slider_section ">
    <div id="customCarousel1" class="slide carousel">
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
                <li data-target="#customCarousel1" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
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
                            <img src="images/o1.jpg" alt="">
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
                                <img src="images/f1.png" alt="">
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
            <div class="row grid tab-pane fade" id="{{ $category->name }}" role="tabpanel">
                @foreach ($category->dishes as $dish)
                <div class="col-sm-6 col-lg-4">
                    <div class="box">
                        <div>
                            <div class="img-box">
                                <img src="images/f1.png" alt="">
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
                @foreach ($settings['opinions'] as $key => $setting)
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
                            <img src="images/client1.jpg" alt="" class="box-img">
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- end client section -->
@endsection