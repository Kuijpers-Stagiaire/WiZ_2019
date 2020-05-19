@extends('layouts.layout')
@section('pageSpecificCSS')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/shop.css') }}" />
@endsection
@section('titlePage')
    <title>WiZ Kuijpers - Producten</title>
@endsection

@section('shopmenu')
    <div class="container-fluid">
        <div class="row " id="Searchnavbar"> 
            <div class="col order1 shop-bar">
                <form class="Sbar" action="/producten/products/search" method="POST" role="search">
                    {{ csrf_field() }}
                    <input aria-label="Search product" type="text" placeholder="Search product" name="q">
                    <button aria-label="Search product" type="submit"><i class="fa fa-search"></i></button>
                </form>
                <select class="form-control category" aria-label="Select category" onchange="window.location=this.options[this.selectedIndex].value">
                    <option value="" disabled selected hidden>Categorieën</option>
                    @if (isset($categories))
                    @foreach ($categories as $category)
                    <option value="/producten/products/{{ $category->productserie_naam }}">{{ $category->productserie_naam }}</option>
                    @endforeach
                    @endif
                </select>
            </div>
            <div class="col order-12 shop-bar addcol">
                <div class="addprod">
                    <a href="/producten/nieuw" class="btn" class="btn searchbar-button-right" style="background : #2f2e87; color : white !important; height : 40px !important; display: flex; justify-content: space-around;align-items: center; width: 200px; font-size: 17px; ">
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
                                    <a aria-label="{{$prodscat->id}}" href="/producten/productdetail/{{$prodscat->id}}"><h5 class="card-title">{{$prodscat->productnaam}}</h5></a>
                                    {{-- <a aria-label="{{$prodscat->productomschrijving}}" href="/producten/productdetail/{{$prodscat->productcodefabrikant}}"><h5 class="card-title">{{$prodscat->productomschrijving}}</h5></a> --}}
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
                                    <div class="button-grp">
                                        <a href="/producten/productdetail/{{$prodscat->id}}" class="btn btn-product">Bekijk</a>
                                        @if($prodscat->aantal <= 0)
                                        <button class='btn-open btn btn-product' id='{{$prodscat->id}}' disabled='disabled'>Toevoegen</button>
                                        @else
                                        <button class='btn-open btn btn-product' id='{{$prodscat->id}}' >Toevoegen</button>
                                        @endif
                                    </div>  
                                </div>
                            </div>
                            <div class="modal {{$prodscat->id}}" id="myModal" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            {{-- Product omschrijving is veranderd naar productnaam --}}
                                            <h5 class="modal-title">{{$prodscat->productnaam}}</h5>
                                            <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        {{-- Aanpassing van code zodat de id per element verschillend is en dat de form nu klopt en de aantal meestuurd naar de winkelwagen pagina. --}}
                                        <form method="Get" action="/producten/addItem/{{$prodscat->id}}">
                                            @csrf
                                            <div class="modal-body">
                                                <img alt="{{$prodscat->productnaam}}" src="{{$prodscat->imagelink}}" onerror=this.src="{{url('/img/img-placeholder.png')}}" class="producttypeimg" width="150"/>
                                                <div class="form-group">
                                                    <label for="InputAantal-{{$prodscat->id}}-onlangstoegevoegd">Aantal</label>
                                                    <input name="Aantal" type="text" class="form-control form-amount-{{$prodscat->id}}" id="InputAantal-{{$prodscat->id}}-onlangstoegevoegd" aria-describedby="emailHelp" max="{{$prodscat->aantal}}">
                                                    <small id="emailHelp" class="form-text text-muted">Vul hier het gewenste aantal producten in.</small>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-close" data-dismiss="modal">Close</button>
                                                    {{-- <a href="/producten/addItem/{{$productsOT->id}}/" id="{{$productsOT->id}}" class="btn-primary btn-add btn-add-{{$productsOT->id}}">Toevoegen</a> --}}
                                                    <button type="submit" id="{{$prodscat->id}}-Toevoegen" class="btn-primary btn-add btn-add-{{$prodscat->id}}">Toevoegen</button>
                                                </div>
                                            </div>
                                        </form>
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
                                    <a aria-label="{{$searchprod->id}}" href="/producten/productdetail/{{$searchprod->id}}"><h5 class="card-title">{{$searchprod->productnaam}}</h5></a>
                                    {{-- <a aria-label="{{$searchprod->productomschrijving}}" href="/producten/productdetail/{{$searchprod->productcodefabrikant}}"><h5 class="card-title">{{$searchprod->productomschrijving}}</h5></a> --}}
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
                                    <div class="button-grp">
                                        <a href="/producten/productdetail/{{$searchprod->id}}" class="btn btn-product">Bekijk</a>
                                        @if($searchprod->aantal <= 0)
                                            <button class='btn-open btn btn-product' id='{{$searchprod->id}}' disabled='disabled'>Toevoegen</button>
                                        @else
                                            <button class='btn-open btn btn-product' id='{{$searchprod->id}}'>Toevoegen</button>
                                        @endif
                                    </div>   
                                </div>
                            </div>
 
                            <div class="modal {{$searchprod->id}}" id="myModal" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            {{-- Product omschrijving is veranderd naar productnaam --}}
                                            <h5 class="modal-title">{{$searchprod->productnaam}}</h5>
                                            <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        {{-- Aanpassing van code zodat de id per element verschillend is en dat de form nu klopt en de aantal meestuurd naar de winkelwagen pagina. --}}
                                        <form method="Get" action="/producten/addItem/{{$searchprod->id}}">
                                            @csrf
                                            <div class="modal-body">
                                                <img alt="{{$searchprod->productnaam}}" src="{{$searchprod->imagelink}}" onerror=this.src="{{url('/img/img-placeholder.png')}}" class="producttypeimg" width="150"/>
                                                <div class="form-group">
                                                    <label for="InputAantal-{{$searchprod->id}}-onlangstoegevoegd">Aantal</label>
                                                    <input name="Aantal" type="text" class="form-control form-amount-{{$searchprod->id}}" id="InputAantal-{{$searchprod->id}}-onlangstoegevoegd" aria-describedby="emailHelp" max="{{$searchprod->aantal}}">
                                                    <small id="emailHelp" class="form-text text-muted">Vul hier het gewenste aantal producten in.</small>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-close" data-dismiss="modal">Close</button>
                                                    {{-- <a href="/producten/addItem/{{$productsOT->id}}/" id="{{$productsOT->id}}" class="btn-primary btn-add btn-add-{{$productsOT->id}}">Toevoegen</a> --}}
                                                    <button type="submit" id="{{$searchprod->id}}-Toevoegen" class="btn-primary btn-add btn-add-{{$searchprod->id}}">Toevoegen</button>
                                                </div>
                                            </div>
                                        </form>
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
    <script
	src="http://code.jquery.com/jquery-3.3.1.js"
	integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
	crossorigin="anonymous"></script>
    <script>
               setTimeout(function() {
	              $("#app").fadeOut("slow");
	            }, 3000);
	 
	        $(".btn-open").on("click", function(){
	
	            var item = $(this).attr("id");
	            
	            $("." + item).toggle();
	
	        });
	
	        $(".btn-add").on("click", function(){
	
	            var item = $(this).attr("id");
	
	            var amount = $(".form-amount-" + item).val();
	
	            var href = $(".btn-add-" + item).attr("href");
	
	            $(".btn-add").attr("href", href + amount);
	
	            var href_new = $(".btn-add").attr("href");
	
	        });
	
	        $(".btn-close").on("click", function(){
	            $(".modal").hide();
	        })
    </script>
@endsection