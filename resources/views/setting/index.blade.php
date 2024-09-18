@extends('layouts.admin')
<style>
    .image {
        margin: 10px 0;

    }

    .image img {
        width: 50px;
        height: 50px;
    }
</style>
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Ustawienia</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Ustawienia</li>
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
                            <div class="col-sm-11 fs-3 m-auto">
                                Podstawowe ustawienia
                            </div>
                            <div class="col-sm-1">
                                <a href="{{ route('setting.edit', 'general') }}" class="btn btn-block btn-success">Edytuj</a>
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
                                    <h4><b>Ogólne</b></h4>
                                    @if (!empty(setting('general.name')) || !empty(setting('general.description')))
                                    <div class="mx-2 my-1">
                                        @if (setting('general.name'))<p class="text-start"><b>Nazwa pizzeri</b>: {{ setting('general.name') }}</p>@endif
                                        @if (setting('general.description'))<p class="text-start"><b>Opis pizzeri</b>: {{ setting('general.description') }}</p>@endif
                                    </div>
                                    @else
                                    -
                                    @endif
                                    <h4><b>Meta</b></h4>
                                    @if (!empty(setting('general.meta')))
                                    <div class="mx-2 my-1">
                                        @if (setting('general.meta_title'))<p class="text-start"><b>Meta title</b>: {{ setting('general.meta_title') }}</p>@endif
                                        @if (setting('general.meta_description'))<p class="text-start"><b>Meta description</b>: {{ setting('general.meta_description') }}</p>@endif
                                        @if (setting('general.meta_keyword'))<p class="text-start"><b>Meta keyword</b>: {{ setting('general.meta_keyword') }}</p>@endif
                                    </div>
                                    @else
                                    -
                                    @endif
                                    <h4><b>Social Media</b></h4>
                                    @if (!empty(setting('general.socialmedia')))
                                    <div class="mx-2 my-1">
                                        @if (setting('general.socialmedia_facebook'))<p class="text-start"><b>Link do facebook</b>: {{ setting('general.socialmedia_facebook') }}</p>@endif
                                        @if (setting('general.socialmedia_twitter'))<p class="text-start"><b>Link do twitter</b>: {{ setting('general.socialmedia_twitter') }}</p>@endif
                                        @if (setting('general.socialmedia_linkedin'))<p class="text-start"><b>Link do linkedin</b>: {{ setting('general.socialmedia_linkedin') }}</p>@endif
                                        @if (setting('general.socialmedia_instagram'))<p class="text-start"><b>Link do instagram</b>: {{ setting('general.socialmedia_instagram') }}</p>@endif
                                        @if (setting('general.socialmedia_pinterest'))<p class="text-start"><b>Link do pinterest</b>: {{ setting('general.socialmedia_pinterest') }}</p>@endif
                                        @if (setting('general.socialmedia_youtube'))<p class="text-start"><b>Link do youtube</b>: {{ setting('general.socialmedia_youtube') }}</p>@endif
                                    </div>
                                    @else
                                    -
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-11 fs-3 m-auto">
                                Nagłówki
                            </div>
                            <div class="col-sm-1">
                                <a href="{{ route('setting.edit', 'headers') }}" class="btn btn-block btn-success">Edytuj</a>
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
                                    @if (!empty($settings['headers']))
                                    @foreach ($settings['headers'] ?? [] as $key => $setting)
                                    <h4><b>Nagłówek {{ $loop->iteration }}</b></h4>
                                    <div class="mx-2 my-1">
                                        @if (setting('headers.' . $key . '_title'))<p class="text-start"><b>Tytuł</b>: {{ setting('headers.' . $key . '_title') }}</p>@endif
                                        @if (setting('headers.' . $key . '_description'))<p class="text-start"><b>Opis</b>: {{ setting('headers.' . $key . '_description', true) }}</p>@endif
                                    </div>
                                    @endforeach
                                    @else
                                    -
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-11 fs-3 m-auto">
                                Promocje
                            </div>
                            <div class="col-sm-1">
                                <a href="{{ route('setting.edit', 'promotions') }}" class="btn btn-block btn-success">Edytuj</a>
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
                                    @if (!empty($settings['promotions']))
                                    @foreach ($settings['promotions'] ?? [] as $key => $setting)
                                    <h4><b>Promocja {{ $loop->iteration }}</b></h4>
                                    <div class="mx-2 my-1">
                                        @if (setting('promotions.' . $key . '_image'))
                                        <div class="image">
                                            <img src="{{ Storage::url(setting('promotions.' . $key . '_image')) }}" alt="Zdjęcia dania">
                                        </div>
                                        @endif
                                        @if (setting('promotions.' . $key . '_name'))<p class="text-start"><b>Nazwa</b>: {{ setting('promotions.' . $key . '_name') }}</p>@endif
                                        @if (setting('promotions.' . $key . '_dishes'))<p class="text-start"><b>Dania</b>: {{ setting('promotions.' . $key . '_dishes', true) }}</p>@endif
                                        @if (setting('promotions.' . $key . '_categories'))<p class="text-start"><b>Kategorie</b>: {{ setting('promotions.' . $key . '_categories', true) }}</p>@endif
                                        @if (setting('promotions.' . $key . '_price'))<p class="text-start"><b>Cena</b>: {{ setting('promotions.' . $key . '_price') }} zł</p>@endif
                                        @if (setting('promotions.' . $key . '_percent'))<p class="text-start"><b>Procent</b>: {{ setting('promotions.' . $key . '_percent') }}%</p>@endif
                                    </div>
                                    @endforeach
                                    @else
                                    -
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-11 fs-3 m-auto">
                                O nas
                            </div>
                            <div class="col-sm-1">
                                <a href="{{ route('setting.edit', 'about') }}" class="btn btn-block btn-success">Edytuj</a>
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
                                    <div class="mx-2 my-1">
                                        @if (!empty($settings['about']))
                                        @if (setting('about.title'))<p class="text-start"><b>Tytuł</b>: {{ setting('about.title') }}</p>@endif
                                        @if (setting('about.description'))<p class="text-start"><b>Opis</b>: {{ setting('about.description') }}</p>@endif
                                        @else
                                        -
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-11 fs-3 m-auto">
                                Opinie
                            </div>
                            <div class="col-sm-1">
                                <a href="{{ route('setting.edit', 'opinions') }}" class="btn btn-block btn-success">Edytuj</a>
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
                                    @if (!empty($settings['opinions']))
                                    @foreach ($settings['opinions'] ?? [] as $key => $setting)
                                    <h4><b>Opinia {{ $loop->iteration }}</b></h4>
                                    <div class="mx-2 my-1">
                                        @if (setting('opinions.' . $key . '_image'))
                                        <div class="image">
                                            <img src="{{ Storage::url(setting('opinions.' . $key . '_image')) }}" alt="Zdjęcia dania">
                                        </div>
                                        @endif
                                        @if (setting('opinions.' . $key . '_firstname'))<p class="text-start"><b>Imie i nazwisko</b>: {{ setting('opinions.' . $key . '_firstname') }} {{ setting('opinions.' . $key . '_lastname') }}</p>@endif
                                        @if (setting('opinions.' . $key . '_opinion'))<p class="text-start"><b>Opinia</b>: {{ setting('opinions.' . $key . '_opinion', true) }}</p>@endif
                                        @if (setting('opinions.' . $key . '_rate'))<p class="text-start"><b>Ocena</b>: {{ setting('opinions.' . $key . '_rate') }}</p>@endif
                                    </div>
                                    @endforeach
                                    @else
                                    -
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-11 fs-3 m-auto">
                                Konktakt
                            </div>
                            <div class="col-sm-1">
                                <a href="{{ route('setting.edit', 'contact') }}" class="btn btn-block btn-success">Edytuj</a>
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
                                    @if (!empty(setting('contact')))
                                    <div class="mx-2 my-1">
                                        @if (setting('contact.address'))<p class="text-start"><b>Adres</b>: {{ setting('contact.address') }}</p>@endif
                                        @if (setting('contact.telephone'))<p class="text-start"><b>Telephone</b>: {{ setting('contact.telephone') }}</p>@endif
                                        @if (setting('contact.email'))<p class="text-start"><b>Email</b>: {{ setting('contact.email') }}</p>@endif
                                    </div>
                                    @else
                                    -
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-11 fs-3 m-auto">
                                Godziny otwarcia
                            </div>
                            <div class="col-sm-1">
                                <a href="{{ route('setting.edit', 'opening_hours') }}" class="btn btn-block btn-success">Edytuj</a>
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
                                    @if (!empty($settings['opening_hours']))
                                    @foreach ($settings['opening_hours'] ?? [] as $key => $setting)
                                    <h4><b>Dzień {{ $loop->iteration }}</b></h4>
                                    <div class="mx-2 my-1">
                                        @if (setting('opening_hours.' . $key . '_day'))<p class="text-start"><b>Dzień</b>: {{ setting('opening_hours.' . $key . '_day') }}</p>@endif
                                        @if (setting('opening_hours.' . $key . '_open'))<p class="text-start"><b>Otwarcie</b>: {{ setting('opening_hours.' . $key . '_open') }}</p>@endif
                                        @if (setting('opening_hours.' . $key . '_close'))<p class="text-start"><b>Zamknięcie</b>: {{ setting('opening_hours.' . $key . '_close') }}</p>@endif
                                    </div>
                                    @endforeach
                                    @else
                                    -
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-11 fs-3 m-auto">
                                Statusy
                            </div>
                            <div class="col-sm-1">
                                <a href="{{ route('setting.edit', 'statuses') }}" class="btn btn-block btn-success">Edytuj</a>
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
                                    @if (!empty($settings['statuses']))
                                    @foreach ($settings['statuses'] ?? [] as $key => $setting)
                                    <h4><b>Status {{ $loop->iteration }}</b></h4>
                                    <div class="mx-2 my-1">
                                        @if (setting('statuses.' . $key . '_name'))<p class="text-start"><b>Nazwa</b>: {{ setting('statuses.' . $key . '_name') }} @if (setting('statuses.' . $key . '_default' )) (domyślny) @endif</p>@endif
                                    </div>
                                    @endforeach
                                    @else
                                    -
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
@endsection