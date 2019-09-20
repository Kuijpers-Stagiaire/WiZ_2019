@extends('layouts.layout')
@section('pageSpecificCSS')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/homegraphs.css') }}" />
@endsection
@section('titlePage')
    <title>WiZ Kuijpers</title>
@endsection
@section('content')
    


    <div class="home-container">
        <div class="home-section-left">
           <p class="title">WiZ</p>
           <p class="text">WiZ, of weggooien is zonde, is ontwikkeld door stagiaires van Kuijpers. WiZ is ontwikkeld om het onnodig weggooien van courante producten te verminderen.</p>
            <div class="title stadsnaam" hidden="hidden"></div>
<!--             <canvas id="doughnut-chart" width="600" height="350"></canvas> -->
            <canvas id="line-chart" width="600" height="350"></canvas>

        </div>

        <div class="home-section-right">
            <div class="right">
            <div class="grid">
                <div class="grids grid-1"></div>
                <div class="grids grid-2"></div>
                <div class="grids grid-3">
                    <div class="grid-button" id="makkum"></div>
                </div>
                <div class="grids grid-4">
                    <div class="grid-button" id="groningen"></div>
                </div>
                <div class="grids grid-5"></div>
                <div class="grids grid-6">
                    <div class="grid-button" id="katwijk"></div>
                    <div class="grid-button" id="amsterdam"></div>
                </div>
                <div class="grids grid-7">
                    <div class="grid-button" id="zwolle"></div>
                </div>
                <div class="grids grid-8"></div>
                <div class="grids grid-9"></div>
                <div class="grids grid-10">
                    <div class="grid-button" id="den-haag"></div>
                    <div class="grid-button" id="utrecht"></div>
                    <div class="grid-button" id="roosendaal"></div>
                    <div class="grid-button" id="oosterhout"></div>
                    <div class="grid-button" id="tilburg"></div>
                </div>
                <div class="grids grid-11">
                    <div class="grid-button" id="den-bosch"></div>
                    <div class="grid-button" id="arnhem"></div>
                    <div class="grid-button" id="helmond"></div>
                </div>
                <div class="grids grid-12">
                    <div class="grid-button" id="zelhem"></div>
                </div>
                <div class="grids grid-13"></div>
                <div class="grids grid-14"></div>
                <div class="grids grid-15">
                    <div class="grid-button" id="echt"></div>
                </div>
                <div class="grids grid-16"></div>
            </div>
        </div>
        </div>
    </div>



@section('PWA')
    <div>
        <img id="btnAdd" alt="PWA popup" src="{{ asset('img/pwa-icon.png') }}">
        <div class="home-section-right-button groningen"></div>
        <div class="home-section-right-button makkum"></div>
        <div class="home-section-right-button amsterdam"></div>
        <div class="home-section-right-button katwijk"></div>
        <div class="home-section-right-button utrecht"></div>
        <div class="home-section-right-button den-haag"></div>
        <div class="home-section-right-button oosterhout"></div>
        <div class="home-section-right-button tilburg"></div>
        <div class="home-section-right-button roosendaal"></div>
        <div class="home-section-right-button den-bosch"></div>
        <div class="home-section-right-button helmond"></div>
        <div class="home-section-right-button echt"></div>
        <div class="home-section-right-button arnhem"></div>
        <div class="home-section-right-button zelhem"></div>
        <div class="home-section-right-button zwolle"></div>


    <div>
@endsection
@section('charts')
    <script src="{{ asset('js/raphael-2.1.4.min.js') }}"></script>
    <script src="{{ asset('js/jquery-3.3.1.max.js') }}"></script>
    <script src="{{ asset('js/justgage.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script src="{{ asset('js/Charts.js') }}"></script>
@endsection
@endsection
