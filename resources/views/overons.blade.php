@extends('layouts.layout')
@section('titlePage')
    <title>WiZ Kuijpers - Over ons</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/about.css') }}">
@endsection
@section('content')
<div class="global-container">
  <div class="container container-overons">
      <div class="page-header">

      </div>
      <ul class="timeline" style="list-style: none;">
         <li class="timeline-inverted">
            <div class="timeline-badge 1"><i class="glyphicon glyphicon-check"></i></div>
            <div class="timeline-panel">
              <div class="timeline-heading">
                <h4 class="timeline-title">2020</h4>
              </div>
              <div class="timeline-body">
                 <p>
                     Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                     tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                     quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                     consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                     cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                     proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                  </p>
              </div>
            </div>
          </li>
          <li>
            <div class="timeline-badge warning"><i class="glyphicon glyphicon-credit-card"></i></div>
            
            <div class="timeline-panel">
              <div class="timeline-heading">
                <h4 class="timeline-title">2019</h4>
                    <div class="card-footer text-muted">
                      2-2-2019 t/m 26-6-2019
                    </div>
              </div>
              <div class="timeline-body">
                <p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra lá , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. Mé faiz elementum girarzis, nisi eros vermeio, in elementis mé pra quem é amistosis quis leo. Manduma pindureta q
                </p>
                <p>
                  <i class="fab fa-github"></i> Github: <a href="https://github.com/joeylooverbosch/WiZ_2019" target="_blank">https://github.com/joeylooverbosch/WiZ_2019</a>
                </p>
              </div>
            </div>
          </li>
          <li class="timeline-inverted">
            <div class="timeline-badge 1"><i class="glyphicon glyphicon-check"></i></div>
            <div class="timeline-panel">
              <div class="timeline-heading">
                <h4 class="timeline-title">2018</h4>
                    <div class="card-footer text-muted">
                      2-8-2018 t/m 28-1-2019
                    </div>
              </div>
              <div class="timeline-body">
                 <p>
                      Wij zijn Daan Swinkels & Ferdy Hommeles, wij doen de opleiding Applicatie- en Mediaontwikkeling op het
                      Summa College in Eindhoven en het ROC Ter AA in Helmond.<br> 
                      Als stage opdracht bij Kuijpers Business Partners in Helmond
                      hebben wij de WiZ applicatie gemaakt in samenwerking met Kuijpers. WiZ staat voor Weggooien is Zonde, de reden waarom
                      we deze website hebben gebouwd is omdat Kuijpers een beter inzicht wil krijgen welke producten er zijn overgebleven na het 
                      afronden van een project.
                  </p>
                  <p>
                    <i class="fab fa-github"></i> Github: <a href="https://github.com/FHommeles/WiZ" target="_blank">https://github.com/FHommeles/WiZ</a>
                  </p>
              </div>
            </div>
          </li>
      </ul>
  </div>
</div>
@endsection
@section('PWA')
    <div>
        <img id="btnAdd" alt="PWA popup" src="{{ asset('img/pwa-icon.png') }}">
    <div>
@endsection