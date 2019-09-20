@extends('layouts.layout')
@section('titlePage')
    <title>WiZ Kuijpers - Gebruiker toevoegen</title>
@endsection
@section('pageSpecificCSS')
<link rel="stylesheet" type="text/css" href="{{ asset('css/controlpanel.css') }}" />
@endsection

@section('content')
<div class="container userdetail">
        <div class="row">            
            <div class="col"><a aria-label="Pagina terug" href="/controlpanel"><i class="fas fa-arrow-circle-left usericons "></i></a></div>
            <div class="col"><img aria-label="Default avatar" class="profile-img-users mx-auto d-block" src="{{ asset('img/default.jpg') }}"></div>
            <div class="col"></div>
        </div>
        <hr id="userdetailline">
        <div class="usrinfo">
            <div class="row">
                <div class="col"></div>
                <div class="col-7">
                    <div class="usrinfo-cols">
                    <form action="/controlpanel/newuser/store" method="POST">
                            @method('POST')
                            @csrf
                            <h5>Voornaam:</h5>
                            <input aria-label="Voornaam" type="text" class="form-control{{ $errors->has('voornaam') ? ' is-invalid' : '' }}" placeholder="Voornaam" name="voornaam" value="{{ old('voornaam') }}" autofocus>
                            <br>
                            @if ($errors->has('voornaam'))
                                <div class="alert alert-danger" role="alert">
                                    {{ $errors->first('voornaam') }}
                                </div>
                            @endif
                            <h5>Achternaam:</h5>
                            <input aria-label="Achternaam" type="text" class="form-control{{ $errors->has('achternaam') ? ' is-invalid' : '' }}" placeholder="Achternaam" name="achternaam" value="{{ old('achternaam') }}">
                            <br>
                            @if ($errors->has('achternaam'))
                                <div class="alert alert-danger" role="alert">
                                    {{ $errors->first('achternaam') }}
                                </div>
                            @endif
                            <h5>E-Mail adres:</h5>
                            <input aria-label="E-Mail adres" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="E-Mail" name="email" value="{{ old('email') }}">
                            <br>
                            @if ($errors->has('email'))
                                <div class="alert alert-danger" role="alert">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                            <h5>Vestiging:</h5>
                            <select aria-label="Vestiging" class="form-control{{ $errors->has('vestiging') ? ' is-invalid' : '' }}" name="vestiging" value="{{ old('vestiging') }}">
                                <option disabled selected hidden>Vestiging:</option>
                                <option>Amsterdam</option>
                                <option>Arnhem</option>
                                <option>Den Bosch</option>
                                <option>Den Haag</option>
                                <option>Echt</option>
                                <option>Groningen</option>
                                <option>Helmond</option>
                                <option>Katwijk</option>
                                <option>Makkum</option>
                                <option>Oosterhout</option>
                                <option>Roosendaal</option>
                                <option>Tilburg</option>
                                <option>Utrecht</option>
                                <option>Zelhem</option>
                                <option>Zwolle</option>
                            </select>
                            <br>
                            @if ($errors->has('vestiging'))
                                <div class="alert alert-danger" role="alert">
                                    {{ $errors->first('vestiging') }}
                                </div>
                            @endif
                            <h5>Gebruikers functie:</h5>
                            <select aria-label="Rechten" class="form-control{{ $errors->has('rechten') ? ' is-invalid' : '' }}" name="rechten" value="{{ old('rechten') }}">
                                <option disabled selected hidden>Functie:</option>
                                <option>User</option>
                                <option>Manager</option>
                                <option>Admin</option>
                            </select>
                            <br>
                            @if ($errors->has('rechten'))
                                <div class="alert alert-danger" role="alert">
                                    {{ $errors->first('rechten') }}
                                </div>
                            @endif
                            <h5>Wachtwoord:</h5>
                            <input aria-label="WAchtwoord" id="password" type="password" placeholder="Wachtwoord" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">
                            <br>
                            @if ($errors->has('password'))
                                <div class="alert alert-danger" role="alert">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                            <h5>Bevestig wachtwoord:</h5>
                            <input aria-label="Bevesting wachtwoord" id="password-confirm" type="password" placeholder="Bevestig wachtwoord" class="form-control" name="password_confirmation">
                            <br>
                            <p class="createUserbtn"><button type="submit" class="btn btn-lg ">Maak gebruiker aan</button></p>
                        </form>
                    </div>
                </div>
                <div class="col"></div>
                {{-- <div class="col">
                    <div class="usrinfo-cols">
                        {{-- <h5>Gebruiker aangemaakt op:</h5>
                        <h3>{{ $user->created_at }}</h3>
                        <br>
                        <h5>Gebruiker geüpdate op:</h5>
                        {{-- <h3>{{ $user->updated_at }}</h3> --}}
                    {{-- </div>
                </div> --}}
            </div>
        </div>
    </div>
@endsection