@extends('layouts.layout')

@section('pageSpecificCSS')
<link rel="stylesheet" type="text/css" href="{{ asset('css/New_profile.css') }}" />
@endsection
@section('titlePage')
    <title>WiZ Kuijpers - Profiel</title>
@endsection
@section('content')
<div class="Container">
    <div class="leftColom">
        <div class="editProfileImg mx-auto">
            {{--De code hieronder zorgt er voor dat er een default.jpg ingeladen wordt inplaats van kompleet geen foto--}}
            <img alt="Avatar afbeelding" href="#" class="profile-img" src="/storage/avatars/{{ Auth::user()->avatar }}" onerror=this.src="{{ url('/img/default.jpg') }}">
            {{-- <img alt="Avatar afbeelding" href="#" class="profile-img" src="/storage/avatars/{{ Auth::user()->avatar }}"> --}}
            <div class="overlay-profile">
                <a aria-label="Avatar wijzigen" href="#" class="icon-editProfile"  data-toggle="modal" data-target="#exampleModal"> 
                    <i class="fas fa-camera"></i>
                </a>
            </div>
        </div>
        <div class="tekst-underimage">
            <span id="voornaam">{{ Auth::user()->voornaam }}</span><span id="achternaam"> {{ Auth::user()->achternaam }}</span>
            <button type="button" onclick="openPage('UpdateGegevens', this, 'None')" class="btn btn-primary"  @if (session('CorrectTab') == "UpdateGegevens") id="defaultOpen" @endif>Verander gegevens</button>
        </div>

    </div>
    <div class="RightColom">
        <button type="button" class="tablink" name="HomeTab-btn" onclick="openPage('Home', this, '#CCCCCC')"  @if (!session('CorrectTab')) id="defaultOpen" @endif>Gebruikersinformatie</button>
        <button type="button" class="tablink" name="NewsTab-btn" onclick="openPage('News', this, '#CCCCCC')">Grafieken</button>

        <div id="Home" class="tabcontent">
            <div class="user-info">
                <div class="col col-sm user-info-inner">
                    <div class="user-info-splitter">
                        Functie:<br/>
                        <span class="user-info-splitter-tekst" id="rechten">{{Auth::user()->rechten}}<br/></span>
                    </div>
                    <div class="user-info-splitter">
                        Vestiging:<br/>
                        <span class="user-info-splitter-tekst" id="vestiging">{{Auth::user()->vestiging}}</span>
                    </div>
                </div>
                <div class="col col-sm user-info-inner">
                    <div class="user-info-splitter">
                        Email:<br/>
                        <span class="user-info-splitter-tekst" id="email">{{Auth::user()->email}}<br/></span>
                    </div>
                    <div class="user-info-splitter">
                        Wachtwoord:<br/>
                        <span class="user-info-splitter-tekst" id="wachtwoord"><a style="color: blue; cursor:pointer" @if (session('CorrectTab') == "Wachtwoordveranderen") id="defaultOpen" @endif onclick="openPage('Veranderwachtwoord', this, 'WHITE')">Verander Wachtwoord</a></span>
                    </div>
                </div>
            </div>
            <span id="Btn-save"></span>
        </div>
        <div id="News" class="tabcontent">
            <h3>Grafieken voor profiel - W.I.P</h3>
        </div>
        <div id="UpdateGegevens" class="tabcontent">
            @if ($message = Session::get('success_gegevens'))
            <div class="alert alert-success alert-block" style="margin-top:10px !important;width:100%;margin:0 auto;">
                <button type="button" class="close" data-dismiss="alert">×</button>	
                    <strong>{{ $message }}</strong>
            </div>
            @endif
            @if ($message = Session::get('error_gegevens'))
            <div class="alert alert-danger alert-block" style="margin-top:10px !important;width:100%;margin:0 auto;">
                <button type="button" class="close" data-dismiss="alert">×</button>	
                    <strong>{{ $message }}</strong>
            </div>
            @endif
            <form class="form-horizontal" method="POST" action="/profiel/updategebruiker">
                    {{ csrf_field() }} 
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="Nieuw_Voornaam">Voornaam</label>
                        <input type="text" class="form-control" name="Nieuw_Voornaam" id="Nieuw_Voornaam" value="{{Auth::user()->voornaam}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="Nieuw_Achternaam">Achternaam</label>
                        <input type="text" class="form-control" name="Nieuw_Achternaam" id="Nieuw_Achternaam" value="{{Auth::user()->achternaam}}">
                    </div>
                </div>
                <div class="form-group">
                  <label for="Nieuw_Email">Email</label><span id="Checkmark1"></span>
                  <input type="email" class="form-control" name="Nieuw_Email" id="Nieuw_Email" value="{{Auth::user()->email}}">
                </div>
                <div class="form-group">
                    <label for="Nieuw_Vestiging">Vestiging</label><span id="Checkmark2"></span>
                    <select aria-label="Vestiging" class="form-control" name="vestiging">
                    @foreach ($Vestiging as $locatie)
                        <option value="{{$locatie}}" {{ Auth::user()->vestiging == $locatie ? 'selected' : '' }}>{{$locatie}}</option>
                    @endforeach
                    </select>
                </div>
                <div>
                <button type="submit" id="Veranderbtn" class="btn btn-primary btn-block">Verander!</button>
                </div>
            </form>
        </div>

        <div id="Veranderwachtwoord" class="tabcontent">
            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block" style="margin-top:10px !important;width:100%;margin:0 auto;">
                <button type="button" class="close" data-dismiss="alert">×</button>	
                    <strong>{{ $message }}</strong>
            </div>
            @endif
            @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-block" style="margin-top:10px !important;width:100%;margin:0 auto;">
                <button type="button" class="close" data-dismiss="alert">×</button>	
                    <strong>{{ $message }}</strong>
            </div>
            @endif
            <form class="form-horizontal" method="POST" action="{{ route('changePassword') }}">
                    {{ csrf_field() }} 
                <div class="form-group">
                    <label for="huidig-wachtwoord">Huidig wachtwoord</label>
                    <input type="password" class="form-control" name="huidig-wachtwoord" id="huidig-wachtwoord">
                </div>
                <div class="form-group">
                  <label for="nieuw_wachtwoord">Nieuw Wachtwoord</label><span id="Checkmark1"></span>
                  <input type="password" onchange="Checkpassword()" class="form-control" name="nieuw_wachtwoord" id="nieuw_wachtwoord">
                </div>
                <div class="form-group">
                  <label for="nieuw_wachtwoord_confirm">Bevestig nieuw wachtwoord</label><span id="Checkmark2"></span>
                  <input type="password" onchange="Checkpassword()" class="form-control" name="nieuw_wachtwoord_confirmation" id="nieuw_wachtwoord_confirm">
                </div>
                <div>
                <button type="submit" id="Veranderbtn" class="btn btn-primary btn-block">Verander!</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
var i, tabcontent, tablinks, pageNameGlobal;
function openPage(pageName,elmnt,color) {
    
    pageNameGlobal = pageName;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablink");
    for (i = 0; i < tablinks.length; i++) {
    tablinks[i].style.backgroundColor = "";
    }
    document.getElementById(pageName).style.display = "block";
    elmnt.style.backgroundColor = color;
}
    
    // Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();

window.onload = function () {
    if (typeof history.pushState === "function") {
        history.pushState("jibberish", null, null);
        window.onpopstate = function () {
            if(pageNameGlobal == "Veranderwachtwoord" || pageNameGlobal == "UpdateGegevens") {
                history.pushState('newjibberish', null, null);
                var elmnt;
                elmnt = document.getElementsByName('HomeTab-btn');
                window.openPage('Home', elmnt[0], '#CCCCCC');
            }
        };
    }
}

let Checkpassword = () => {
    let password1 = document.getElementById("nieuw_wachtwoord").value;
    let password2 = document.getElementById("nieuw_wachtwoord_confirm").value;
    console.log(password1, password2);
    if(password1 && password2 ){
        if(password1 == password2){
            var elmnt1 = document.getElementById('Checkmark1');
            var elmnt2 = document.getElementById('Checkmark2');
            elmnt1.style.color = "green";
            elmnt1.innerHTML = "&nbsp;&#10004;";
            elmnt2.style.color = "green";
            elmnt2.innerHTML = "&nbsp;&#10004;";
            document.getElementById("Veranderbtn").disabled = false;
        }	
        else{
            var elmnt1 = document.getElementById('Checkmark1');
            var elmnt2 = document.getElementById('Checkmark2');
            elmnt1.style.color = "red";
            elmnt1.innerHTML = "&nbsp;&#10060;";
            elmnt2.style.color = "red";
            elmnt2.innerHTML = "&nbsp;&#10060;";
            document.getElementById("Veranderbtn").disabled = true;
        }
    }
}

</script>


{{-- <div class="container">
    <div class="row">
      <div class="col-md-6 img">
          <div class="image-container">
        <img src="/storage/avatars/{{ Auth::user()->avatar }}" onerror=this.src="{{ url('/img/default.jpg') }}"  alt="" class="img-rounded"></div>
     </div>
      <div class="col-md-6 details">
        <blockquote>
          <table class="table">
            <tbody>
                <tr>
                  <th>Voornaam</th>
                    <td>{{ Auth::user()->voornaam }}</td>
                </tr>
                <tr>
                  <th>Achternaam</th>
                    <td>{{ Auth::user()->achternaam }}</td>
                </tr>
                <tr>
                  <th>Email</th>
                    <td>{{ Auth::user()->email }}</td>

                </tr>
                <tr>
                  <th>Functie</th>
                    <td>{{ Auth::user()->rechten }}</td>
                </tr>
                
            </tbody>

        </table>
        <div class="btn-group" role="group" aria-label="Basic example">
            <button type="button" class="btn btn-secondary">Left</button>
            <button type="button" class="btn btn-secondary">Middle</button>
            <button type="button" class="btn btn-secondary">Right</button>
        </div>
      </div>
    </div>
  </div> --}}

    <!--<hr>
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
            {{--De code hieronder zorgt er voor dat er een default.jpg ingeladen wordt inplaats van kompleet geen foto--}}
            <img alt="Avatar afbeelding" href="#" class="profile-img" src="/storage/avatars/{{ Auth::user()->avatar }}" onerror=this.src="{{ url('/img/default.jpg') }}">
            {{-- <img alt="Avatar afbeelding" href="#" class="profile-img" src="/storage/avatars/{{ Auth::user()->avatar }}"> --}}
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
                <div class="title stadsnaam" hidden="hidden"></div>
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
                            {{-- @if (isset($controltoegang)) --}}
                            {{-- Hieronder staat een knopje om naar het controlpanel te gaan, maar die is alleen bedoelt
                                voor de productmanagers en admins --}}
                            @if ($controltoegang !== "User")
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
-->

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
                {{--De code hieronder zorgt er voor dat er een default.jpg ingeladen wordt inplaats van kompleet geen foto--}}
                <img alt="Image preview..." id="img" href="#" class="img-preview" src="/storage/avatars/{{ Auth::user()->avatar }}" onerror=this.src="{{ url('/img/default.jpg') }}">
                {{-- <img id="img" class="img-preview" src="/storage/avatars/{{ Auth::user()->avatar }}" alt="Image preview..."> --}}
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