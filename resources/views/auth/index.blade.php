@extends('layouts.app')
@section('content')

<!DOCTYPE html>
<html>
<head>
    <title>PHP Minigames</title>
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="css/newlogin.css">
    </head>
    <body>

        <div class="login-container">
            <div class="login-section-left">
                <div class="login-section-left-1">
                    <div class="login-section-left-1-header-1">
                        <div style="margin-top: -30px;">
                            <img src="{{ asset('img/logo-small.png') }}" width="50">
                        </div>
                        <div>
                            <p>Kuijpers</p>
                            <p class="small">Energieneutrale en gezonde installaties</p>
                        </div>
                    </div>
                     <div class="login-section-left-1-header-2">
                        <div style="margin-top: -30px;">
                            <img src="{{ asset('img/icons/icon-512x512.png') }}" width="50">
                        </div>
                        <div>
                            <p>WiZ</p>
                            <p class="small">Weggooien is zonde</p>
                        </div>
                    </div>

                </div>
                <div class="login-section-left-2">
                    <?php
                    // I'm India so my timezone is Asia/Calcutta
                    date_default_timezone_set('Europe/Amsterdam');

                    // 24-hour format of an hour without leading zeros (0 through 23)
                    $Hour = date('G');

                    if ( $Hour >= 5 && $Hour <= 11 ) {
                        echo "<p class='big'>Goedemorgen!</p>";
                    } else if ( $Hour >= 12 && $Hour <= 18 ) {
                        echo "<p class='big'>Goedemiddag!</p>";
                    } else if ( $Hour >= 19 || $Hour <= 4 ) {
                        echo "<p class='big'>Goedenavond!</p>";
                    }
                    ?>
<form action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <div class="input-group">
                                    <input aria-label="E-mail adres" id="email" type="email" placeholder="E-Mail" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" autofocus>                                    
                                </div>
                                @if ($errors->has('email'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <div class="input-group">                                 
                                    <input aria-label="Wachtwoord" id="password" type="password" placeholder="Wachtwoord" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" >                                   
                                </div>
                                @if ($errors->has('password'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ $errors->first('password') }}
                                    </div>
                                 @endif
                            </div>
                            <br>

                            <button aria-label="Inloggen" type="submit" class="btn btn-lg login" name="submit" id="myBtn" data-toggle="popup1">
                                {{ __('Inloggen') }}
                            </button>


                                {{-- <a class="buttonlogin" href="#popup1">Let me Pop up</a> --}}



                        </form> 
                </div>
                <div class="login-section-left-3">
                    <p class="small">®Kuijpers 2019</p>
                </div>
                <div class="login-section-left-4">
                    
                            @if (Route::has('password.request'))
                                <a class="btn btn-link forgot" href="{{ route('password.request') }}">
                                    {{ __('Wachtwoord vergeten?') }}
                                </a>
                            @endif
                </div>

            </div>
<!--             <div class="login-section-right">
                <div class="login-section-right-1">
                    <p class="login-p-orange">WiZ</p>
                    <p class="login-p-white">2019</p>
                </div>
                <div class="login-section-right-2">
                    <p class="login-p-white-small">Weggooien is zonde, daarom biedt ®Kuijpers een beter alternatief.</p>
                </div>
                <div class="login-section-right-3">
                    <canvas id="line-chart" width="250" height="200"></canvas>
                </div>
                <div class="login-section-right-4">
                    <div>
                        <i class="far fa-compass login-p-white-large"></i>
                    </div>
                    <div>
                        <p class="login-p-white-small">Helmond</p>
                        <p class="login-p-white-medium">Noord-brabant</p>
                    </div>
                    
                </div>
            </div> -->
        </div>

    </body>
    <!-- jQuery & Bootstrap -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="{{ asset('js/chart.js') }}"></script>
    <script src="js/main.js"></script>

    <script type="text/javascript">
        
        new Chart(document.getElementById("line-chart"), {
  type: 'line',
  data: {
    labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Aug", "Sep", "Okt", "Nov", "Dec"],
    datasets: [{ 
        data: [10, 12, 22, 30, 52],
        label: "Producten",
        borderColor: "#f28e0b",
        pointBackgroundColor: "#f28e0b",
        pointBorderColor: "#f28e0b",
        fill: false
      }
    ]
  },
  options: {
    title: {
      display: true,
      text: 'Aantal producten toegevoegd aan WiZ'
    }
  }
});

        
    </script>
</html>

@endsection
