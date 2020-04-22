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
            {{--De code hieronder is er voor om als de gebruiker geen profiel foto heeft en dan een default.jpg in te laden--}}
            <div class="col"><img aria-label="Avatar" class="profile-img-users mx-auto d-block" src="/storage/avatars/{{ $user->avatar }}" onerror=this.src="{{ url('/img/default.jpg') }}"></div>
            {{-- <div class="col"><img aria-label="Avatar" class="profile-img-users mx-auto d-block" src="/storage/avatars/{{ $user->avatar }}"></div> --}}
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
                                {{-- <option>Manager</option> --}}
                                {{-- Aanpassing gemaakt dat er nu de tekst Product-Manager opgeslagen wordt inplaats van Manager --}}
                                <option>Product-Manager</option>
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
                        <br><br>
                        <button data-toggle="modal" data-target="#exampleModal" class="btn btn-primary btn-lg" id="wwreset">Reset wachtwoord</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- model -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Reset wachtwoord</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <form action="/adminchangePassword" method="post">
                    @csrf
                    <div class="form-group">
                        <input hidden name="user_email" value="{{$user->email}}"/>
                        <label for="Nieuw_ww">Nieuw Wachtwoord</label>
                        <input type="text" class="form-control" id="Nieuw_ww" name="Nieuw_ww"/>
                        <small>Deze wachtwoord copieren en doorsturen naar de gebruiker!</small>
                    </div>
                    <div class="form-group">
                        <button type="button" onclick="makeid(8)" class="btn btn-primary">Reset wachtwoord</button>
                    </div>                        
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
                    <button type="submit" class="btn btn-primary">Opslaan</button>
                </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function makeid(length) {
            var result           = '';
            var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            var charactersLength = characters.length;
            for ( var i = 0; i < length; i++ ) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            document.getElementById("Nieuw_ww").value = result;
        }
    </script>
@endsection