<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta name=viewport content="width=device-width, initial-scale=1"/>
		<meta charset="utf-8">
		@yield("titlePage")
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="description" content="WiZ Kuijpers - Weggooien is Zonde, een overzicht van alle overgbleven producten van Kuijpers."/>
		<meta name="author" content="Daan Swinkels, Ferdy Hommeles">
		<meta name="keywords" content="Kuijpers,WiZ, Weggooien is Zonde">
		<!-- bootstrap - fontawesome -->
		<link rel="preload" href="{{ asset('fontawesome/css/all.min.css') }}" as="style" onload="this.rel='stylesheet'">
		<noscript>
			<link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
		</noscript>
		<link rel="preload" href="{{ asset('css/bootstrap.min.css') }}" as="style" onload="this.rel='stylesheet'">
		<noscript>
			<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
		</noscript>
		<!-- custom css -->
		<link rel="preload" href="{{ asset('css/main.css') }}" as="style" onload="this.rel='stylesheet'">
		<noscript>
			<link rel="stylesheet" href="{{ asset('css/main.css') }}">
		</noscript>
		<link rel="preload" href="{{ asset('css/footer.css') }}" as="style" onload="this.rel='stylesheet'">
		<noscript>
			<link rel="stylesheet" href="{{ asset('css/footer.css') }}">
		</noscript>
		<script src="https://cdn.rawgit.com/serratus/quaggaJS/0420d5e0/dist/quagga.min.js"></script>
		<!-- page specific css -->
		@yield('pageSpecificCSS')
		<!-- Chart.js -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
		{{-- 
		<link rel="shortcut icon" type="image/png" href="{{ asset('img/wizicon.png') }}">
		--}}
		{{-- @laravelPWA --}}
	</head>
	<body>
		<nav class="navbar navbar-expand-lg  bg-lignt mynavi">
			<!--  Show this only on mobile to medium screens  -->
			<a class="navbar-brand d-lg-none" href="#">                
			<img src="{{ asset('img/logo_wiz3.png') }}">
			</a>
			<button class="navbar-toggler navbar-toggler-right navibutton" type="button" data-toggle="collapse" data-target="#navbarToggle">
			☰
			</button>
			<!--  Use flexbox utility classes to change how the child elements are justified  -->
			<div class="collapse navbar-collapse justify-content-between" id="navbarToggle">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link active" href="#"> <img alt="Kuijpers Logo" src="{{ asset('img/logo-small.png') }}"></a>
					</li>
				</ul>
				<!--   Show this only lg screens and up   -->
				<a class="navbar-brand d-none d-lg-block" href="#">
				<img src="{{ asset('img/logo_wiz3.png') }}">
				</a>
				<ul class="navbar-nav Dropdown-Nav-Container">
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<img src="/storage/avatars/{{ Auth::user()->avatar }}" onerror=this.src="{{ asset('img/default.jpg') }}" width="100" height="100" class="rounded-circle">
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="/profiel">Profiel</a>
                            {{-- Hier wordt gecontroleerd of je NIET als Admin of product-manager bent ingelogd --}}
                            @if(Auth::user()->rechten != "User")
                            {{-- Alleen de admin en de product-managers kunnen deze optie zien --}}
							<a class="dropdown-item" href="/controlpanel">Controlepaneel</a>
							@endif
							<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
								document.getElementById('logout-form-profiel').submit();">Uitloggen</a>
							<form alt="logout" id="logout-form-profiel" action="{{ route('logout') }}" method="POST" style="display: none;">
								@csrf
							</form>
							</a>
						</div>
					</li>
				</ul>
			</div>
		</nav>
		<div class="container-fluid">
			<div class="row border-default">
				<div class="text-white p-2 col-3 text-center d-none d-sm-block mynavi2">
					<p><a aria-label="Home" class="nav-link" href="/home"><i class="fa fa-home"></i>Home</a></p>
				</div>
				<div class="text-white p-2 col-3 text-center d-block d-sm-none small mynavi2">
					<p><a class="nav-link" href="/home"><i class="fa fa-home"></i></a></p>
				</div>
				<div class="text-white p-2 col-3 text-center d-none d-sm-block mynavi2">
					<p><a aria-label="Overzicht" class="nav-link" href="/overzicht">Producten</a></p>
				</div>
				<div class="text-white p-2 col-3 text-center d-block d-sm-none small mynavi2">
					<p><a class="nav-link" href="/producten">Producten</a></p>
				</div>
				<div class="text-white p-2 col-3 text-center d-none d-sm-block mynavi2">
					<p><a aria-label="Onze resultaten" class="nav-link" href="/onze-resultaten">Onze resultaten</a></p>
				</div>
				<div class="text-white p-2 col-3 text-center d-block d-sm-none small mynavi2">
					<p><a class="nav-link" href="/onze-resultaten">Onze res..</a></p>
				</div>
				<div class="text-white p-2 col-3 text-center d-none d-sm-block mynavi2">
					<p><a aria-label="Over ons" class="nav-link" href="/overons">Over ons</a></p>
				</div>
				<div class="text-white p-2 col-3 text-center d-block d-sm-none small mynavi2">
					<p><a class="nav-link" href="/overons">Over ons</a></p>
				</div>
			</div>
		</div>
		@yield('shopmenu')
		<div id="app">
			@if (!strpos(url()->current(), "profiel"))
			@include('flash-message')
			@endif
		</div>
		@yield('content')
		<footer class="footer-distributed">
			<div class="footer-left">
				<a href="/home" >           
				<img alt="Kuijpers Logo" src="{{ asset('img/logo_wiz2.png') }}" class="img-fluid" id="wizlogofooter">
				</a>
				<p class="footer-links">
					<a href="/home" aria-label="Home" class="footernavhover">Home</a>
					·
					<a href="/overons" aria-label="Over ons" class="footernavhover">Over Ons</a>       
					·
					<a href="/overzicht" aria-label="Overzicht " class="footernavhover">Overzicht</a>
					·
					<a href="/profiel" aria-label="Profiel" class="footernavhover">Profiel</a>
					·
					<a href="https://www.kuijpers.nl/" aria-label="Mijn Kuijpers" target="blank" class="footernavhover" rel="noreferrer">Mijn Kuijpers</a>
				</p>
				<p aria-label="Kuijpers Installaties" class="footer-company-name">Kuijpers Installaties &copy; {{ date('Y') }}</p>
			</div>
			<div class="footer-center">
				<div>
					<i class="fas fa-map-marker-alt"></i>
					<a  target="blank" aria-label="Locatie" href="https://www.google.nl/maps/place/Panovenweg+20,+5708+HR+Helmond/@51.4738781,5.6267348,17z/data=!3m1!4b1!4m5!3m4!1s0x47c7214f44307933:0x16bd59b2e5452121!8m2!3d51.4738748!4d5.6289235" rel="noopener">
						<p><span>Panovenweg 18</span> Helmond, Nederland</p>
					</a>
				</div>
				<div>
					<i class="fas fa-phone"></i>
					<p>0900 20 50 800</p>
				</div>
				<div>
					<i class="fas fa-envelope"></i>
					<p><a href="mailto:wizkuijpers@gmail.com" aria-label="Email">wizkuijpers@gmail.com</a></p>
				</div>
			</div>
			<div class="footer-right">
				@yield('PWA')
				<div class="footer-icons">
					<a href="https://www.facebook.com/kuijpersNL/" aria-label="Facebook" target="blank"><i class="fab fa-facebook-f"></i></a>
					<a href="https://twitter.com/kuijpersnl" aria-label="Twitter" target="blank"><i class="fab fa-twitter"></i></a>
					<a href="https://www.youtube.com/user/KuijpersNL" aria-label="Youtube" target="blank"><i class="fab fa-youtube"></i></a>
					<a href="https://nl.linkedin.com/company/kuijpers-installaties" aria-label="LinkedIn" target="blank"><i class="fab fa-linkedin-in"></i></a>
					<a href="https://www.instagram.com/kuijpersnl/" aria-label="Instagram"target="blank"><i class="fab fa-instagram"></i></a>
				</div>
				<div class="footer-logoff profilepage socialiconhover">
					<a class="fas fa-power-off loggouthover" aria-label="Uitloggen" href="{{ route('logout') }}"
						onclick="event.preventDefault();
						document.getElementById('logout-form').submit();">
						<p class="uitloggenfootertext">Uitloggen</p>
					</a>
					<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
						@csrf
					</form>
				</div>
			</div>
		</footer>
		@yield('ajaxScript')
		@yield('charts')
		<script type="text/javascript" src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/anysearch.js') }}"></script>
		{{-- <script src="{{ asset('js/app.js') }}"></script> --}}
		<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>        
		@yield('tabJS')
		<script src="{{ asset('js/main.js') }}"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	</body>
</html>