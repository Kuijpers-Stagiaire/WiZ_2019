@extends('layouts.layout')
@section('titlePage')
    <title>WiZ Kuijpers - {{ $productdetail[0]->productomschrijving }}</title>
@endsection
@section('pageSpecificCSS')
<link rel="stylesheet" type="text/css" href="{{ asset('css/shop.css') }}" />

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
                    @foreach ($categories as $category)
                    <option value="/overzicht/products/{{ $category->productserie_naam }}">{{ $category->productserie_naam }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="col order-12 shop-bar addcol">
                <div class="addprod">
                    <a aria-label="Product toevoegen" href="/overzicht/nieuw" aria-label="Nieuw product toevoegen">
                        <i class="far fa-plus-square"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    @if ($productdetail > '')
        <div class="container">
            <br>
            <div class="row">
                <div class="col-10">
                    <h2 class="Producttitle">{{ $productdetail[0]->productomschrijving }}</h2>
                    <h6 class="Productundertitle"><i>{{ $productdetail[0]->productnaam }}</i></h6>
                </div>
                <div class="col prodedit">
                    <a aria-label="Pagina terug" href="/overzicht"><i class="fas fa-arrow-circle-left editdeleteicons "></i></a>
                    <a aria-label="Product wijzigen" href="/overzicht/{{ $productdetail[0]->id }}/edit"><i class="fas fa-wrench editdeleteicons "></i></a>
                    <i aria-label="Product verwijderen" class="tablinks far fa-trash-alt editdeleteicons proddel" onclick="openCity(event, 'proddel')"></i>
                    <i class="tablinks fas fa-info editdeleteicons" onclick="openCity(event, 'prodinfo')" id="defaultOpen" style="display: none;"></i>
                </div>
            </div>
            <hr id="userdetailline">
            <div class="usrinfo tabcontent" id="prodinfo">
                <div class="row">
                    <div class="col-6 detailimg">
                        <a href="#" id="pop" data-toggle='modal' data-target='#imagemodal'>
                            <img aria-label="Product foto" src="{{ $productdetail[0]->imagelink }}" data-target='#imagemodal' id="imageresource" class="productImg img-fluid myImg" onerror=this.src="{{ url('/img/img-placeholder.png') }}" width="330px" height="250px"/>
                        </a>                    
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content detailmodal">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{ $productdetail[0]->productomschrijving }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body detailmodal">
                                        <img aria-label="Prodcut foto" src="{{ $productdetail[0]->imagelink }}"  class=" img-fluid modalimage" onerror=this.src="{{ url('/img/img-placeholder.png') }}"/>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="userdetailverticalline"></div>
                        <div class="col prodinformatie">
                            <br>
                            <p><b>Productcode:</b></p>
                            <p><b>Ingangsdatum:</b></p>
                            <p><b>GTIN:</b></p>
                            <p><b>Fabikaat:</b></p>
                            <p><b>Serie:</b></p>
                            <p><b>Type:</b></p>
                            <p><b>Locatie:</b></p>
                            <p><b>Product gewicht:</b></p>
                            <p><b>Aantal:</b></p>
                            <p><b>Voornaam:</b></p>
                            <p><b>Achternaam:</b></p>
                            <p><b>Email:</b></p>
                        </div>
                        <div class="col prodinformatie">
                            <br>
                            <p>{{ $productdetail[0]->productcodefabrikant}} </p>
                            <p>{{ (empty($productdetail[0]->ingangsdatum)) ? $productdetail[0]->createdas : $productdetail[0]->ingangsdatum }} </p>
                            <p>{{ (empty($productdetail[0]->gtin)) ? 'Geen GTIN' : $productdetail[0]->gtin }}  </p>
                            <p>{{ $productdetail[0]->fabrikaat }} </p>
                            <p>{{ $productdetail[0]->product_serie }} </p>
                            <p>{{ $productdetail[0]->product_type }} </p>
                            <p>{{ $productdetail[0]->locatie }} </p>
                            <p>{{ $productdetail[0]->gewicht}} {{$productdetail[0]->gewicht_eenheid}}</p>
                            <p>{{ $productdetail[0]->aantal }} </p>
                          <p>{{ $productdetail[0]->product_toevoeger_voornaam }}</p>
                          <p>{{ $productdetail[0]->product_toevoeger_achternaam }}</p>
                          <p>{{ $productdetail[0]->product_toevoeger_email }}</p>
                            
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ $productdetail[0]->productomschrijving }} specificaties</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{ $productdetail[0]->specs }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
          </div>
        </div>

        <div class="usrinfo tabcontent" id="proddel">
            <div class="container">
                <div class="row confirmdeleteuser">
                        <div class="col">
                            <div class="confirmdel">
                                <h3>Weet je zeker dat je dit product wilt verwijderen?</h3>
                            </div>
                        </div>

                    </div>
                    <br>
                    <div class="row ">
                        <div class="col"></div>
                        <div class="col" id="delaccept">
                            <form action="/overzicht/productdetail/destroy/{{ $productdetail[0]->id}}" method="POST" class="delform" id="DelForm">
                                @method('DELETE')
                                @csrf
                                <button aria-label="Product verwijderen" type="submit" class="btn btn-success">Verwijder</button>
                            </form>
                        </div>
                        <div class="col" id="delannuleer">
                            <a href="/overzicht/productdetail/{{$productdetail[0]->id}}"><button aria-label="Annuleer" type="submit" class="btn btn-danger">Annuleer</button></a>
                        </div>
                        <div class="col"></div>
                    </div>
                </div>
            </div>
        </div>
    @else 
        <div class="container">
            <br>
            <div class="row">
                <div class="col">
                    <h2 class="Producttitle">{{ $productdetail->productomschrijving }}</h2>
                </div>
                <div class="col prodedit">
                        <a href="/overzicht"><i class="fas fa-arrow-circle-left editdeleteicons "></i></a>
                        <a href="/overzicht/{{ $productdetail->id }}/edit"><i class="fas fa-wrench editdeleteicons "></i></a>
                        <i class="tablinks far fa-trash-alt editdeleteicons proddel" onclick="openCity(event, 'proddel')"></i>
                        <i class="tablinks fas fa-info editdeleteicons" onclick="openCity(event, 'prodinfo')" id="defaultOpen" style="display: none;"></i>
                    </div>
            </div>
            <hr id="userdetailline">
            <div class="row">
                <div class="col-6">
                    <a href="#" id="pop">
                        <img src="{{ $productdetail->imagelink }}" id="imageresource" class="productImg img-fluid myImg" onerror=this.src="{{ url('/img/img-placeholder.png') }}" width="330px" height="250px"/>
                    </a>
                </div>
                        <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog " role="document">
                        <div class="modal-content detailmodal">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">{{ $productdetail[0]->productomschrijving }} specificaties</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                {{ $productdetail[0]->specs }}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
                </div>
                <div id="userdetailverticalline"></div>
                <div class="col">
                    <br>
                    <b>Productcode:</b><br><br>
                    <b>Ingangsdatum:</b><br><br>
                    <b>gtin_fabrikant:</b><br><br>
                    <b>Fabikaat:</b><br><br>
                    <b>Productserie:</b><br><br>
                </div>
                <div class="col">
                    <br>
                    {{ $productdetail->productcodefabrikant}} <br><br>
                    {{ $productdetail->ingangsdatum }} <br><br>
                    {{ $productdetail->GTIN }}  <br><br>
                    {{ $productdetail->fabrikaat }} <br><br>
                    {{ $productdetail->productserie }} <br><br>
                </div>
            </div>
        </div>
        <div class="usrinfo tabcontent" id="proddel">
            <div class="container">
                <div class="row confirmdeleteuser">
                        <div class="col">
                            <div class="confirmdel">
                                <h3>Weet je zeker dat je dit product wilt verwijderen?</h3>
                            </div>
                        </div>

                    </div>
                    <br>
                    <div class="row deleteconfirm">
                        <div class="col"></div>
                        <div class="col" id="delaccept">
                            <form action="/overzicht/productdetail/destroy/{{ $productdetail[0]->id}}" method="POST" class="delform" id="DelForm">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-success">Verwijder</button>
                            </form>
                        </div>
                        <div class="col" id="delannuleer">
                            <a href="/overzicht"><button type="submit" class="btn btn-danger">Annuleer</button></a>
                        </div>
                        <div class="col"></div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    


@endsection
@section('tabJS')
    <script src="{{ asset('js/tab.js') }}"></script> 
@endsection