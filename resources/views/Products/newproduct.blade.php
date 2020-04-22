@extends('layouts.layout')
@section('pageSpecificCSS')
<link rel="stylesheet" type="text/css" href="{{ asset('css/shop.css') }}" />
@endsection
@section('titlePage')
    <title>WiZ Kuijpers - Product toevoegen</title>
@endsection

@section('shopmenu')
    <div class="container-fluid">
        <div class="row " id="Searchnavbar"> 
            <div class="col order1 shop-bar">
                <style>
                        .dropdown-content a:hover {background-color: #ddd;}

                        .dropdown:hover .dropdown-content {display: block;}

                        .dropdown:hover .dropbtn {background-color: #2f2e90;}

                        .dropbtn {
                        /* background-color: #2f2e87;
                        color: white;
                        padding: 16px; 
                        font-size: 16px;
                        border: none;
                        text-align: center; */
                        border: 1px solid transparent; 
                        background : #2f2e87; 
                        color : white !important; 
                        height : 40px !important; 
                        display: flex; 
                        justify-content: space-around;
                        align-items: center; 
                        width: 200px; 
                        font-size: 17px;
                        border-radius: .25rem;
                        }

                        .dropdown {
                        position: relative;
                        display: inline-block;
                        }

                        .dropdown-content {
                        display: none;
                        position: absolute;
                        background-color: #f1f1f1;
                        min-width: 160px;
                        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
                        z-index: 1;
                        text-align: left;
                        }

                        .dropdown-content a {
                        color: black;
                        padding: 12px 16px;
                        text-decoration: none;
                        display: block;
                        font-size: 25px;
                        }
                        /* styling voor knop van image toevoegen. */
                        .inputfile {
                            width: 0.1px;
                            height: 0.1px;
                            opacity: 0;
                            overflow: hidden;
                            position: absolute;
                            z-index: -1;
                        }
                        .inputfile + label {
                            margin-top: 5px;
                            border-radius: .25rem;
                            padding: 10px;
                            font-size: 1.25em;
                            font-weight: 700;
                            color: white;
                            background-color: #2f2e87;
                            display: inline-block;
                            width:100%;
                        }

                        .inputfile:focus + label,
                        .inputfile + label:hover {
                            background-color: #f28e0b;
                        }
                        .inputfile + label {
                            cursor: pointer; /* "hand" cursor */
                        }
                    </style>

                    <div class="dropdown">
                      <button class="dropbtn" style="background : #2f2e87; color : white !important; height : 40px !important; display: flex; justify-content: space-around;align-items: center; width: 200px; font-size: 17px;">Nieuw product</button>
                      <div class="dropdown-content">
                        <a href="/overzicht/product_Scannen">Scannen</a>
                        <a href="/overzicht/nieuw">Handmatig</a>
                      </div>
                    </div>
                    <a href="/overzicht/bestellijst" class="btn searchbar-button-right" style="background : #2f2e87; color : white !important; height : 40px !important; display: flex; justify-content: space-around;align-items: center; width: 200px; font-size: 17px;">
                        <i class="fas fa-shopping-cart"></i> Winkelwagen
                    </a>
                <!-- <form class="Sbar" action="/overzicht/products/search" method="POST" role="search">
                    {{ csrf_field() }}
                    <input aria-label="Search product" type="text" placeholder="Search product" name="q">
                    <button aria-label="Search product" type="submit"><i class="fa fa-search"></i></button>
                </form> -->
                
                <!-- <select aria-label="Select categorie" class="form-control category" aria-label="Select category" onchange="window.location=this.options[this.selectedIndex].value">
                    <option value="" disabled selected hidden>Categorieën</option>
                    @foreach ($categories as $category)
                    <option value="/overzicht/products/{{ $category->productserie_naam }}">{{ $category->productserie_naam }}</option>
                    @endforeach
                </select> -->
            </div>
            
            <div class="col order-12 shop-bar addcol">
                <div class="addprod">
                    <!-- <a aria-label="Product toevoegen" href="/overzicht/nieuw" aria-label="Nieuw product toevoegen">
                        <i class="far fa-plus-square"></i>
                    </a> -->
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col pagetitle"> 
                <h2>Product toevoegen</h2>
            </div>
            <div class="col">
            {{-- <div class="btn-floating-container">
                <button class="btn-floating btn btn-primary btn-medium"><i class="fa fa-barcode " aria-hidden="true"></i>
                </button>
            </div> --}}
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-6">
                <div class="input-group">
                    <span class="input-group-btn"> 
                        {{-- <button class="btn btn-scan" type="button" id="btn" value="Start/Stop the scanner" data-toggle="modal" data-target="#livestream_scanner">
                            <i class="fa fa-barcode"></i>
                        </button>  --}}
                    </span>
                </div><!-- /input-group -->
            </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
        <div class="modal" id="livestream_scanner">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Barcode Scanner</h4>
                        <button type="button" id="scanclose" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>                        
                    </div>
                    <div class="modal-body">
                        <div id="interactive" class="viewport"></div>
                        <div class="error"></div>
                        <div id="scanner-container"></div>
                    </div>
                    <div class="modal-footer">
                        
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        {{-- 13-3-2020 aanpassing van namen en de knop voor foto opload aangepast--}}
        {{-- Formulier is aangepast. zodat de nieuwe database gebruikt kan worden. --}}
        <form action="/overzicht/nieuw/store" method="POST" enctype="multipart/form-data">
            @method('POST')
            @csrf
            <div class="row from-group">
                <div class="col-xl  form-group">
                    <h5>Product foto:</h5>
                    <div class="productphoto">
                        <img aria-label="Product foto" style="width:100%;" id="ProductImage" src="" onerror=this.src="{{ url('/img/img-placeholder.png') }}" class="img-fluid" name="ProductImage">
                        <br>
                        <input type="file" name="imagelink" id="file" class="inputfile" data-multiple-caption="{count} files selected" multiple onchange="previewFileShop()" />
                        <label for="file"><i class="far fa-file-image"></i>	&nbsp;<span>Choose a file...</span></label>
                    </div>

                    <h5>Product Omschrijving</h5>
                    <textarea aria-label="Product extra informatie"  class="form-control" rows="18" cols="100"  name="LongDescription" value="{{ old('LongDescription')}}"></textarea>
                    {{-- <textarea aria-label="Product extra informatie"  class="form-control" rows="7" cols="50"  name="ProductOmschrijving" value="{{ old('ProductOmschrijving')}}"></textarea> --}}
                </div>
                <div class="col-xl  form-group">
                    <div>
                        <h5><span style="color:red;">*</span>Product naam:</h5>
                        {{-- Aanpassing zodat de het geen omschrijving meer is maar Product naam --}}
                        <input aria-label="Product naam" id="Description" class="form-control{{ $errors->has('Description') ? ' is-invalid' : '' }}" type="text" name="Description" @if(isset($gtininfo)) value="{{$gtininfo[0]->Description}}" @endif value="{{ old('Description') }}" autofocus/>
                        <br>
                        @if ($errors->has('Description'))
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->first('Description') }}
                            </div>
                        @endif
                    </div>

                    <div>
                        <h5><span style="color:red;">*</span>Productcode:</h5>
                        <input aria-label="Productcode" id="Productcode" class="form-control{{ $errors->has('Productcode') ? ' is-invalid' : '' }}" type="text" name="Productcode" value="{{ old('Productcode') }}"/>
                        <br>
                        @if ($errors->has('Productcode'))
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->first('Productcode') }}
                            </div>
                        @endif
                    </div>

                    <div>
                        <h5>gtin_fabrikant:</h5>
                        <input aria-label="GTIN" class="form-control scanBtn{{ $errors->has('GTIN') ? ' is-invalid' : '' }}" type="text" id="GTIN" name="GTIN" @if(isset($gtininfo)) value="{{$gtininfo[0]->gtin}}" @endif value="{{ old('GTIN') }}"/>
                        <button class="btn btn-scan" type="button" id="btn" value="Start/Stop the scanner" data-toggle="modal" data-target="#livestream_scanner">
                            <i class="fa fa-barcode"></i>
                        </button> 
                        <br>
                        @if ($errors->has('GTIN'))
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->first('GTIN') }}
                            </div>
                        @endif
                        @if (isset($gtinerror))
                            <div class="alert alert-danger" role="alert">
                                Dit product is nog niet bij ons bekend, vul de rest van de informatie zelf in.
                            </div>
                        @endif
                    </div>
                    
                    <div>
                        <h5><span style="color:red;">*</span>Fabrikaat:</h5>
                        <input aria-label="ManufacturerName" id="ManufacturerName" class="form-control{{ $errors->has('ManufacturerName') ? ' is-invalid' : '' }}" type="text" name="ManufacturerName" @if(isset($gtininfo)) value="{{$gtininfo[0]->ManufacturerName}}"@endif value="{{ old('ManufacturerName') }}"/>
                        <br>
                        @if ($errors->has('ManufacturerName'))
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->first('ManufacturerName') }}
                            </div>
                        @endif
                    </div>

                    <div>
                        <h5><span style="color:red;">*</span>Product serie:</h5>
                        {{-- <input id="Productserie" class="form-control{{ $errors->has('Productserie') ? ' is-invalid' : '' }}" type="text" name="Productserie" required/> --}}
                        <select aria-label="Model" id="Model" class="form-control{{ $errors->has('Model') ? ' is-invalid' : '' }}" name="Model" value="{{ old('Model') }}">
                            <option disabled selected hidden>Product serie:</option>
                            <option value="IT" {{ old('Model') == 'IT' ? 'selected' : '' }}>IT</option>
                            <option value="Magazijn" {{ old('Model') == 'Magazijn' ? 'selected' : '' }}>Magazijn</option>
                            <option value="Diversen" {{ old('Model') == 'Diversen' ? 'selected' : '' }}>Diversen</option>
                            @if(isset($gtininfo)) 
                                <option selected>{{$gtininfo[0]->Model}}</option>
                            @endif
                        </select>
                        <br>
                        @if ($errors->has('Model'))
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->first('Model') }}
                            </div>
                        @endif
                    </div>

                    <div>
                        <h5><span style="color:red;">*</span>Product type:</h5>
                        {{-- <input id="Producttype" class="form-control{{ $errors->has('Producttype') ? ' is-invalid' : '' }}" type="text" name="Producttype" required/> --}}
                        <select aria-label="Version" id="Version" class="form-control{{ $errors->has('Version') ? ' is-invalid' : '' }}" name="Version" value="{{ old('Version') }}">
                            <option disabled selected hidden>Product type:</option>
                            <option value="Tablet" {{ old('Version') == 'Tablet' ? 'selected' : '' }}>Tablet</option>
                            <option value="Printer" {{ old('Version') == 'Printer' ? 'selected' : '' }}>Printer</option>
                            <option value="PC" {{ old('Version') == 'PC' ? 'selected' : '' }}>PC</option>
                            <option value="Monitor" {{ old('Version') == 'Monitor' ? 'selected' : '' }}>Monitor</option>
                            <option value="Laptop" {{ old('Version') == 'Laptop' ? 'selected' : '' }}>Laptop</option>
                            <option value="Flenzen" {{ old('Version') == 'Flenzen' ? 'selected' : '' }}>Flenzen</option>
                            <option value="Afsluiters" {{ old('Version') == 'Afsluiters' ? 'selected' : '' }}>Afsluiters</option>
                            <option value="RVS buizen" {{ old('Version') == 'RVS buizen' ? 'selected' : '' }}>RVS buizen</option>
                            <option value="Elektrische onderdelen" {{ old('Version') == 'Elektrische onderdelen' ? 'selected' : '' }}>Elektrische onderdelen</option>
                            <option value="T stukken" {{ old('Version') == 'T stukken' ? 'selected' : '' }}>T stukken</option>
                            <option value="Telefoons" {{ old('Version') == 'Telefoons' ? 'selected' : '' }}>Telefoons</option>
                            <option value="TL-buizen" {{ old('Version') == 'TL-buizen' ? 'selected' : '' }}>TL-buizen</option>
                            <option value="Diversen" {{ old('Version') == 'Diversen' ? 'selected' : '' }}>Diversen</option>
                            @if(isset($gtininfo)) 
                                <option selected>{{$gtininfo[0]->Version}}</option>
                            @endif
                        </select>
                        <br>
                        @if ($errors->has('Version'))
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->first('Version') }}
                            </div>
                        @endif
                    </div>
                    
                    <div>
                        <h5><span style="color:red;">*</span>Locatie:</h5>
                        {{-- <input id="Locatie" class="form-control{{ $errors->has('Locatie') ? ' is-invalid' : '' }}" type="text" name="Locatie" required/> --}}
                        <select aria-label="Locatie" id="Locatie" class="form-control{{ $errors->has('Locatie') ? ' is-invalid' : '' }}" name="Locatie" value="{{ old('Locatie') }}">
                            <option disabled selected hidden>Locatie:</option>
                            <option value="Amsterdam" {{ old('Locatie') == 'Amsterdam' ? 'selected' : '' }}>Amsterdam</option>
                            <option value="Arnhem" {{ old('Locatie') == 'Arnhem' ? 'selected' : '' }}>Arnhem</option>
                            <option value="Den Bosch" {{ old('Locatie') == 'Den Bosch' ? 'selected' : '' }}>Den Bosch</option>
                            <option value="Den Haag" {{ old('Locatie') == 'Den Haag' ? 'selected' : '' }}>Den Haag</option>
                            <option value="Echt" {{ old('Locatie') == 'Echt' ? 'selected' : '' }}>Echt</option>
                            <option value="Groningen" {{ old('Locatie') == 'Groningen' ? 'selected' : '' }}>Groningen</option>
                            <option value="Helmond" {{ old('Locatie') == 'Helmond' ? 'selected' : '' }}>Helmond</option>
                            <option value="Katwijk" {{ old('Locatie') == 'Katwijk' ? 'selected' : '' }}>Katwijk</option>
                            <option value="Makkum" {{ old('Locatie') == 'Makkum' ? 'selected' : '' }}>Makkum</option>
                            <option value="Oosterhout" {{ old('Locatie') == 'Oosterhout' ? 'selected' : '' }}>Oosterhout</option>
                            <option value="Roosendaal" {{ old('Locatie') == 'Roosendaal' ? 'selected' : '' }}>Roosendaal</option>
                            <option value="Tilburg" {{ old('Locatie') == 'Tilburg' ? 'selected' : '' }}>Tilburg</option>
                            <option value="Utrecht" {{ old('Locatie') == 'Utrecht' ? 'selected' : '' }}>Utrecht</option>
                            <option value="Zelhem" {{ old('Locatie') == 'Zelhem' ? 'selected' : '' }}>Zelhem</option>
                            <option value="Zwolle" {{ old('Locatie') == 'Zwolle' ? 'selected' : '' }}>Zwolle</option>
                        </select>
                        <br>
                        @if ($errors->has('Locatie'))
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->first('Locatie') }}
                            </div>
                        @endif

                    </div>
                    
                    <div>
                        <h5>Gewicht:</h5>
                        <input aria-label="Gewicht" id="WeightQuantity" class="form-control{{ $errors->has('WeightQuantity') ? ' is-invalid' : '' }}" type="text" name="WeightQuantity" value="{{ old('WeightQuantity') }}"/>
                        <br>
                        @if ($errors->has('Gewicht'))
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->first('Gewicht') }}
                            </div>
                        @endif
                    </div>

                    <div>
                        <h5>Eenheid gewicht:</h5>
                        <input aria-label="Eenheid gewicht" id="WeightMeasureUnitDescription" class="form-control{{ $errors->has('WeightMeasureUnitDescription') ? ' is-invalid' : '' }}" type="text" name="WeightMeasureUnitDescription" value="{{ old('WeightMeasureUnitDescription') }}"/>
                        <br>
                        @if ($errors->has('WeightMeasureUnitDescription'))
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->first('WeightMeasureUnitDescription') }}
                            </div>
                        @endif
                    </div>
                    
                    <div>
                        <h5>Aantal:</h5>
                        <input aria-label="Aantal" id="Aantal" class="form-control{{ $errors->has('Aantal') ? ' is-invalid' : '' }}" type="text" name="Aantal" value="{{ old('Aantal') }}"/>
                        <br>
                        @if ($errors->has('Aantal'))
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->first('Aantal') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col"></div>
                <div class="col-6 prodcreate">
                    <input class="btn btn-lg" type="submit" value="Toevoegen"/>
                </div>
                <div class="col"></div>
            </div>
        </form>
    </div>
    <script>     

            setTimeout(function() {
              $("#app").fadeOut("slow");
            }, 3000);


            function startScanner() {
                Quagga.init({
                    inputStream: {
                        name: "Live",
                        type: "LiveStream",
                        target: document.querySelector('#scanner-container'),
                        constraints: {
                            width: 480,
                            height: 320,
                            facingMode: "environment"
                        },
                    },
                    decoder: {
                        readers: [
                            // "code_128_reader"
                            "ean_reader"
                            // "ean_8_reader",
                            // "code_39_reader",
                            // "code_39_vin_reader",
                            // "codabar_reader",
                            // "upc_reader",
                            // "upc_e_reader",
                            // "i2of5_reader"
                        ],
                        debug: {
                            showCanvas: true,
                            showPatches: true,
                            showFoundPatches: true,
                            showSkeleton: true,
                            showLabels: true,
                            showPatchLabels: true,
                            showRemainingPatchLabels: true,
                            boxFromPatches: {
                                showTransformed: true,
                                showTransformedBox: true,
                                showBB: true
                            }
                        }
                    },
    
                }, function (err) {
                    if (err) {
                        console.log(err);
                        return
                        Quagga.initialized = true;
                        Quagga.start();
                    }
    
                    console.log("Initialization finished. Ready to start");
                    Quagga.start();
    
                    // Set flag to is running
                    _scannerIsRunning = true;
                });
    
                Quagga.onProcessed(function (result) {
                    var drawingCtx = Quagga.canvas.ctx.overlay,
                    drawingCanvas = Quagga.canvas.dom.overlay;
    
                    if (result) {
                        if (result.boxes) {
                            drawingCtx.clearRect(0, 0, parseInt(drawingCanvas.getAttribute("width")), parseInt(drawingCanvas.getAttribute("height")));
                            result.boxes.filter(function (box) {
                                return box !== result.box;
                            }).forEach(function (box) {
                                Quagga.ImageDebug.drawPath(box, { x: 0, y: 1 }, drawingCtx, { color: "green", lineWidth: 2 });
                            });
                        }
    
                        if (result.box) {
                            Quagga.ImageDebug.drawPath(result.box, { x: 0, y: 1 }, drawingCtx, { color: "#00F", lineWidth: 2 });
                        }
    
                        if (result.codeResult && result.codeResult.code) {
                            Quagga.ImageDebug.drawPath(result.line, { x: 'x', y: 'y' }, drawingCtx, { color: 'red', lineWidth: 3 });
                        }
                    }
                });
                function order_by_occurrence(arr) {
                    var counts = {};
                    arr.forEach(function(value){
                        if(!counts[value]) {
                            counts[value] = 0;
                        }
                        counts[value]++;
                    });

                    return Object.keys(counts).sort(function(curKey,nextKey) {
                        return counts[curKey] < counts[nextKey];
                    });
                }

                var last_result = [];
                Quagga.onDetected(function (result) {
                    var last_code = result.codeResult.code;
                    console.log("Barcode detected and processed : [" + result.codeResult.code + "]", result);
                    last_result.push(last_code);
                    if (last_result.length > 5) {
                        code = order_by_occurrence(last_result)[0];
                        console.log(last_result);
                        last_result = [];
                        document.getElementById('GTIN').value = code;
                        setTimeout(function(){ $('#livestream_scanner').modal('hide'); }, 500);

                        //De code hieronder Zorgde er voor dat bij scannen barcore auto maties doorgestuurd wordt.
                        // window.location = "/overzicht/nieuw/" + code,

                        Quagga.stop();
                    }
                    
                });
            }
    
            // Start/stop scanner
            document.getElementById("btn").addEventListener("click", function () {
                startScanner();
            });

            document.getElementById("scanclose").addEventListener("click", function () {
                Quagga.stop();
            });
            // javascript toegevoegd voor de image toevoegen knop.
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