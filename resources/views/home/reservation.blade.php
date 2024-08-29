@extends('layouts.default')
@section('content')
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

@endsection