@extends('layouts.layout')

@section('pageSpecificCSS')
{{-- link toegevoegd voor tabel. --}}
<link href="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset('css/controlpanel.css') }}" />
@endsection
@section('titlePage')
    <title>WiZ Kuijpers - Controlpanel</title>
@endsection
@section('content')
    <div class="tab">
        {{-- Hier wordt gecontroleerd wat de rol van de gebruiker is--}}
        {{-- Als de rol beschikbaar is, dan mag de gebruiker op de pagina's gaan waarvoor die gemachtigd is  --}}
        @if (isset($accountbeheertoegang))
            <button class="tablinks" onclick="openCity(event, 'Accountbeheer')" id="defaultOpen" data-toggle="tab"> <i class="fas fa-user-cog"></i>         Accountbeheer</button>
            <button class="tablinks" onclick="openCity(event, 'Productbeheer')" data-toggle="tab"><i class="fas fa-cube"></i>         Productbeheer</button>
        @else
            <button class="tablinks" onclick="openCity(event, 'Productbeheer')" id="defaultOpen" data-toggle="tab"><i class="fas fa-cube"></i>         Productbeheer</button>      
        @endif
    </div>
    <div class="tabcontent" id="Accountbeheer" style="display: block;"> 
        <div class="container">
            <div class="row">
                <div class="col">
                    <form action="/controlpanel" method="POST" role="search">
                        {{ csrf_field() }}
                        <div class="input-group mb-3 searchbaricon">
                            <input type="text" class="form-control" placeholder="Search users" name="q">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col hidetiny">

                </div>
                <div class="col hidetiny">
                </div>
                <div class="col">
                    <a href="/controlpanel/newuser" class="tablinks"><button class="Nusr searchcreateUsers">Gebruiker toevoegen</button></a>
                </div>
            </div>
        </div>


        <div class="container users-main">
            {{-- <div class="container-fluid users-main">
                <table class="table"
                data-toggle="table"
                data-height="460"
                data-pagination="true"
                data-page-size="5"          
                data-page-list="[10, 25, 50, 100, all]"
                >
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col-2">Profielfoto</th>
                        <th scope="col">Naam</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Rechten</th>
                        <th scope="col">Vestiging</th>
                        <th scope="col">ID</th>
                      </tr>
                    </thead>
                    <tbody>
                    @if(isset($users))
                     @foreach ($users as $user)
                      <tr>
                        <td><img src="/storage/avatars/{{ $user->avatar }}" alt="Profiel_foto" class="profile-img-small" onerror=this.src="{{ url('/img/default.jpg') }}"></div></td>
                        <td>{{$user->voornaam}} {{$user->achternaam}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->rechten}}</td>
                        <td>{{$user->vestiging}}</td>
                        <td>{{$user->id}}</td>
                      </tr>
                      @endforeach
                    @endif
                    </tbody>
                  </table>
            </div> --}}
            <div class="table-responsive-lg">
                <table class="table table-borderless table-hover">
                    <thead>
                    <tr>
                        <th scope="col"><img src="/storage/avatars/{{ Auth::user()->avatar }}" class="profile-img-small" style="display: none;"></th>
                        <th scope="col">Naam:</th>
                        <th scope="col">E-Mail:</th>
                        <th scope="col">Rechten:</th>
                        <th scope="col">Vestiging:</th>
                        <th scope="col">Id:</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if(isset($users))
                            @foreach ($users as $user)
                                <tr class='clickable-row' data-href='/controlpanel/users/{{ $user->id }}'>
                                    <td><img src="/storage/avatars/{{ $user->avatar }}" alt="Profiel_foto" class="profile-img-small" onerror=this.src="{{ url('/img/default.jpg') }}"></td>
                                    <td>{{ $user->voornaam}} {{$user->achternaam}}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{$user->rechten}}</td>
                                    <td>{{$user->vestiging}}</td>
                                    <td>{{$user->id}}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            {{-- <br>
            <div class="row users" id="infobar">
                <div class="img-col colpadding"><img src="/storage/avatars/{{ Auth::user()->avatar }}" class="profile-img-small" style="display: none;"></div>
                <div class="col-4 colpadding">Naam:</div>
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
                                {{--De code hieronder is er voor om per gebruiker een default.jpg in te laden--}}
                                {{-- <div class="img-col"><img src="/storage/avatars/{{ $user->avatar }}" alt="Profiel_foto" class="profile-img-small" onerror=this.src="{{ url('/img/default.jpg') }}"></div>
                                <div class="col-4">{{ $user->voornaam}} {{$user->achternaam}}</div>
                                <div class="col-4">{{ $user->email }}</div>
                                <div class="col ellipsis">{{$user->rechten}}</div>
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
            @endif --}}
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
        <div class="container-fluid Product-main">
            <table class="table"
            data-search="true"
            data-toggle="table"
            data-height="460"
            data-pagination="true"
            data-page-size="5"          
            data-page-list="[10, 25, 50, 100, all]"
            >
                <thead class="thead-dark">
                  <tr>
                    <th scope="col-2">Aanvraag ID</th>
                    <th scope="col">Producttoevoeger</th>
                    <th scope="col">Productfoto</th>
                    <th scope="col">Productnaam</th>
                    <th scope="col">Product aantal</th>
                    <th scope="col">Product locatie</th>
                  </tr>
                </thead>
                <tbody>
                @if(isset($overzicht))
                 @foreach ($overzicht as $product)
                  <tr>
                    <td>{{ $product->Product_id }}</td>
                    <td>{{ $product->Voornaam }} {{$product->Achternaam}}</td>
                    <td><img src="{{ $product->ProductImage }}" alt="Profiel_foto" style="Height: 100px; width: 100px;" onerror=this.src="{{ url('/img/default.jpg') }}"></td>
                    <td><a href="/producten/productdetail/{{$product->Product_id}}">{{$product->Description}}</a></td>
                    <td>{{$product->Aantal}}</td>
                    <td>{{$product->Locatie}}</td>
                  </tr>
                  @endforeach
                                  {{-- <div class="row ">
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
                </div> --}}
                @endif
                </tbody>
              </table>
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
{{-- link toegevoegd voor tabel. --}}
<script src="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.js"></script>
<script>
jQuery(document).ready(function($) {
    $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });
});
</script>
@endsection