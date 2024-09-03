@extends('layouts.admin')
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
                @if ($code == 'general')
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-11 fs-3 m-auto">
                                Podstawowe ustawienia
                            </div>
                            <div class="col-sm-1 pull-right">
                                <button type="button" class="btn btn-primary" onclick="$('#setting_edit_form').submit();">Zapisz</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <form action="{{ route('setting.update', 'general') }}" method="POST" id="setting_edit_form">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-sm-12 col-md-6"></div>
                                    <div class="col-sm-12 col-md-6"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="general">
                                            <div class="mx-2 my-1">
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-6">
                                                        <h4><b>Ogólne</b></h4>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 float-end"></div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name">Wpisz nazwę pizzeri</label>
                                                    <input type="text" class="form-control" id="name" placeholder="Wpisz nazwę pizzeri" name="general[name]" value="{{ setting('general.name') }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="description">Wpisz opis pizzeri</label>
                                                    <textarea class="form-control" id="description" placeholder="Wpisz opis pizzeri" name="general[description]">{{ setting('general.description') }}</textarea>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-6">
                                                        <h4><b>Meta</b></h4>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 float-end"></div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="meta_title">Wpisz meta tytuł</label>
                                                    <input type="text" class="form-control" id="meta_title" placeholder="Wpisz meta tytuł" name="general[meta_title]" value="{{ setting('general.meta_title') }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="meta_description">Wpisz meta opis</label>
                                                    <textarea class="form-control" id="meta_description" placeholder="Wpisz meta opis" name="general[meta_description]">{{ setting('general.meta_description') }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="meta_keyword">Wpisz meta słowa kluczowe</label>
                                                    <textarea class="form-control" id="meta_keyword" placeholder="Wpisz meta słowa kluczowe" name="general[meta_keyword]">{{ setting('general.meta_keyword') }}</textarea>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-6">
                                                        <h4><b>Social Media</b></h4>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 float-end"></div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="sm_facebook">Wpisz link do facebook</label>
                                                    <input type="url" class="form-control" id="sm_facebook" placeholder="Wpisz link do facebook" name="general[socialmedia_facebook]" value="{{ setting('general.socialmedia_facebook') }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="sm_twitter">Wpisz link do twitter</label>
                                                    <input type="url" class="form-control" id="sm_twitter" placeholder="Wpisz link do twitter" name="general[socialmedia_twitter]" value="{{ setting('general.socialmedia_twitter') }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="sm_linkedin">Wpisz link do linkedin</label>
                                                    <input type="url" class="form-control" id="sm_linkedin" placeholder="Wpisz link do linkedin" name="general[socialmedia_linkedin]" value="{{ setting('general.socialmedia_linkedin') }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="sm_instagram">Wpisz link do instagram</label>
                                                    <input type="url" class="form-control" id="sm_instagram" placeholder="Wpisz link do instagram" name="general[socialmedia_instagram]" value="{{ setting('general.socialmedia_instagram') }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="sm_pinterest">Wpisz link do pinterest</label>
                                                    <input type="url" class="form-control" id="sm_pinterest" placeholder="Wpisz link do pinterest" name="general[socialmedia_pinterest]" value="{{ setting('general.socialmedia_pinterest') }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="sm_youtube">Wpisz link do youtube</label>
                                                    <input type="url" class="form-control" id="sm_youtube" placeholder="Wpisz link do youtube" name="general[socialmedia_youtube]" value="{{ setting('general.socialmedia_youtube') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @elseif ($code == 'headers')
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-11 fs-3 m-auto">
                                Nagłówki
                            </div>
                            <div class="col-sm-1 pull-right">
                                <button type="button" class="btn btn-success" onclick="addHeader();">Dodaj</button>
                                <button type="button" class="btn btn-primary" onclick="$('#setting_edit_form').submit();">Zapisz</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <form action="{{ route('setting.update', 'headers') }}" method="POST" id="setting_edit_form">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-sm-12 col-md-6"></div>
                                    <div class="col-sm-12 col-md-6"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 headers">
                                        @if (!empty($settings['headers']))
                                        @foreach ($settings['headers'] ?? [] as $key => $setting)
                                        <div class="header header{{ $loop->iteration }}-box" data-iteration="{{ $loop->iteration }}">
                                            <div class="row">
                                                <div class="col-sm-12 col-md-6">
                                                    <h4><b>Nagłówek {{ $loop->iteration }}</b></h4>
                                                </div>
                                                <div class="col-sm-12 col-md-6 float-end"><button type="button" class="btn btn-sm btn-danger float-end" onclick="removeHeader('{{ $loop->iteration }}');"><i class="fa fa-trash"></i></button></div>
                                            </div>
                                            <div class="mx-2 my-1">
                                                <div class="form-group">
                                                    <label for="title">Wpisz tytuł</label>
                                                    <input type="text" class="form-control" id="title" placeholder="Wpisz tytuł" name="headers[{{ $key }}_title]" value="{{ setting('headers.' . $key . '_title') }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="description">Wpisz opis</label>
                                                    <textarea class="form-control" id="description" placeholder="Wpisz opis" name="headers[{{ $key }}_description]">{{ setting('headers.' . $key . '_description') }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        @else
                                        <div class="header header1-box" data-iteration="1">
                                            <div class="row">
                                                <div class="col-sm-12 col-md-6">
                                                    <h4><b>Nagłówek 1</b></h4>
                                                </div>
                                                <div class="col-sm-12 col-md-6 float-end"></div>
                                            </div>
                                            <div class="mx-2 my-1">
                                                <div class="form-group">
                                                    <label for="title">Wpisz tytuł</label>
                                                    <input type="text" class="form-control" id="title" placeholder="Wpisz tytuł" name="headers[header1_title]">
                                                </div>
                                                <div class="form-group">
                                                    <label for="description">Wpisz opis</label>
                                                    <textarea class="form-control" id="description" placeholder="Wpisz opis" name="headers[header1_description]"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @elseif ($code == 'promotions')
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-11 fs-3 m-auto">
                                Promocje
                            </div>
                            <div class="col-sm-1 pull-right">
                                <button type="button" class="btn btn-success" onclick="addPromotion();">Dodaj</button>
                                <button type="button" class="btn btn-primary" onclick="$('#setting_edit_form').submit();">Zapisz</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <form action="{{ route('setting.update', 'promotions') }}" method="POST" id="setting_edit_form">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-sm-12 col-md-6"></div>
                                    <div class="col-sm-12 col-md-6"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 promotions">
                                        @if (!empty($settings['promotions']))
                                        @foreach ($settings['promotions'] ?? [] as $key => $setting)
                                        <div class="promotion promotion{{ $loop->iteration }}-box" data-iteration="{{ $loop->iteration }}">
                                            <div class="row">
                                                <div class="col-sm-12 col-md-6">
                                                    <h4><b>Nagłówek {{ $loop->iteration }}</b></h4>
                                                </div>
                                                <div class="col-sm-12 col-md-6 float-end"><button type="button" class="btn btn-sm btn-danger float-end" onclick="removePromotion('{{ $loop->iteration }}');"><i class="fa fa-trash"></i></button></div>
                                            </div>
                                            <div class="mx-2 my-1">
                                                <div class="form-group">
                                                    <label for="title">Wpisz nazwę</label>
                                                    <input type="text" class="form-control" id="name" placeholder="Wpisz nazwę" name="promotions[{{$key}}_name]" value="{{ setting('promotions.' . $key . '_name') }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="dishes">Wybierz dania</label>
                                                    <select class="form-control promotion-dishes" id="dishes" name="promotions[{{$key}}_dishes]" multiple data-coreui-search="true">
                                                        @foreach ($dishes as $dish)
                                                        <option value="{{ $dish->id }}" @if (in_array($dish->id, setting('promotions.' . $key . '_dishes') ?? [])) selected @endif>{{ $dish->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="dishes">Wybierz kategorie</label>
                                                    <select class="form-control promotion-categories" id="categories" name="promotions[{{$key}}_categories]" multiple data-coreui-search="true">
                                                        @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}" @if (in_array($category->id, setting('promotions.' . $key . '_categories') ?? [])) selected @endif>{{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="title">Wpisz cenę</label>
                                                    <input type="number" class="form-control promotion-price" id="price" placeholder="Wpisz cenę" name="promotions[{{$key}}_price]" value="{{ setting('promotions.' . $key . '_price') }}" step="0.01">
                                                </div>
                                                <div class="form-group">
                                                    <label for="title">Wpisz procent</label>
                                                    <input type="number" class="form-control promotion-percent" id="percent" placeholder="Wpisz procent" name="promotions[{{$key}}_percent]" value="{{ setting('promotions.' . $key . '_percent') }}" min="1" max="100">
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        @else
                                        <div class="promotion promotion1-box" data-iteration="1">
                                            <div class="row">
                                                <div class="col-sm-12 col-md-6">
                                                    <h4><b>Nagłówek 1</b></h4>
                                                </div>
                                                <div class="col-sm-12 col-md-6 float-end">
                                                </div>
                                            </div>
                                            <div class="mx-2 my-1">
                                                <div class="form-group">
                                                    <label for="title">Wpisz nazwę</label>
                                                    <input type="text" class="form-control" id="name" placeholder="Wpisz nazwę" name="promotions[promotion1_name]">
                                                </div>
                                                <div class="form-group">
                                                    <label for="dishes">Wybierz dania</label>
                                                    <select class="form-control promotion-dishes" id="dishes" name="promotions[promotion1_dishes]" multiple data-coreui-search="true">
                                                        @foreach ($dishes as $dish)
                                                        <option value="{{ $dish->id }}">{{ $dish->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="dishes">Wybierz kategorie</label>
                                                    <select class="form-control promotion-categories" id="categories" name="promotions[promotion1_categories]" multiple data-coreui-search="true">
                                                        @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="title">Wpisz cenę</label>
                                                    <input type="number" class="form-control promotion-price" id="price" placeholder="Wpisz cenę" name="promotions[promotion1_price]" step="0.01">
                                                </div>
                                                <div class="form-group">
                                                    <label for="title">Wpisz procent</label>
                                                    <input type="number" class="form-control promotion-percent" id="percent" placeholder="Wpisz procent" name="promotions[promotion1_percent]" min="1" max="100">
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @elseif ($code == 'about')
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-11 fs-3 m-auto">
                                O nas
                            </div>
                            <div class="col-sm-1">
                                <button type="button" class="btn btn-primary" onclick="$('#setting_edit_form').submit();">Zapisz</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <form action="{{ route('setting.update', 'about') }}" method="POST" id="setting_edit_form">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-sm-12 col-md-6"></div>
                                    <div class="col-sm-12 col-md-6"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        @if (!empty($settings['about']))
                                        <div class="about">
                                            <div class="mx-2 my-1">
                                                <div class="form-group">
                                                    <label for="title">Wpisz tytuł</label>
                                                    <input type="text" class="form-control" id="title" placeholder="Wpisz tytuł" name="about[title]" value="{{ setting('about.title') }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="title">Wpisz nazwę</label>
                                                    <textarea type="text" class="form-control" id="description" placeholder="Wpisz nazwę" name="about[description]">{{ setting('about.description') }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        @else
                                        <div class="about">
                                            <div class="mx-2 my-1">
                                                <div class="form-group">
                                                    <label for="title">Wpisz tytuł</label>
                                                    <input type="text" class="form-control" id="title" placeholder="Wpisz tytuł" name="about[title]">
                                                </div>
                                                <div class="form-group">
                                                    <label for="title">Wpisz nazwę</label>
                                                    <textarea type="text" class="form-control" id="description" placeholder="Wpisz nazwę" name="about[description]"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @elseif ($code == 'opinions')
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-11 fs-3 m-auto">
                                Opinie
                            </div>
                            <div class="col-sm-1 pull-right">
                                <button type="button" class="btn btn-success" onclick="addOpinion();">Dodaj</button>
                                <button type="button" class="btn btn-primary" onclick="$('#setting_edit_form').submit();">Zapisz</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <form action="{{ route('setting.update', 'opinions') }}" method="POST" id="setting_edit_form">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-sm-12 col-md-6"></div>
                                    <div class="col-sm-12 col-md-6"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 opinions">
                                        @if (!empty($settings['opinions']))
                                        @foreach ($settings['opinions'] ?? [] as $key => $setting)
                                        <div class="opinion opinion{{ $loop->iteration }}-box" data-iteration="{{ $loop->iteration }}">
                                            <div class="row">
                                                <div class="col-sm-12 col-md-6">
                                                    <h4><b>Opinia {{ $loop->iteration }}</b></h4>
                                                </div>
                                                <div class="col-sm-12 col-md-6 float-end"><button type="button" class="btn btn-sm btn-danger float-end" onclick="removeOpinion('{{ $loop->iteration }}');"><i class="fa fa-trash"></i></button></div>
                                            </div>
                                            <div class="mx-2 my-1">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="firstname">Wpisz imie</label>
                                                            <input type="text" class="form-control" id="firstname" placeholder="Wpisz imie" name="opinions[{{ $key }}_firstname]" value="{{ setting('opinions.' . $key . '_firstname') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="lastname">Wpisz Nazwisko</label>
                                                            <input type="text" class="form-control" id="lastname" placeholder="Wpisz nazwisko" name="opinions[{{ $key }}_lastname]" value="{{ setting('opinions.' . $key . '_lastname') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="opinion">Wpisz opinie</label>
                                                    <textarea class="form-control" id="opinion" placeholder="Wpisz opinie" name="opinions[{{ $key }}_opinion]">{{ setting('opinions.' . $key . '_opinion') }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="rate">Wpisz ocenę</label>
                                                    <input type="number" class="form-control" id="rate" placeholder="Wpisz ocenę" name="opinions[{{ $key }}_rate]" value="{{ setting('opinions.' . $key . '_rate') }}" min="1" max="5">
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        @else
                                        <div class="opinion opinion1-box" data-iteration="1">
                                            <div class="row">
                                                <div class="col-sm-12 col-md-6">
                                                    <h4><b>Opinia 1</b></h4>
                                                </div>
                                                <div class="col-sm-12 col-md-6 float-end"><button type="button" class="btn btn-sm btn-danger float-end" onclick="removeOpinion('1');"><i class="fa fa-trash"></i></button></div>
                                            </div>
                                            <div class="mx-2 my-1">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="firstname">Wpisz imie</label>
                                                            <input type="text" class="form-control" id="firstname" placeholder="Wpisz imie" name="opinions[opinion1_firstname]">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="lastname">Wpisz Nazwisko</label>
                                                            <input type="text" class="form-control" id="lastname" placeholder="Wpisz nazwisko" name="opinions[opinion1_lastname]">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="opinion">Wpisz opinie</label>
                                                    <textarea class="form-control" id="opinion" placeholder="Wpisz opinie" name="opinions[opinion1_opinion]"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="rate">Wpisz ocenę</label>
                                                    <input type="number" class="form-control" id="rate" placeholder="Wpisz ocenę" name="opinions[opinion1_rate]" min="1" max="5">
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @elseif ($code == 'contact')
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-11 fs-3 m-auto">
                                Kontakt
                            </div>
                            <div class="col-sm-1 pull-right">
                                <button type="button" class="btn btn-primary" onclick="$('#setting_edit_form').submit();">Zapisz</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <form action="{{ route('setting.update', 'contact') }}" method="POST" id="setting_edit_form">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-sm-12 col-md-6"></div>
                                    <div class="col-sm-12 col-md-6"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="contact">
                                            <div class="mx-2 my-1">
                                                <div class="form-group">
                                                    <label for="address">Wpisz Adres</label>
                                                    <textarea class="form-control" id="address" placeholder="Wpisz adres" name="contact[address]">{{ setting('contact.address') }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="telephone">Wpisz telefon</label>
                                                    <input type="telephone" class="form-control" id="telephone" placeholder="Wpisz telefon" name="contact[telephone]" value="{{ setting('contact.telephone') }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Wpisz email</label>
                                                    <input type="email" class="form-control" id="email" placeholder="Wpisz email" name="contact[email]" value="{{ setting('contact.email') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @elseif ($code == 'opening_hours')
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-11 fs-3 m-auto">
                                Godziny Otwarcia
                            </div>
                            <div class="col-sm-1">
                                <button type="button" class="btn btn-success" onclick="addOpenHour();">Dodaj</button>
                                <button type="button" class="btn btn-primary" onclick="$('#setting_edit_form').submit();">Zapisz</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <form action="{{ route('setting.update', 'opening_hours') }}" method="POST" id="setting_edit_form">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-sm-12 col-md-6"></div>
                                    <div class="col-sm-12 col-md-6"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 opening_hours">
                                        @if (!empty($settings['opening_hours']))
                                        @foreach ($settings['opening_hours'] ?? [] as $key => $setting)
                                        <div class="opening_hour opening_hour{{ $loop->iteration }}-box" data-iteration="{{ $loop->iteration }}">
                                            <div class="row">
                                                <div class="col-sm-12 col-md-6">
                                                    <h4><b>Dzień {{ $loop->iteration }}</b></h4>
                                                </div>
                                                <div class="col-sm-12 col-md-6 float-end"><button type="button" class="btn btn-sm btn-danger float-end" onclick="removeOpeningHour('{{ $loop->iteration }}');"><i class="fa fa-trash"></i></button></div>
                                            </div>
                                            <div class="mx-2 my-1">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="day">Dzień</label>
                                                            <input type="text" class="form-control" id="day" placeholder="Dzień" name="opening_hours[{{ $key }}_day]" value="{{ setting('opening_hours.' . $key . '_day') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="open">Otwarcie</label>
                                                            <input type="time" class="form-control" id="open" placeholder="Otwarcie" name="opening_hours[{{ $key }}_open]" value="{{ setting('opening_hours.' . $key . '_open') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="close">Zamknięcie</label>
                                                            <input type="time" class="form-control" id="close" placeholder="Zamknięcie" name="opening_hours[{{ $key }}_close]" value="{{ setting('opening_hours.' . $key . '_close') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        @else
                                        <div class="opening_hour opening_hour1-box" data-iteration="1">
                                            <div class="row">
                                                <div class="col-sm-12 col-md-6">
                                                    <h4><b>Dzień 1</b></h4>
                                                </div>
                                                <div class="col-sm-12 col-md-6 float-end"></div>
                                            </div>
                                            <div class="mx-2 my-1">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="day">Dzień</label>
                                                            <input type="text" class="form-control" id="day" placeholder="Dzień" name="opening_hours[opening_hour1_day]" value="{{ setting('opening_hours.opening_hour1_day') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="open">Otwarcie</label>
                                                            <input type="time" class="form-control" id="open" placeholder="Otwarcie" name="opening_hours[opening_hour1_open]" value="{{ setting('opening_hours.opening_hour1_open') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="close">Zamknięcie</label>
                                                            <input type="time" class="form-control" id="close" placeholder="Zamknięcie" name="opening_hours[opening_hour1_close]" value="{{ setting('opening_hours.opening_hour1_close') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
</section>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        if ($('.multiselect').length > 0) {
            $('#dishes, #categories').multiselect({
                includeSelectAllOption: true,
                buttonWidth: '100%'
            });
        }

        $('.promotion-price').on('keyup', function() {
            if ($('.promotion-price').val()) {
                $('.promotion-percent').attr('readonly', true);
            } else {
                $('.promotion-percent').attr('readonly', false);
            }
        });

        $('.promotion-percent').on('keyup', function() {
            if ($('.promotion-percent').val()) {
                $('.promotion-price').attr('readonly', true);
            } else {
                $('.promotion-price').attr('readonly', false);
            }
        });

        $('.promotion-dishes').on('change', function() {
            var iteration = $(this).closest('.promotion').data('iteration');
            $('.promotion' + iteration + '-box .promotion-categories').multiselect("deselectAll", false);
        });

        $('.promotion-categories').on('change', function() {
            var iteration = $(this).closest('.promotion').data('iteration');
            $('.promotion' + iteration + '-box .promotion-dishes').multiselect("deselectAll", false);
        });
    });

    function addHeader(e) {
        var iteration = $('.header').last().data('iteration') ?? 0;
        iteration++;
        $('.headers').append('<div class="header header' + iteration + '-box" data-iteration="' + iteration +
            '"><div class="row"><div class="col-sm-12 col-md-6"><h4><b>Nagłówek ' + iteration + '</b></h4></div><div class="col-sm-12 col-md-6 float-end"><button type="button" class="btn btn-sm btn-danger float-end" onclick="removeHeader(' + iteration + ');"><i class="fa fa-trash"></i></button></div></div><div class="mx-2 my-1" data-iteration="' + iteration + '"><div class="form-group"><label for="title">Wpisz tytuł</label><input type="text" class="form-control" id="title" placeholder="Wpisz tytuł" name="headers[header' + iteration + '_title]"></div> <div class="form-group"><label for="description">Wpisz opis</label><textarea class="form-control" id="description" placeholder="Wpisz opis" name="headers[header' + iteration + '_description]"></textarea></div></div></div>');
    }

    function addPromotion(e) {
        var iteration = $('.promotion').last().data('iteration') ?? 0;
        iteration++;
        $('.promotions').append('<div class="promotion promotion' + iteration +
            '-box" data-iteration="' + iteration +
            '"><div class="row"><div class="col-sm-12 col-md-6"><h4><b>Nagłówek ' + iteration +
            '</b></h4></div><div class="col-sm-12 col-md-6 float-end"><button type="button"class="btn btn-sm btn-danger float-end" onclick="removePromotion(' + iteration + ');"><i class="fa fa-trash"></i></button></div></div><div class="mx-2 my-1"><div class="form-group"><label for="title">Wpisz nazwę</label><input type="text" class="form-control" id="name" placeholder="Wpisz nazwę" name="promotions[promotion' + iteration +
            '_name]"></div><div class="form-group"><label for="dishes">Wybierz dania</label><select class="form-control" id="dishes" name="promotions[promotion' + iteration +
            '_dishes]" multiple data-coreui-search="true">@foreach($dishes as $dish) <option value = "{{$dish->id}}" >{{$dish->name}}</option>@endforeach</select></div ><div class="form-group"><label for = "dishes" > Wybierz kategorie </label><select class="form-control" id="categories" name="promotions[promotion' + iteration + '_categories]" multiple data-coreui-search="true">@foreach($categories as $category)<option value="{{ $category->id }}">{{$category->name}}</option>@endforeach</select></div><div class="form-group"><label for="title">Wpisz cenę</label><input type="number" class="form-control" id = "price" placeholder = "Wpisz cenę" name="promotions[promotion' + iteration + '_price]" step="0.01"></div><div class="form-group"><label for="title">Wpisz procent</label><input type="number" class="form-control" id="percent" placeholder="Wpisz procent" name="promotions[promotion' + iteration +
            '_percent]" min="1" max="100"></div></div></div>');

        $('#dishes, #categories').multiselect({
            includeSelectAllOption: true,
            buttonWidth: '100%'
        });
    }

    function addOpinion(e) {
        var iteration = $('.opinion').last().data('iteration') ?? 0;
        iteration++;
        $('.opinions').append('<div class="opinion opinion' + iteration + '-box" data-iteration="' + iteration + '"><div class="row"><div class="col-sm-12 col-md-6"><h4><b>Opinia ' + iteration + '</b></h4></div><div class="col-sm-12 col-md-6 float-end"><button type="button" class="btn btn-sm btn-danger float-end" onclick="removeOpinion(' + iteration + ');"><i class="fa fa-trash"></i></button></div></div><div class="mx-2 my-1"><div class="row"><div class="col-md-6"><div class="form-group"><label for="firstname">Wpisz imie</label><input type="text" class="form-control" id="firstname" placeholder="Wpisz imie" name="opinions[opinion' + iteration + '_firstname]"></div></div><div class="col-md-6"><div class="form-group"><label for="lastname">Wpisz Nazwisko</label><input type="text" class="form-control" id="lastname" placeholder="Wpisz nazwisko" name="opinions[opinion' + iteration + '_lastname]"></div></div></div><div class="form-group"><label for="opinion">Wpisz opinie</label><textarea class="form-control" id="opinion" placeholder="Wpisz opinie" name="opinions[opinion' + iteration + '_opinion]"></textarea></div><div class="form-group"><label for="rate">Wpisz ocenę</label><input type="number" class="form-control" id="rate" placeholder="Wpisz ocenę" name="opinions[opinion' + iteration + '_rate]" min="1" max="5"></div></div></div>');
    }

    function addOpenHour(e) {
        var iteration = $('.opening_hour').last().data('iteration') ?? 0;
        iteration++;
        $('.opening_hours').append('<div class="opening_hour opening_hour' + iteration + '-box" data-iteration="' + iteration + '"><div class="row"><div class="col-sm-12 col-md-6"><h4><b>Dzień ' + iteration + '</b></h4></div><div class="col-sm-12 col-md-6 float-end"><button type="button" class="btn btn-sm btn-danger float-end" onclick="removeOpeningHour(' + iteration + ');"><i class="fa fa-trash"></i></button></div></div><div class="mx-2 my-1"><div class="row"><div class="col-md-4"><div class="form-group"><label for="day">Dzień</label><input type="text" class="form-control" id="day" placeholder="Dzień" name="opening_hours[opening_hour' + iteration + '_day]" ></div></div><div class="col-md-4"><div class="form-group"><label for="open">Otwarcie</label><input type="time" class="form-control" id="open" placeholder="Otwarcie" name="opening_hours[opening_hour' + iteration + '_open]"></div></div><div class="col-md-4"><div class="form-group"><label for="close">Zamknięcie</label><input type="time" class="form-control" id="close" placeholder="Zamknięcie" name="opening_hours[opening_hour' + iteration + '_close]"></div></div></div></div>');
    }

    function removeHeader(iteration) {
        $('.header' + iteration + '-box').remove();
    }

    function removePromotion(iteration) {
        $('.promotion' + iteration + '-box').remove();
    }

    function removeOpinion(iteration) {
        $('.opinion' + iteration + '-box').remove();
    }

    function removeOpeningHour(iteration) {
        $('.opening_hour' + iteration + '-box').remove();
    }
</script>
@endsection