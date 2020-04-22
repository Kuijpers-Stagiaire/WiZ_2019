@extends('layouts.layout')
@section('titlePage')
<title>WiZ Kuijpers - Home</title>
<link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
<link href="//db.onlinewebfonts.com/c/0801c08e5412f54e4b4e9ad146d83a12?family=Ink+Free" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
<div class="home-container">
<!--Carousel Wrapper-->
<div id="carousel-example-2" class="carousel slide carousel-fade" data-ride="carousel">
	<!--Indicators-->
	<ol class="carousel-indicators">
		<li data-target="#carousel-example-2" data-slide-to="0" class="active"></li>
		<li data-target="#carousel-example-2" data-slide-to="1"></li>
		<li data-target="#carousel-example-2" data-slide-to="2"></li>
	</ol>
	<!--/.Indicators-->
	<!--Slides-->
	<div class="carousel-inner" role="listbox">
		<div class="carousel-item active">
			<div class="view">
				<img class="d-block w-100" src="{{url('/img/gebouw.jpg')}}"
					alt="First slide">
				<div class="mask rgba-black-light"></div>
			</div>
			{{-- 
			<div class="carousel-caption">
				<h3 class="h3-responsive">Light mask</h3>
				<p>First text</p>
			</div>
			--}}
		</div>
		<div class="carousel-item">
			<!--Mask color-->
			<div class="view">
				<img class="d-block w-100" src="{{url('/img/kuijperskantoor.jpg')}}"
					alt="Second slide">
				<div class="mask rgba-black-strong"></div>
			</div>
			{{-- 
			<div class="carousel-caption">
				<h3 class="h3-responsive">Strong mask</h3>
				<p>Secondary text</p>
			</div>
			--}}
		</div>
		<div class="carousel-item">
			<!--Mask color-->
			<div class="view">
				<img class="d-block w-100" src="{{url('/img/KuijpersLogoGebouw.jpg')}}"
					alt="Third slide">
				<div class="mask rgba-black-slight"></div>
			</div>
			{{-- 
			<div class="carousel-caption">
				<h3 class="h3-responsive helpjeookmee">Help jij ook mee?</h3>
				<p>Third text</p>
			</div>
			--}}
		</div>
	</div>
	<!--/.Slides-->
	<!--Controls-->
	<a class="carousel-control-prev" href="#carousel-example-2" role="button" data-slide="prev">
	<span class="carousel-control-prev-icon iconstyling" aria-hidden="true"></span>
	<span class="sr-only">Previous</span>
	</a>
	<a class="carousel-control-next" href="#carousel-example-2" role="button" data-slide="next">
	<span class="carousel-control-next-icon iconstyling" aria-hidden="true"></span>
	<span class="sr-only">Next</span>
	</a>
	<!--/.Controls-->
</div>
<div class="container content-container">
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
			<div class="text WIZ">
				<h4>WIZ | Weggooien is Zonde</h4>
				<ul>
					<li class="text-points">Beter inzicht in niet-courante artikelen en voorraad</li>
					<li class="text-points">Minder weggooien, meer hergebruik</li>
					<li class="text-points">Hoger resultaat Recycling, MVO en Circulariteit</li>
					<li class="text-points">Beter voor je leefomgeving dus beter voor jou</li>
				</ul>
			</div>
			<br>
			<div class="text ja-nee">
				<div class="sticky ja">
					<h4>Ja</h4>
					<ul>
						<li class="text-points">Meer Inzicht</li>
						<li class="text-points">Hoger Resultaat</li>
						<li class="text-points">Beter Leefomgeving</li>
					</ul>
				</div>
			</div>
			<br>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
			<div class="text">
				<p class="vraag">Help jij ook mee?</p>
			</div>
			<br>
			<div class="text ja-nee">
				<div class="sticky nee">
					<h4>Nee</h4>
					<ul>
						<li class="text-points">Onnodig Weggooien</li>
						<li class="text-points">Overproductie</li>
						<li class="text-points">Overbelasting Leefomgeving</li>
					</ul>
				</div>
			</div>
			<br>
		</div>
	</div>
</div>
<!--/.Carousel Wrapper-->
@endsection