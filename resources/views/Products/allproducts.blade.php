@extends('layouts.layout')
@section('pageSpecificCSS')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/shop.css') }}" />
@endsection
@section('titlePage')
    <title>WiZ Kuijpers - Overzicht</title>
@endsection

@section('shopmenu')
    <div class="container-fluid">
        <div class="row " id="Searchnavbar"> 
            <div class="col order1 shop-bar">
                <form class="Sbar" action="/overzicht/products/search" method="POST" role="search">
                    {{ csrf_field() }}
                    <input aria-label="Search product" type="text" placeholder="Search product" name="q">
                    <button aria-label="Search product" type="submit"><i class="fa fa-search"></i></button>
                </form>
                <select class="form-control category" aria-label="Select category" onchange="window.location=this.options[this.selectedIndex].value">
                    <option value="" disabled selected hidden>Categorieën</option>
                    @if (isset($categories))
                    @foreach ($categories as $category)
                    <option value="/overzicht/products/{{ $category->productserie_naam }}">{{ $category->productserie_naam }}</option>
                    @endforeach
                    @endif
                </select>
            </div>
            <div class="col order-12 shop-bar addcol">
                <div class="addprod">
                    <a href="/overzicht/nieuw" class="btn" class="btn searchbar-button-right" style="background : #2f2e87; color : white !important; height : 40px !important; display: flex; justify-content: space-around;align-items: center; width: 200px; font-size: 17px; ">
                      <i class="fas fa-plus-square" style="color : white !important;"></i> Nieuw product 
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-fluid Cprods">
        <div class="row">
        </div>
            @if (isset($prodscats))
            <h2 class="searchresults">Zoek resulaten:</h2>

                {{-- Producten van een geselecteerde categorie --}}
                @foreach($prodscats->chunk(3) as $chunk)
                    <div class="row PCall">
                        @foreach ($chunk as $prodscat)
                            <div class="col colcat">
                                <div class="card PCcard">
                                    <img aria-label="Product foto" class="card-img-left PCimg img-fluid" src="{{$prodscat->imagelink}}" alt="Card image cap" onerror=this.src="{{ url('/img/img-placeholder.png') }}" width="330px" height="250px">
                                    {{-- Deze code hieronder is verander zodat er bij de veriable $prodscat->productcodefabrikant naar $prodscat->id nu staat --}}
                                    <a aria-label="{{$prodscat->id}}" href="/overzicht/productdetail/{{$prodscat->id}}"><h5 class="card-title">{{$prodscat->productnaam}}</h5></a>
                                    {{-- <a aria-label="{{$prodscat->productomschrijving}}" href="/overzicht/productdetail/{{$prodscat->productcodefabrikant}}"><h5 class="card-title">{{$prodscat->productomschrijving}}</h5></a> --}}
                                    <div class="card-body ulinfo"> 
                                        <ul class="prodvraag">
                                            <li>Locatie:</li>
                                            <li>Type:</li>
                                            <li>Fabrikaat:</li>
                                            <li>Serie:</li>
                                            <li>Aantal:</li></b>
                                        </ul>
                                        <ul class="prodinfo">
                                            <li>{{$prodscat->locatie}}</li>
                                            <li>{{$prodscat->producttype}}</li>
                                            <li>{{$prodscat->fabrikaat}}</li>
                                            <li>{{$prodscat->productserie}}</li>
                                            <li>{{$prodscat->aantal}}</li>
                                        </ul>
                                    </div>   
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
                <div class="row">
                    <div class="col-5"></div>
                    <div class="col-2 pagelink">
                        {{ $prodscats->links() }}
                    </div>
                    <div class="col-5"></div>
                </div>
            @else
            @endif
            {{-- Zoek resultaten --}}
            @if(isset($searchproducts))
                <h2 class="searchresults">Zoek resulaten:</h2>
                @foreach ($searchproducts->chunk(3) as $chunk)
                    <div class="row PCcard">
                        @foreach ($chunk as $searchprod)
                        
                            <div class="col colcat">
                                <div class="card PCcard ">
                                    {{-- De code hier onder zorgt er voor dat als er een product foto ontbreek dat er daan een placeholder.png laat zien --}}
                                    <img class="card-img-left PCimg img-fluid" src="{{$searchprod->imagelink}}" alt="Card image cap" onerror=this.src="{{ url('/img/img-placeholder.png') }}" width="330px" height="250px">
                                    {{-- <img class="card-img-left PCimg img-fluid" src="{{$searchprod->imagelink}}" alt="Card image cap" width="330px" height="250px"> --}}
                                    {{-- Deze code hieronder is verander zodat er bij de veriable $searchprod->productcodefabrikant naar $searchprod->id nu staat --}}
                                    <a aria-label="{{$searchprod->id}}" href="/overzicht/productdetail/{{$searchprod->id}}"><h5 class="card-title">{{$searchprod->productnaam}}</h5></a>
                                    {{-- <a aria-label="{{$searchprod->productomschrijving}}" href="/overzicht/productdetail/{{$searchprod->productcodefabrikant}}"><h5 class="card-title">{{$searchprod->productomschrijving}}</h5></a> --}}
                                    <div class="card-body ulinfo"> 
                                        <ul class="prodvraag">
                                            <li>Locatie:</li>
                                            <li>Type:</li>
                                            <li>Fabrikaat:</li>
                                            <li>Serie:</li>
                                            <li>Aantal:</li></b>
                                        </ul>
                                        <ul class="prodinfo">
                                            <li>{{$searchprod->locatie}}</li>
                                            <li>{{$searchprod->producttype}}</li>
                                            <li>{{$searchprod->fabrikaat}}</li>
                                            <li>{{$searchprod->productserie}}</li>
                                            <li>{{$searchprod->aantal}}</li>
                                        </ul>
                                    </div>   
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
                {{ $searchproducts->links() }}
            @else 
            @endif
            @if(isset($searcherror))
                {{-- Geen zoek resultaten --}}
                <div class="row prodnotfoundicon">
                    <div class="col"></div>
                    <div class="col-6"><i class="fas fa-times"></i></div>
                    <div class="col"></div>
                </div>
                <div class="row prodnotfound">
                    <div class="col"></div>
                    <div class="col-6 searcherrorprod"> <h3>{{$searcherror}}</h3></div>
                    <div class="col"></div>
                </div>
                <h3></h3>
            @endif
        </div>
    </div>
@endsection