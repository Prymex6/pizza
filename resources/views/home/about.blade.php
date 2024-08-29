@extends('layouts.default')
@section('content')
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
                    <!-- <a href="">
                        Read More
                    </a> -->
                </div>
            </div>
        </div>
    </div>
</section>

@endsection