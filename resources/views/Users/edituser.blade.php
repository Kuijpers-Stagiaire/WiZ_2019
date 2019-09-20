@extends('layouts.layout')
@section('titlePage')
    <title>WiZ Kuijpers - {{ $user->voornaam }} wijzigen</title>
@endsection

@section('pageSpecificCSS')
<link rel="stylesheet" type="text/css" href="{{ asset('css/controlpanel.css') }}" />
@endsection

@section('content')
<div class="container userdetail">
        <div class="row">            
            <div class="col"><a aria-label="Pagina terug" href="/controlpanel/users/{{ $user->id }}"><i class="fas fa-arrow-circle-left usericons "></i></a></div>
            <div class="col"><img aria-label="Avatar" class="profile-img-users mx-auto d-block" src="/storage/avatars/{{ $user->avatar }}">               
            </div>
            <div class="col"></div>
        </div>
        <hr id="userdetailline">
        <div class="usrinfo">
            <div class="row">
                <div class="col">
                    <div class="usrinfo-cols">
                    <form action="/controlpanel/users/{{ $user->id }}/update" method="POST">
                            @method('PATCH')
                            @csrf
                            <h5>Voornaam:</h5>
                            <input aria-label="Voornaam" type="text" class="form-control" value="{{ $user->voornaam }}" name="voornaam">
                            <br>
                            <h5>Achternaam:</h5>
                            <input aria-label="Achternaam" type="text" class="form-control" value="{{ $user->achternaam }}" name="achternaam">
                            <br>
                            <h5>E-Mail adres:</h5>
                            <input aria-label="E-Mail adres" type="text" class="form-control" value="{{ $user->email }}" name="email">
                            <br>
                            <h5>Vestiging:</h5>
                            <select aria-label="Vestiging" class="form-control" name="vestiging" >
                                <option selected hidden>{{ $user->vestiging }}</option>
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
                            <h5>Gebruikers functie:</h5>
                            <select aria-label="Rechten" class="form-control" name="rechten" >
                                <option selected hidden>{{ $user->rechten }}</option>
                                <option>User</option>
                                <option>Manager</option>
                                <option>Admin</option>
                            </select>
                            <br>
                            <button aria-label="Update gebruiker" type="submit" class="btn btn-lg">Update gebruiker</button>
                        </form>
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
@endsection