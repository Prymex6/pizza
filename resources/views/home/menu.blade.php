@extends('layouts.default')
@section('content')
<!-- food section -->

<section class="food_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Nasze menu
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
                        Zobacz więcej
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

@endsection