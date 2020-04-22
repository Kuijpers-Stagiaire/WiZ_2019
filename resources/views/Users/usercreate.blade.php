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
                            <h5><span style="color:red;">*</span>Voornaam:</h5>
                            <input aria-label="Voornaam" type="text" class="form-control{{ $errors->has('voornaam') ? ' is-invalid' : '' }}" placeholder="Voornaam" name="voornaam" value="{{ old('voornaam') }}" autofocus>
                            <br>
                            @if ($errors->has('voornaam'))
                                <div class="alert alert-danger" role="alert">
                                    {{ $errors->first('voornaam') }}
                                </div>
                            @endif
                            <h5><span style="color:red;">*</span>Achternaam:</h5>
                            <input aria-label="Achternaam" type="text" class="form-control{{ $errors->has('achternaam') ? ' is-invalid' : '' }}" placeholder="Achternaam" name="achternaam" value="{{ old('achternaam') }}">
                            <br>
                            @if ($errors->has('achternaam'))
                                <div class="alert alert-danger" role="alert">
                                    {{ $errors->first('achternaam') }}
                                </div>
                            @endif
                            <h5><span style="color:red;">*</span>E-Mail adres:</h5>
                            <input aria-label="E-Mail adres" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="E-Mail" name="email" value="{{ old('email') }}">
                            <br>
                            @if ($errors->has('email'))
                                <div class="alert alert-danger" role="alert">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                            <h5><span style="color:red;">*</span>Vestiging:</h5>

                            <select aria-label="Vestiging" class="form-control{{ $errors->has('vestiging') ? ' is-invalid' : '' }}" name="vestiging">
                                <option disabled selected hidden>Vestiging:</option>
                                <option value="Amsterdam" {{ old('vestiging') == 'Amsterdam' ? 'selected' : '' }}>Amsterdam</option>
                                <option value="Arnhem" {{ old('vestiging') == 'Arnhem' ? 'selected' : '' }}>Arnhem</option>
                                <option value="Den Bosch" {{ old('vestiging') == 'Den Bosch' ? 'selected' : '' }}>Den Bosch</option>
                                <option value="Den Haag" {{ old('vestiging') == 'Den Haag' ? 'selected' : '' }}>Den Haag</option>
                                <option value="Echt" {{ old('vestiging') == 'Echt' ? 'selected' : '' }}>Echt</option>
                                <option value="Groningen" {{ old('vestiging') == 'Groningen' ? 'selected' : '' }}>Groningen</option>
                                <option value="Helmond" {{ old('vestiging') == 'Helmond' ? 'selected' : '' }}>Helmond</option>
                                <option value="Katwijk" {{ old('vestiging') == 'Katwijk' ? 'selected' : '' }}>Katwijk</option>
                                <option value="Makkum" {{ old('vestiging') == 'Makkum' ? 'selected' : '' }}>Makkum</option>
                                <option value="Oosterhout" {{ old('vestiging') == 'Oosterhout' ? 'selected' : '' }}>Oosterhout</option>
                                <option value="Roosendaal" {{ old('vestiging') == 'Roosendaal' ? 'selected' : '' }}>Roosendaal</option>
                                <option value="Tilburg" {{ old('vestiging') == 'Tilburg' ? 'selected' : '' }}>Tilburg</option>
                                <option value="Utrecht" {{ old('vestiging') == 'Utrecht' ? 'selected' : '' }}>Utrecht</option>
                                <option value="Zelhem" {{ old('vestiging') == 'Zelhem' ? 'selected' : '' }}>Zelhem</option>
                                <option value="Zwolle" {{ old('vestiging') == 'Zwolle' ? 'selected' : '' }}>Zwolle</option>
                            </select>
                            <br>
                            @if ($errors->has('vestiging'))
                                <div class="alert alert-danger" role="alert">
                                    {{ $errors->first('vestiging') }}
                                </div>
                            @endif
                            <h5><span style="color:red;">*</span>Gebruikers functie:</h5>
                            <select aria-label="Rechten" class="form-control{{ $errors->has('rechten') ? ' is-invalid' : '' }}" name="rechten" value="{{ old('rechten') }}">
                                <option disabled selected hidden>Functie:</option>
                                <option value="User" {{ old('rechten') == 'User' ? 'selected' : '' }}>User</option>
                                {{-- <option>Manager</option> --}}
                                {{-- Aanpassing gemaakt dat er nu de tekst Product-Manager opgeslagen wordt inplaats van Manager --}}
                                <option value="Product-Manager" {{ old('rechten') == 'Product-Manager' ? 'selected' : '' }}>Product-Manager</option>
                                <option value="Admin" {{ old('rechten') == 'Admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                            <br>
                            @if ($errors->has('rechten'))
                                <div class="alert alert-danger" role="alert">
                                    {{ $errors->first('rechten') }}
                                </div>
                            @endif
                            <h5><span style="color:red;">*</span>Wachtwoord:</h5>
                            <input aria-label="WAchtwoord" id="password" type="password" placeholder="Wachtwoord" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">
                            <br>
                            @if ($errors->has('password'))
                                <div class="alert alert-danger" role="alert">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                            <h5><span style="color:red;">*</span>Bevestig wachtwoord:</h5>
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