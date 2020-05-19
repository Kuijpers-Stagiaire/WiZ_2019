@extends('layouts.layout')
@section('pageSpecificCSS')
<link rel="stylesheet" type="text/css" href="{{ asset('css/shop.css') }}" />
@endsection
@section('titlePage')
    <title>WiZ Kuijpers - Product toevoegen</title>
@endsection


@section('content')
<div class="custom-modal-body-child-1">
    <!-- Tijdelijke placeholder afbeelding, zodra er een product gescand is, wordt deze afbeelding veranderdt naar de afbeelding van het product. -->
    <img src="https://oie.msu.edu/_assets/images/placeholder/placeholder-200x200.jpg" onerror=this.src="{{ url('/img/img-placeholder.png') }}" class="custom-modal-img" width="200" height="200">
    </div>
    <div class="custom-modal-body-child-2">
    <!-- Tabel waar alle productinformatie te zien gaat worden. -->
        <table class="table table-striped table-bordered table-hover table-responsive custom-table">
            <tbody>
            <thead>
            <tr>
                <td style="width:18%;">ID:</td>
                <td class=""><input class="custom-modal-form-data-design custom-modal-id"></td>
            </tr>
        </thead>
            <tr>
                <td>Merk:</td>
                <td><input class="custom-modal-form-data-design custom-modal-merk" required="required" name="merk"></td>
            </tr>
            <tr>
                <td>Productnaam:</td>
                <td><input class="custom-modal-form-data-design custom-modal-productnaam" name="productnaam"required="required" ></td>
            </tr>
            <tr>
                <td>Productomschrijving</td>
                <td><textarea class="custom-modal-form-data-design custom-modal-productomschrijving" name="productomschrijving" style="min-height:60px;max-height:80px;" ></textarea></td>
            </tr>
            <tr>
                <td>Serie</td>
                <td><input class="custom-modal-form-data-design custom-modal-serie" name="serie"></td>
            </tr>

            <tr>
                <td>Model</td>
                <td><input class="custom-modal-form-data-design custom-modal-type" name="type" required="required" ></td>
            </tr>

            <tr>
                <td>Productcode</td>
                <td><input class="custom-modal-form-data-design custom-modal-productcode" name="productcode" ></td>
            </tr>
            <tr>
                <td>GLN</td>
                <td><input class="custom-modal-form-data-design custom-modal-gln" name="gln" required="required" ></td>
            </tr>
            <tr>
                <td>GTIN</td>
                <td><input class="custom-modal-form-data-design custom-modal-gtin" name="gtin" required="required" ></td>
            </tr>
            <tr>
                <td>Deeplink</td>
                <td><a class="custom-modal-deeplink2" href="" target="_blank"><input class="custom-modal-form-data-design custom-modal-deeplink" name="deeplink" style="color : blue !important;cursor:pointer;" required="required" readonly></a></td>
                <input type="hidden" class="hidden-image" name="image" value="">
                <input type="hidden" class="hidden-aantal" name="aantal" value="">
                <input type="hidden" class="hidden-gewicht-eenheid" name="gewicht-eenheid" value="">
                <input type="hidden" class="hidden-gewicht" name="gewicht" value="">

                <input type="hidden" class="hidden-productnaam-volledig" name="productnaam-volledig" value="">
                <input type="hidden" class="hidden-producttype" name="producttype" value="">
            </tr>
            </tbody>
        </table>
    </div>
    <!-- <div class="container">
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
                </div> -->
                <!-- /input-group -->
            <!-- </div> -->
            <!-- /.col-lg-6 -->
        <!-- </div> -->
        <!-- /.row -->
        <!-- <div class="modal" id="livestream_scanner">
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
                        
                    </div> -->
                <!-- </div> -->
                <!-- /.modal-content -->
            <!-- </div> -->
            <!-- /.modal-dialog -->
        <!-- </div> -->
        <!-- /.modal -->

        <!--<form action="/producten/nieuw/store" method="POST" enctype="multipart/form-data">
            @method('POST')
            @csrf
            <div class="row from-group">
                <div class="col-xl  form-group">
                    <h5>Product foto:</h5>
                    <div class="productphoto">
                        <img aria-label="Product foto" id="imgShop" src="" onerror=this.src="{{ url('/img/img-placeholder.png') }}" class="img-fluid" name="imagelink">
                        <br>
                        <input aria-label="Product foto teovoegen" type="file" name="imagelink" onchange="previewFileShop()">
                    </div>

                    <h5>Product extra informatie:</h5>
                    <textarea aria-label="Product extra informatie"  class="form-control" rows="7" cols="50"  name="Specificaties" value="{{ old('Specificaties')}}"></textarea>
                </div>
                <div class="col-xl  form-group">
                    <div>
                        <h5>Product naam:</h5>
                        <input aria-label="Product naam" id="Productomschrijving" class="form-control{{ $errors->has('Productomschrijving') ? ' is-invalid' : '' }}" type="text" name="Productomschrijving" @if(isset($gtininfo)) value="{{$gtininfo[0]->productomschrijving}}" @endif value="{{ old('Productomschrijving') }}" autofocus/>
                        <br>
                        @if ($errors->has('Productomschrijving'))
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->first('Productomschrijving') }}
                            </div>
                        @endif
                    </div>

                    <div>
                        <h5>Productcode:</h5>
                        <input aria-label="Productcode" id="Productcodefabrikant" class="form-control{{ $errors->has('Productcodefabrikant') ? ' is-invalid' : '' }}" type="text" name="Productcodefabrikant" value="{{ old('Productcodefabrikant') }}"/>
                        <br>
                        @if ($errors->has('Productcodefabrikant'))
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->first('Productcodefabrikant') }}
                            </div>
                        @endif
                    </div>

                    <div>
                        <h5>gtin_fabrikant:</h5>
                    <input aria-label="gtin_fabrikant" class="form-control scanBtn{{ $errors->has('GTIN') ? ' is-invalid' : '' }}" type="text" id="GTIN" name="GTIN" @if(isset($gtininfo)) value="{{$gtininfo[0]->gtin}}" @endif value="{{ old('GTIN') }}"/>
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
                        <h5>Fabrikaat:</h5>
                        <input aria-label="Fabrikaat" id="Fabrikaat" class="form-control{{ $errors->has('Fabrikaat') ? ' is-invalid' : '' }}" type="text" name="Fabrikaat" @if(isset($gtininfo)) value="{{$gtininfo[0]->fabrikaat}}"@endif value="{{ old('Fabrikaat') }}"/>
                        <br>
                        @if ($errors->has('Fabrikaat'))
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->first('Fabrikaat') }}
                            </div>
                        @endif
                    </div>
                    
                    <div>
                        <h5>Productserie:</h5>
                        {{-- <input id="Productserie" class="form-control{{ $errors->has('Productserie') ? ' is-invalid' : '' }}" type="text" name="Productserie" required/> --}}
                        <select aria-label="Productserie" id="Productserie" class="form-control{{ $errors->has('Productserie') ? ' is-invalid' : '' }}" name="Productserie" value="{{ old('Productserie') }}">
                            <option disabled selected hidden>Productserie:</option>
                            <option>IT</option>
                            <option>Magazijn</option>
                            <option>Diversen</option>
                            @if(isset($gtininfo)) 
                                <option selected>{{$gtininfo[0]->productserie}}</option>
                            @endif
                        </select>
                        <br>
                        @if ($errors->has('Productserie'))
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->first('Productserie') }}
                            </div>
                        @endif
                    </div>

                    <div>
                        <h5>Producttype:</h5>
                        {{-- <input id="Producttype" class="form-control{{ $errors->has('Producttype') ? ' is-invalid' : '' }}" type="text" name="Producttype" required/> --}}
                        <select aria-label="Producttype" id="Producttype" class="form-control{{ $errors->has('Producttype') ? ' is-invalid' : '' }}" name="Producttype" value="{{ old('Producttype') }}">
                            <option disabled selected hidden>Producttype:</option>
                            <option>Tablet</option>
                            <option>Printer</option>
                            <option>PC</option>
                            <option>Monitor</option>
                            <option>Laptop</option>
                            <option>Flenzen</option>
                            <option>Afsluiters</option>
                            <option>RVS buizen</option>
                            <option>Elektrische onderdelen</option>
                            <option>T stukken</option>
                            <option>Telefoons</option>
                            <option>TL-buizen</option>
                            <option>Diversen</option>
                            @if(isset($gtininfo)) 
                                <option selected>{{$gtininfo[0]->producttype}}</option>
                            @endif
                        </select>
                        <br>
                        @if ($errors->has('Producttype'))
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->first('Producttype') }}
                            </div>
                        @endif
                    </div>
                    
                    <div>
                        <h5>Locatie:</h5>
                        {{-- <input id="Locatie" class="form-control{{ $errors->has('Locatie') ? ' is-invalid' : '' }}" type="text" name="Locatie" required/> --}}
                        <select aria-label="Locatie" id="Locatie" class="form-control{{ $errors->has('Locatie') ? ' is-invalid' : '' }}" name="Locatie" value="{{ old('Locatie') }}">
                            <option disabled selected hidden>Vestiging:</option>
                            <option>Amsterdam</option>
                            <option>Arnhem</option>
                            <option>Den Bosch</option>
                            <option>Den Haag</option>
                            <option>Echt</option>
                            <option>Groningen</option>
                            <option>Helmond</option>
                            <option>Katwijk</option>
                            <option>Makkum</option>
                            <option>Oosterhout</option>
                            <option>Roosendaal</option>
                            <option>Tilburg</option>
                            <option>Utrecht</option>
                            <option>Zelhem</option>
                            <option>Zwolle</option>
                        </select>
                        <br>
                        @if ($errors->has('Locatie'))
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->first('Locatie') }}
                            </div>
                        @endif

                    </div>
                    
                    <div>
                        <h5>Eenheid gewicht:</h5>
                        <input aria-label="Eenheid gewicht" id="Eenheidgewicht" class="form-control{{ $errors->has('Eenheidgewicht') ? ' is-invalid' : '' }}" type="text" name="Eenheidgewicht" value="{{ old('Eenheidgewicht') }}"/>
                        <br>
                        @if ($errors->has('Eenheidgewicht'))
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->first('Eenheidgewicht') }}
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
    </div> -->
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

                        window.location = "/producten/nieuw/" + code,

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
        </script>
@endsection