@extends('layouts.layout')

@section('pageSpecificCSS')
<link rel="stylesheet" type="text/css" href="{{ asset('css/controlpanel.css') }}" />
@endsection
@section('titlePage')
    <title>WiZ Kuijpers - Controlpanel</title>
@endsection
@section('content')
    <div class="tab">
        @if (isset($accountbeheertoegang))
            <button class="tablinks" onclick="openCity(event, 'Accountbeheer')" id="defaultOpen" data-toggle="tab"> <i class="fas fa-user-cog"></i>         Accountbeheer</button>
            <button class="tablinks" onclick="openCity(event, 'Productbeheer')" data-toggle="tab"><i class="fas fa-cube"></i>         Productbeheer</button>
        @else
            <button class="tablinks" onclick="openCity(event, 'Productbeheer')" id="defaultOpen" data-toggle="tab"><i class="fas fa-cube"></i>         Productbeheer</button>      
        @endif
    </div>
    <div class="tabcontent" id="Accountbeheer" style="display: block;height: 100vh;"> 
        <div class="container">
            <div class="row">
                <div class="col">
                    <form class="Sbar searchcreateUsers" action="/controlpanel" method="POST" role="search">
                        {{ csrf_field() }}
                        <input aria-label="Search users" type="text" placeholder="Search users" name="q">
                        <button aria-label="Search users" type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
                <div class="col">

                </div>
                <div class="col">
                </div>
                <div class="col">
                    <a href="/controlpanel/newuser" class="tablinks"><button class="Nusr searchcreateUsers">Gebruiker toevoegen</button></a>
                </div>
            </div>
        </div>


        <div class="container users-main">
            <br>
            <div class="row users" id="infobar">
                <div class="img-col colpadding"><img src="/storage/avatars/{{ Auth::user()->avatar }}" class="profile-img-small" style="display: none;"></div>
                <div class="col-4 colpadding">E-Mail:</div>
                <div class="col colpadding"><p class="naam"> Rechten: </p></div>
                <div class="col colpadding">Vestiging:</div>
                <div class="col colpadding">Id:</div>
            </div>
            @if(isset($users))
                @foreach ($users as $user)
                    <a href="/controlpanel/users/{{ $user->id }}">
                        <div id="searchUsers">
                            <div class="row users usersdata">
                                <div class="img-col"><img src="/storage/avatars/{{ $user->avatar }}" class="profile-img-small"></div>
                                <div class="col-4">{{ $user->email }}</div>
                                <div class="col">{{$user->rechten}}</div>
                                <div class="col">{{$user->vestiging}}</div>
                                <div class="col">{{$user->id}}</div>
                            </div>
                        </div>
                    </a>
                @endforeach
                <div class="row ">
                    <div class="col"></div>
                    <div class="controluserlink">{{ $users->links() }}</div>
                    <div class="col"></div>
                </div>
            @endif
            @if(isset($usersearcherror))
                <div class="row usernotfoundicon">
                    <div class="col"></div>
                    <div class="col-6"><i class="fas fa-user-times"></i></div>
                    <div class="col"></div>
                </div>
                <div class="row usernotfound">
                    <div class="col"></div>
                    <div class="col-6"> <h3>Gebruiker niet gevonden</h3></div>
                    <div class="col"></div>
                </div>
            @endif
            
        </div>
    </div>
    <div class="tabcontent" id="Productbeheer">
        <div class="container-fluid users-main">
            <div class="row info" id="infobarproductbeheer">
                <div class="img-col colpadding"><img src="img/aanvraagicon.png" class="profile-img-small imginfobar"></div>
                <div class="col colpadding"><p class="nummer"> Aanvraag ID: </p></div>
                <div class="col colpadding"><p class="naam"> Gebruikers: </p></div>
                <div class="col colpadding">Product:</div>
                <div class="col colpadding">Product aantal:</div>
                <div class="col colpadding">Product locatie:</div>
                <div class="col colpadding"><img src="img/setting2.png" height="30" width="30"></div>
            </div>
        </div>
    </div>   
@endsection
@section('PWA')
    <div>
        <img id="btnAdd" alt="PWA popup" src="{{ asset('img/pwa-icon.png') }}">
    <div>
@endsection
@section('tabJS')
    <script src="{{ asset('js/tab.js') }}"></script> 
@endsection