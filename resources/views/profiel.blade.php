@extends('layouts.layout')

@section('pageSpecificCSS')
<link rel="stylesheet" type="text/css" href="{{ asset('css/profile.css') }}" />
@endsection
@section('titlePage')
    <title>WiZ Kuijpers - Profiel</title>
@endsection
@section('content')
    <hr>
    <div class="container-fluid maincont">
        <div class="container-fluid col-menu">
            <div class="row upperside" id="UserInfo">
                <div class="col order-first col-userinfo">
                    <ul class="nav-fill">
                        <li class="nav-item text-center li-pad">
                            Email:<br />
                            {{ Auth::user()->email }}
                        </li>
                        <li class="nav-item text-center li-pad">
                            Naam:<br />
                            {{ Auth::user()->voornaam }} {{ Auth::user()->achternaam }}
                        </li>
                    </ul>
                </div>
                <div class="col order-last">
                    <ul class="nav-fill">
                        <li class="nav-item text-center li-pad">
                            Functie:<br />
                            {{ Auth::user()->rechten }}
                        </li>
                        <li class="nav-item text-center li-pad">
                            Vestiging:<br />
                            {{ Auth::user()->vestiging }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="editProfileImg mx-auto">
            <img alt="Avatar afbeelding" href="#" class="profile-img" src="/storage/avatars/{{ Auth::user()->avatar }}">
            <div class="overlay-profile">
                <a aria-label="Avatar wijzigen" href="#" class="icon-editProfile"  data-toggle="modal" data-target="#exampleModal"> 
                    <i class="fas fa-camera"></i>
                </a>
            </div>
        </div>   
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm">
                    <h4>Het in en uitgaan van uw producten</h4>
                    <div class="card">
                        <div class="card-body">
                        <canvas id="bar-chart"  class="bar-chart" width="700" height="500"></canvas>
                        <input type="hidden" id="countproducts" value="{{$barchartproducts}}">
                        </div>
                    </div>
                </div> 
                <div class="col-sm">
                    <h4>Vestigingen met het meest aantal producten</h4>
                    <div class="card">
                        <div class="card-body">
                            <canvas id="doughnut-chart"  class="doughnut-chart" width="700" height="500"></canvas>
                            <input type="hidden" id="Locatie0" value="{{ (empty($piechartlocatie[0]->Locatie)) ? '' : $piechartlocatie[0]->Locatie }}">
                            <input type="hidden" id="Locatie1" value="{{ (empty($piechartlocatie[1]->Locatie)) ? '' : $piechartlocatie[1]->Locatie }}">
                            <input type="hidden" id="Locatie2" value="{{ (empty($piechartlocatie[2]->Locatie)) ? '' : $piechartlocatie[2]->Locatie }}">
                            <input type="hidden" id="Locatie3" value="{{ (empty($piechartlocatie[3]->Locatie)) ? '' : $piechartlocatie[3]->Locatie }}">
                            <input type="hidden" id="Locatie4" value="{{ (empty($piechartlocatie[4]->Locatie)) ? '' : $piechartlocatie[4]->Locatie }}">
                            {{-- Doughnut producten per locatie --}}
                            <input type="hidden" id="prodperlocatie0" value="{{ (empty($piechartlocatie[0]->LocatieAantal )) ? '' : $piechartlocatie[0]->LocatieAantal }}">
                            <input type="hidden" id="prodperlocatie1" value="{{ (empty($piechartlocatie[1]->LocatieAantal )) ? '' : $piechartlocatie[1]->LocatieAantal }}">
                            <input type="hidden" id="prodperlocatie2" value="{{ (empty($piechartlocatie[2]->LocatieAantal )) ? '' : $piechartlocatie[2]->LocatieAantal }}">
                            <input type="hidden" id="prodperlocatie3" value="{{ (empty($piechartlocatie[3]->LocatieAantal )) ? '' : $piechartlocatie[3]->LocatieAantal }}">
                            <input type="hidden" id="prodperlocatie4" value="{{ (empty($piechartlocatie[4]->LocatieAantal )) ? '' : $piechartlocatie[4]->LocatieAantal }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm">
                    <div class="card profile-links">
                        <div class="card-body">
                            <a href="https://login.microsoftonline.com/d9d6b87a-f22a-4c99-8d5a-25ba4629b8ac/oauth2/authorize?client_id=00000003-0000-0ff1-ce00-000000000000&response_mode=form_post&response_type=code%20id_token&resource=00000003-0000-0ff1-ce00-000000000000&scope=openid&nonce=F71DEA8787388F2813C79D42869733F1A350928C1F14B9DE-1681498AB7162E18859DAE065695808F46837390D6C5C948458DBB201C042170&redirect_uri=https:%2F%2Fmijnkuijpers.sharepoint.com%2F_forms%2Fdefault.aspx&wsucxt=1&cobrandid=11bd8083-87e0-41b5-bb78-0bc43c8a8e8a&client-request-id=d6b7969e-50e8-6000-67fd-0225ec34e912" target="_blank" rel="noreferrer"><h5 class="card-title"><img alt="Kuijpers logo" class="kuijpers-icon" src="img/kuijpers-icon.png">Mijn Kuijpers</h5></a>        
                            @if (isset($controltoegang))
                                <a class="controlmobile" href="/controlpanel"><h5 class="card-title"><i class="fas fa-user-cog lineheight"></i>Controlpanel</h5></a>
                            @else

                            @endif
                            <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form-profiel').submit();"><h5 class="card-title"><i class="fas fa-power-off lineheight"></i>Uitloggen</h5>

                            <form alt="logout" id="logout-form-profiel" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>    
                            </a>                    
                        </div>
                    </div>
                </div>
                <div class="col">
                </div>
            </div>  
        </div> 
    </div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Avatar wijzigen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="mx-auto">
                <img id="img" class="img-preview" src="/storage/avatars/{{ Auth::user()->avatar }}" alt="Image preview...">
            </div>
            <div class="modal-body">
            <form action="/profile" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input type="file" class="form-control-file" name="avatar" id="avatarFile" aria-describedby="fileHelp" onchange="previewFile()">
                    <small id="fileHelp" class="form-text text-muted">Please upload a valid image file. Size of image should not be more than 2MB.</small>
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
@section('PWA')
    <div>
        <img id="btnAdd" alt="PWA popup" src="{{ asset('img/pwa-icon.png') }}">
    <div>
@endsection

    @section('charts')
        <script src="{{ asset('js/raphael-2.1.4.min.js') }}"></script>
        <script src="{{ asset('js/justgage.js') }}"></script>
        <script src="{{ asset('js/Chart.min.js') }}"></script>
        <input type="hidden" id="smallbuddyusers" value="0">
        <script src="{{ asset('js/Charts.js') }}"></script>
    @endsection
@endsection