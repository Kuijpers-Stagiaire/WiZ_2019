@extends('layouts.layout')
@section('pageSpecificCSS')
<link rel="stylesheet" type="text/css" href="{{ asset('css/shop.css') }}" />
@endsection
@section('titlePage')
    <title>WiZ Kuijpers - {{$productedit[0]->Description}} wijzigen</title>
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
                
                <select aria-label="Select categorie" class="form-control category" aria-label="Select category" onchange="window.location=this.options[this.selectedIndex].value">
                    <option value="" disabled selected hidden>Categorieën</option>
                    @foreach ($categories as $category)
                    <option value="/producten/products/{{ $category->productserie_naam }}">{{ $category->productserie_naam }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="col order-12 shop-bar addcol">
                <div class="addprod">
                    <a href="/producten/nieuw" aria-label="Nieuw product toevoegen">
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
            {{-- Tekst aangepast van Product toevoegen naar - product bewerken. --}}
            <div class="col pagetitle"> <h2>Product Bewerken</h2></div>
            <div class="col"></div>
        </div>
        <div class="row">
        <div class="col"></div>
        <div class="col justify-content-center">
        </div>
        <div class="col"></div>
    </div>
        {{-- END TEST  --}}
        {{-- Formulier aangepast naar nieuwe waardes --}}
        <form action="/producten/{{$productedit[0]->Product_id}}/update" method="POST" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            <div class="row from-group">
                <div class="col-xl  form-group">
                    <h5>Product foto:</h5>
                    <div class="productphoto">
                        <img aria-label="Product foto" style="width:100%;" src="{{$productedit[0]->ProductImage}}" id="ProductImage" src="" onerror=this.src="{{ url('/img/img-placeholder.png') }}" class="img-fluid" name="ProductImage">
                        <br>
                        <input type="file" name="ProductImage" id="file" class="inputfile" data-multiple-caption="{count} files selected" multiple onchange="previewFileShop()" />
                        <label for="file"><i class="far fa-file-image"></i>	&nbsp;<span>Choose a file...</span></label>
                        
                    </div>

                    <h5>Product extra informatie:</h5>
                    <textarea aria-label="Product extra informatie" class="form-control" rows="7" cols="50"  name="LongDescription" style="max-height:231px;">
                        @if(isset($productedit[0]->LongDescription)){{$productedit[0]->LongDescription}}@endif
                    </textarea>
                </div>
                <div class="col-xl  form-group">
                    <h5>Product naam:</h5>
                    <input aria-label="Description" class="form-control" type="text" name="Description"  value="{{$productedit[0]->Description}}" required/>
                    <h5>Productcode:</h5>
                    <input aria-label="Productcode" class="form-control" type="text" name="Productcode" value="{{$productedit[0]->Productcode}}" required/>
                    <input type="hidden" name="Product_id" value="{{$productedit[0]->Product_id}}" hidden>
                    <h5>gtin_fabrikant:</h5>
                    <input aria-label="GTIN" class="form-control" type="text" name="GTIN" value="@if(isset($productedit[0]->GTIN)){{$productedit[0]->GTIN}}@endif"/>
                    <h5>Fabrikaat:</h5>
                    <input aria-label="ManufacturerName" class="form-control" type="text" name="ManufacturerName" value="{{$productedit[0]->ManufacturerName}}" required/>
                    <h5>Productserie:</h5>
                    <input aria-label="Model" class="form-control" type="text" name="Model" value="{{$productedit[0]->Model}}" required/>
                    <h5>Producttype:</h5>
                    <input aria-label="Version" class="form-control" type="text" name="Version" value="{{$productedit[0]->Version}}" required/>
                    <h5>Locatie:</h5>
                    <input aria-label="Locatie" class="form-control" type="text" name="Locatie" value="{{$productedit[0]->Locatie}}" required/>
                    <h5>gewicht:</h5>
                    <input aria-label="WeightQuantity" class="form-control" type="text" name="WeightQuantity" value="{{$productedit[0]->WeightQuantity}}" required/>
                    <h5>Eenheid gewicht:</h5>
                    <input aria-label="WeightMeasureUnitDescription" class="form-control" type="text" name="WeightMeasureUnitDescription" value="{{$productedit[0]->WeightMeasureUnitDescription}}" required/>
                    <h5>Aantal:</h5>
                    <input aria-label="Aantal" class="form-control" type="text" name="Aantal" value="{{$productedit[0]->Aantal}}" required/>
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
    {{-- Javascript toegevoegd voor de product image knop. --}}
    <script>
        var inputs = document.querySelectorAll( '.inputfile' );
            Array.prototype.forEach.call( inputs, function( input )
            {
                var label	 = input.nextElementSibling,
                    labelVal = label.innerHTML;

                input.addEventListener( 'change', function( e )
                {
                    var fileName = '';
                    if( this.files && this.files.length > 1 ){
                        fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
                    }
                    else
                    {
                        fileName = e.target.value.split( "\\" ).pop();
                    }
                    if( fileName ){
                        console.log(fileName);
                        label.querySelector( 'span' ).innerHTML = fileName;
                    }
                    else{
                        label.innerHTML = labelVal;
                    }
                });
            });
    </script>
@endsection