@extends('layouts.layout')
@section('pageSpecificCSS')
<link rel="stylesheet" type="text/css" href="{{ asset('css/shop.css') }}" />
@endsection
@section('titlePage')
    <title>WiZ Kuijpers - {{$productedit[0]->productomschrijving}} wijzigen</title>
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
                
                <select aria-label="Select categorie" class="form-control category" aria-label="Select category" onchange="window.location=this.options[this.selectedIndex].value">
                    <option value="" disabled selected hidden>Categorieën</option>
                    @foreach ($categories as $category)
                    <option value="/overzicht/products/{{ $category->productserie_naam }}">{{ $category->productserie_naam }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="col order-12 shop-bar addcol">
                <div class="addprod">
                    <a href="/overzicht/nieuw" aria-label="Nieuw product toevoegen">
                        <i class="far fa-plus-square"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col pagetitle"> <h2>Product toevoegen</h2></div>
            <div class="col"></div>
        </div>
        <div class="row">
        <div class="col"></div>
        <div class="col justify-content-center">
        </div>
        <div class="col"></div>
    </div>
        {{-- END TEST  --}}
        <form action="/overzicht/{{$productedit[0]->id}}/update" method="POST" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            <div class="row from-group">
                <div class="col-xl  form-group">
                    <h5>Product foto:</h5>
                    <div class="productphoto">
                        <img aria-label="Product foto" id="imgShop" src="{{$productedit[0]->imagelink}}" class="img-fluid" name="imagelink">
                        <br>
                        <input aria-label="Foto product toevoegen" type="file" name="imagelink" onchange="previewFileShop()">
                    </div>

                    <h5>Product extra informatie:</h5>
                    <textarea aria-label="Product extra informatie" class="form-control" rows="7" cols="50"  name="Specificaties" style="max-height:231px;">
                        @if(isset($productedit[0]->specs)){{$productedit[0]->specs}}@endif
                    </textarea>
                </div>
                <div class="col-xl  form-group">
                    <h5>Product naam:</h5>
                    <input aria-label="Productomschrijving" class="form-control" type="text" name="Productomschrijving"  value="{{$productedit[0]->productomschrijving}}" required/>
                    <h5>Productcode:</h5>
                    <input aria-label="Productcodefabrikant" class="form-control" type="text" name="Productcodefabrikant" value="{{$productedit[0]->productcodefabrikant}}" required/>
                    <input type="hidden" name="id" value="{{$productedit[0]->id}}" hidden>
                    <h5>gtin_fabrikant:</h5>
                    <input aria-label="GTIN" class="form-control" type="text" name="GTIN" value="@if(isset($productedit[0]->GTIN)){{$productedit[0]->GTIN}}@endif"/>
                    <h5>Fabrikaat:</h5>
                    <input aria-label="Fabrikaat" class="form-control" type="text" name="Fabrikaat" value="{{$productedit[0]->fabrikaat}}" required/>
                    <h5>Productserie:</h5>
                    <input aria-label="Productserie" class="form-control" type="text" name="Productserie" value="{{$productedit[0]->productserie}}" required/>
                    <h5>Producttype:</h5>
                    <input aria-label="Producttype" class="form-control" type="text" name="Producttype" value="{{$productedit[0]->producttype}}" required/>
                    <h5>Locatie:</h5>
                    <input aria-label="Locatie" class="form-control" type="text" name="Locatie" value="{{$productedit[0]->locatie}}" required/>
                    <h5>Eenheid gewicht:</h5>
                    <input aria-label="Eenheidgewicht" class="form-control" type="text" name="Eenheidgewicht" value="{{$productedit[0]->gewicht}}" />
                    <h5>Aantal:</h5>
                    <input aria-label="Aantal" class="form-control" type="text" name="Aantal" value="{{$productedit[0]->aantal}}" />
                </div>
            </div>
            <div class="row">
                <div class="col"></div>
                <div class="col-6 prodcreate">
                    <input aria-label="Product updaten" class="btn btn-lg" type="submit" value="Updaten"/>
                </div>
                <div class="col"></div>
            </div>
        </form>
    </div>
@endsection