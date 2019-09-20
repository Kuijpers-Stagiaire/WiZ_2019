@extends('layouts.layout')
@section('titlePage')
    <title>WiZ Kuijpers - {{ $user->voornaam }}</title>
@endsection
@section('pageSpecificCSS')
<link rel="stylesheet" type="text/css" href="{{ asset('css/controlpanel.css') }}" />
@endsection

@section('content')
    <div class="container userdetail">
        <div class="row">
            <div class="col">
                <a aria-label="Pagina terug" href="/controlpanel"><i class="fas fa-arrow-circle-left usericons "></i></a>
                <a aria-label="Gebruiker wijzigen" href="/controlpanel/users/{{ $user->id }}/edit"><i class="fas fa-wrench usericons "></i></a>
                <i aria-label="Gebruiker verwijderen" class="tablinks far fa-trash-alt usericons userdel" onclick="openCity(event, 'userdelete')"></i>
                <i class="tablinks fas fa-info usericons" onclick="openCity(event, 'userinfo')" id="defaultOpen" style="display: none;"></i>
            </div>
            <div class="col"><img aria-label="Avatar" class="profile-img-users mx-auto d-block" src="/storage/avatars/{{ $user->avatar }}"></div>
            <div class="col"></div>
        </div>
        <hr id="userdetailline">
            <div class="usrinfo tabcontent" id="userinfo">
                <div class="row">
                    <div class="col">
                        <div class="usrinfo-cols">
                            <h5>Naam:</h5>
                            <h3>{{ $user->achternaam }}, {{ $user->voornaam }}</h3>
                            <br>
                            <h5>E-Mail adres:</h5>
                            <h3>{{ $user->email }}</h3>
                            <br>
                            <h5>Vestiging:</h5>
                            <h3>{{ $user->vestiging }}</h3>
                            <br>
                            <h5>Gebruikers id:</h5>
                            <h3>{{ $user->id }}</h3>
                            <br>
                            <h5>Gebruikers functie:</h5>
                            <h3>{{ $user->rechten }}</h3>
                        </div>
                    </div>
                    <div id="userdetailverticalline"></div>
                    <div class="col">
                        <div class="usrinfo-cols">

                            <h5>Gebruiker aangemaakt op:</h5>
                            <h3>{{ $user->created_at }}</h3>
                            <br>
                            <h5>Gebruiker geüpdate op:</h5>
                            <h3>{{ $user->updated_at }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tabcontent" id="userdelete">
        <br>
        <div class="container">
            <div class="row confirmdeleteuser">
                <div class="col"></div>
                <div class="col-6"><h3>Weet je zeker dat je {{ $user->achternaam }}, {{ $user->voornaam }} wilt verwijderen?</h3></div>
                <div class="col"></div>
            </div>
            <br>
            <div class="row ">
                <div class="col"></div>
                <div class="col">
                    <form action="/controlpanel/users/{{ $user->id }}/destroy" method="POST" class="delform" id="DelForm">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-success">Verwijder</button>
                    </form>
                </div>
                <div class="col " id="AnBtn">
                    <a href="/controlpanel/users/{{$user->id}}"><button type="submit" class="btn btn-danger">Annuleer</button></a>
                </div>
                <div class="col"></div>

                </div>
                
            </div>

        </div>
    </div>
@endsection
@section('tabJS')
    <script src="{{ asset('js/tab.js') }}"></script> 
@endsection