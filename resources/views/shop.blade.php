@if(session('status'))
{{ session('status') }}
@endif
@extends('layouts.layout')
@section('pageSpecificCSS')
<link rel="stylesheet" type="text/css" href="{{ asset('css/shop.css') }}" />
@endsection
@section('titlePage')
<title>WiZ Kuijpers - producten</title>
@endsection
@section('shopmenu')
<?php 
	// Haal de token op uit de sessie, om deze te gebruiken bij het ophalen van producten.
	echo '<div class="hidden-token" hidden>' . Session::get('token') . '</div>';
	?>
<div class="container-fluid">
	<div class="row " id="Searchnavbar">
		<div class="shop-bar">
			<style>
				.dropdown-content a:hover {background-color: #ddd;}
				.dropdown:hover .dropdown-content {display: block;}
				.dropdown:hover .dropbtn {background-color: #2f2e90;}
				.dropbtn {
				/* background-color: #2f2e87;
				color: white;
				padding: 16px; 
				font-size: 16px;
				border: none;*/
				text-align: center; 
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
				display: flex;
				float: right;
				margin: 5px;
				align-items: center; 
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
			</style>
			<div class="addprod">
				<div class="dropdown">
					<button class="dropbtn" >Nieuw product
					<i class="fas fa-plus-square" style="color : white !important;"></i>
					</button>
					<div class="dropdown-content">
						<a href="producten/product_Scannen">Scannen</a>
						<a href="producten/nieuw">Handmatig</a>
					</div>
				</div>
				<a href="/producten/bestellijst" class="btn searchbar-button-right" style="float: right; background : #2f2e87; color : white !important; height : 40px !important; display: flex; justify-content: space-around;align-items: center; width: 200px; font-size: 17px;">
				<i class="fas fa-shopping-cart"></i> Winkelwagen
				</a>
			</div>
			<div class="searchprod">
				<form class="Sbar" action="/producten/products/search" method="POST" role="search">
					{{ csrf_field() }}
					<input aria-label="Search product" type="text" placeholder="Zoek product" name="q" class="searchbar-button">
					<button aria-label="Submit search" type="submit"><i class="fa fa-search" class="searchbar-button"></i></button>
				</form>
				<select class="form-control category" aria-label="Select category" onchange="window.location=this.options[this.selectedIndex].value">
					<option value="" disabled selected hidden>Categorieën</option>
					@foreach ($categories as $category)
					<option value="/producten/products/{{ $category->productserie_naam }}">{{ $category->productserie_naam }}</option>
					@endforeach
				</select>
			</div>
		</div>
		<!-- <div class="col order-12 shop-bar addcol"> -->
		<!-- Button trigger modal -->
		<!-- <a href="" class="btn" data-toggle="modal" data-target="#exampleModal" class="btn searchbar-button-right" style="background : #2f2e87; color : white !important; height : 40px !important; display: flex; justify-content: space-around;align-items: center; width: 200px; font-size: 17px; ">
			<i class="fas fa-plus-square" style="color : white !important;"></i> Nieuw product 
			</a> -->
		<!-- </div> -->
		<!-- Modal -->
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document" style="height : 490px;margin-top:150px;">
				<div class="modal-content" style="height : 630px;">
					<div class="modal-header custom-modal-header">
						<div class="modal-title-tab-1">Barcode</div>
						<a class="modal-title-tab-2" href="http://127.0.0.1:8000/producten/nieuw">Handmatig</a>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="hr"></div>
						<div class="alert alert-danger alert-scan" role="alert" style="font-size:16px !important; display: none !important; display: flex; align-items: center;justify-content: flex-start !important;">Fout! Uw barcode is incorrect.
						</div>
						<div class="custom-modal-body">
							<form method="post" action="/producten/nieuw_scanned" enctype="multipart/form-data" class="custom-modal-body" id="form-barcode">
								@method('POST')
								@csrf
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
											<td><textarea class="custom-modal-form-data-design custom-modal-productomschrijving" name="productomschrijving" style="min-height:60px;max-height:80px;"></textarea></td>
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
							</form>
						</div>
						<div class="modal-footer custom-modal-footer">
							<div class="custom-modal-footer-section">
								<input type="number" class="custom-aantal-input" name="aantal" form="form-barcode" placeholder="Aantal" required="required" min="0" oninput="validity.valid||(value='');" step="1">
								<select class="custom-aantal-input custom-modal-category" name="custom-modal-category" form="form-barcode">
									@foreach ($categories as $category)
									<option value="{{ $category->productserie_naam }}">{{ $category->productserie_naam }}</option>
									@endforeach
								</select>
							</div>
							<div>
								<button type="button" class="btn btn-secondary push" data-dismiss="modal">Sluiten</button>
								<button type="submit" class="btn btn-primary custom-modal-opslaan" form="form-barcode">Product toevoegen</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- </div> -->
	</div>
</div>
@endsection
@section('content')
{{-- @if ($errors->any())
<div class="alert alert-danger" style="margin-top:10px !important;width:900px;margin:0 auto;">
	<button type="button" class="close" data-dismiss="alert">×</button>	
	<ul>
		@foreach ($errors->all() as $error)
		<div class="Err">{{ $error }}</div>
		@endforeach
	</ul>
</div>
@endif --}}
{{-- 
<div class="alert alert-danger" style="margin-top:10px !important;width:900px;margin:0 auto;">
	<button type="button" class="close" data-dismiss="alert">×</button>	
	Please check the form below for errors
</div>
--}}
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-8 mainshopprods">
			<h3>Categorieën</h3>
			<div class="row row-categories">
				@foreach ($categories as $category)
				<div class="card card-categories col-3" >
					<a href="/producten/products/{{ $category->productserie_naam }}">
						<p class="card-text card-text-categories h6 text-center">{{$category->productserie_naam}}</p>
						{{-- Deze code hieronder zorgt er voor dat er op de producten pagina als er een foto ontbreekt van de catogorien er een default image inlaad --}}
						<img class="card-img-top card-img-categories" src="{{$category->productserie_img}}"  alt="Card image cap"  onerror=this.src="{{ url('/img/img-placeholder.png') }}">
						{{-- <img class="card-img-top card-img-categories" src="{{$category->productserie_img}}"  alt="Card image cap"> --}}
					</a>
					<!-- UNCOMMENT THIS TO ACTIVATE STYLE WITH BUTTON -->
					<!--                           <div class="card-body card-body-categories">
						<a href="/producten/products/{{ $category->productserie_naam }}" class="btn btn-product" style="width : 180px !important;"><i class="fas fa-arrow-circle-right"></i> Bekijk</a>
						</div> -->
				</div>
				@endforeach
			</div>
		</div>
		<div class="col sidecols"></div>
		<div class="eerderbekeken">
			@if(isset($productsOTs))
			<div class="col eerderbekeken">
				<h3 class="onlangs">Onlangs toegevoegd</h3>
				@foreach ($productsOTs as $productsOT) 
				<!-- END OF OLD DESIGN -->
				<div class="card card-vl flex-row flex-wrap card-ot">
					<div class="card-header card-header-img border-0">
						{{-- Deze code hieronder zorgt er voor dat er op de producten pagina als er een foto ontbreekt van de catogorien er een default image inlaad --}}
						{{-- <img alt="{{$productsOT->productomschrijving}}" src="{{$productsOT->imagelink}}" class="producttypeimg" width="150"/> --}}
						<img alt="{{$productsOT->productnaam}}" src="{{$productsOT->imagelink}}" onerror=this.src="{{url('/img/img-placeholder.png')}}" class="producttypeimg" width="150"/>
					</div>
					<div class="card-block px-2">
						<!-- 15 if on normal pc, 27 on big -->
						<?php  
							$cut = 15;
							$out = strlen($productsOT->productnaam) > $cut ? substr($productsOT->productnaam,0,$cut)."..." : $productsOT->productnaam; 
							
							if ($out == "") {
							  $out = strlen($productsOT->productnaam) > $cut ? substr($productsOT->productnaam,0,$cut)."..." : $productsOT->productnaam;;
							}
							
							?>
						<h4 class="card-title">{{$out}}</h4>
						<span class="app_txt ulinfo">
							<ul class="prodvraag">
								<li>Locatie:</li>
								<li>Serie:</li>
								<li>Aantal:</li>
								</b>
							</ul>
							<ul class="prodinfo">
								<li>{{$productsOT->locatie}}</li>
								<li>{{$productsOT->productserie}}</li>
								<li class="product-aantal">{{$productsOT->aantal}}</li>
							</ul>
						</span>
						<a href="/producten/productdetail/{{$productsOT->id}}" class="btn btn-product" id="testing">Bekijk</a>
						<?php if ($productsOT->aantal <= 0) {
							echo "<button class='btn-open btn btn-product' id='$productsOT->id' disabled='disabled'>Toevoegen</button>";
							}else{
							echo "<button class='btn-open btn btn-product' id='$productsOT->id'>Toevoegen</button>";
							
							}
							
							?>
					</div>
					<div class="w-100"></div>
				</div>
				<div class="modal {{$productsOT->id}}" id="myModal" tabindex="-1" role="dialog">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								{{-- Product omschrijving is veranderd naar productnaam --}}
								<h5 class="modal-title">{{$productsOT->productnaam}}</h5>
								<button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								</button>
							</div>
							{{-- Aanpassing van code zodat de id per element verschillend is en dat de form nu klopt en de aantal meestuurd naar de winkelwagen pagina. --}}
							<form method="Get" action="/producten/addItem/{{$productsOT->id}}">
								@csrf
								<div class="modal-body">
									<img alt="{{$productsOT->productnaam}}" src="{{$productsOT->imagelink}}" onerror=this.src="{{url('/img/img-placeholder.png')}}" class="producttypeimg" width="150"/>
									<div class="form-group">
										<label for="InputAantal-{{$productsOT->id}}-onlangstoegevoegd">Aantal</label>
										<input name="Aantal" type="text" class="form-control form-amount-{{$productsOT->id}}" id="InputAantal-{{$productsOT->id}}-onlangstoegevoegd" aria-describedby="emailHelp" max="{{$productsOT->aantal}}">
										<small id="emailHelp" class="form-text text-muted">Vul hier het gewenste aantal producten in.</small>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary btn-close" data-dismiss="modal">Close</button>
										{{-- <a href="/producten/addItem/{{$productsOT->id}}/" id="{{$productsOT->id}}" class="btn-primary btn-add btn-add-{{$productsOT->id}}">Toevoegen</a> --}}
										<button type="submit" id="{{$productsOT->id}}-Toevoegen" class="btn-primary btn-add btn-add-{{$productsOT->id}}">Toevoegen</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				@endforeach
			</div>
			@endif
		</div>
		<div class="sidecols col"></div>
	</div>
</div>
<h3 class="bijkijkook-h3">Bekijk ook deze producten</h3>
<div class="container-fluid">
	<div class="row">
		<div class="col bekijkook">
			<div class="card-group">
				@if (isset($bekijkook))
				@foreach ($bekijkook as $bekijk)
				<div class="card bekijkcards flexbekijkook">
					<img alt="{{$bekijk->productomschrijving}}" class="card-img-top bekijkookimg" src="{{$bekijk->imagelink}}" onerror=this.src="{{ url('/img/img-placeholder.png') }}" width="300" height="300">
					{{-- Deze code hieronder is verander zodat er bij de veriable $bekijk->productcodefabrikant naar $bekijk->id nu staat --}}
					<a href="/producten/productdetail/{{$bekijk->id}}" class="card-link">
						<h5 class="card-title title-product">{{$bekijk->productnaam}} <span class="badge badge-product badge-pill badge-dark">{{$bekijk->aantal}}</span></h5>
					</a>
					{{-- 
					<a href="/producten/productdetail/{{$bekijk->productcodefabrikant}}" class="card-link">
						<h5 class="card-title title-product">{{$bekijk->productomschrijving}} <span class="badge badge-product badge-pill badge-dark">{{$bekijk->aantal}}</span></h5>
					</a>
					--}}
					<div class="card-body ulinfo">
						<ul class="prodvraag">
							<li>Locatie:</li>
							<li>Ingangsdatum:</li>
							<li>Fabrikaat:</li>
							<li>Serie:</li>
							</b>
						</ul>
						<ul class="prodinfo">
							<li>{{$bekijk->locatie}}</li>
							<li>{{$bekijk->ingangsdatum}}</li>
							<li>{{$bekijk->fabrikaat}}</li>
							<li>{{$bekijk->productserie}}</li>
						</ul>
					</div>
					<div class="button-grp">
						<a href="/producten/productdetail/{{$bekijk->id}}" class="btn btn-product">Bekijk</a>
						<button class="btn-open btn btn-product" id="{{$bekijk->id}}">Toevoegen</button>
					</div>
				</div>
				<div class="modal {{$bekijk->id}}" id="myModal" tabindex="-1" role="dialog">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								{{-- Product omschrijving is veranderd naar productnaam --}}
								<h5 class="modal-title">{{$bekijk->productnaam}}</h5>
								<button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								</button>
							</div>
							{{-- Aanpassing van code zodat de id per element verschillend is en dat de form nu klopt en de aantal meestuurd naar de winkelwagen pagina. --}}
							<div class="modal-body">
								<img alt="{{$bekijk->productnaam}}" src="{{$bekijk->imagelink}}" onerror=this.src="{{url('/img/img-placeholder.png')}}" class="producttypeimg" width="150"/>
								{{-- 
								<form> --}}
									{{-- Aanpassing form method en action toegevoegd--}}
								<form method="POST " action="/producten/addItem/{{$bekijk->id}}/">
									<div class="form-group">
										<label for="InputAantal-{{$bekijk->id}}-Bekijkmeer">Aantal</label>
										<input type="text" name="Aantal" required="required" class="form-control form-amount-{{$bekijk->id}}" id="InputAantal-{{$bekijk->id}}-Bekijkmeer" aria-describedby="emailHelp" max="{{$bekijk->aantal}}">
										<small id="emailHelp" class="form-text text-muted">Vul hier het gewenste aantal producten in.</small>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary btn-close" data-dismiss="modal">Close</button>
										{{-- <a href="/producten/addItem/{{$bekijk->id}}/" type="submit" id="{{$bekijk->id}}" class="btn btn-primary btn-add btn-add-{{$bekijk->id}}">Toevoegen</a> --}}
										{{-- Aanpassing gemaakt van 
										<a>
											tag naar <button> tag inverban met form--}}
											<button type="submit" id="{{$bekijk->id}}" class="btn btn-primary btn-add btn-add-{{$bekijk->id}}">Toevoegen</button>
									</div>
								</form>
							</div>
							{{-- <div class="modal-footer">
							<button type="button" class="btn btn-secondary btn-close" data-dismiss="modal">Close</button>
							<a href="/producten/addItem/{{$bekijk->id}}/" type="button" id="{{$bekijk->id}}" class="btn btn-primary btn-add btn-add-{{$bekijk->id}}">Toevoegen</a>
							</div> --}}
						</div>
					</div>
				</div>
				@endforeach
				@else 
				<h1>not set</h1>
				@endif 
			</div>
		</div>
	</div>
</div>
</div>
</div>
{{-- 
<div class="container-fluid bekijkook">
	<h3>Bekijk ook deze producten:</h3>
	<div class="row">
		@if (isset($bekijkook))
	</div>
	@php $counttabID = 0 @endphp
	<div class="tab list-group">
		<button type="button" class="tablinks list-group-item list-group-item-action" onclick="openCity(event, 'menu1')" id="defaultOpen">menu1</button>
		<button type="button" class="tablinks list-group-item list-group-item-action" onclick="openCity(event, 'menu2')">menu2</button>
		<button type="button" class="tablinks list-group-item list-group-item-action" onclick="openCity(event, 'menu3')">menu3</button>
		<button type="button" class="tablinks list-group-item list-group-item-action" onclick="openCity(event, 'menu4')">menu4</button>
	</div>
	@foreach ($bekijkook as $bekijk)
	@php $counttabID++ @endphp
	<div id="menu{{$counttabID}}" class="tabcontent">
		<h3>{{$bekijk->productomschrijving}}</h3>
		<p>London is the capital city of England.</p>
	</div>
	@endforeach
	@else 
	<h1>not set</h1>
	@endif       
</div>
</div> --}}
@endsection
@section('PWA')
<div>
<img id="btnAdd" alt="PWA popup" src="{{ asset('img/pwa-icon.png') }}">
<div>
@endsection
<script
	src="http://code.jquery.com/jquery-3.3.1.js"
	integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
	crossorigin="anonymous"></script>
<script>
	$(document).ready(function () {
	  // Wanneer een barcode gescand is, zal deze functie geroepen worden.
	  $(document).scannerDetection({
	    timeBeforeScanTest: 100, // De periode die gewacht wordt tussen elk character(om te zien of het een barcodescanner is, en geen normaal toetsenbord).
	    avgTimeByChar: 30, // Het is geen barcode als de gemiddelde periode tussen input gemiddeld langer is dan 30 miliseconde.
	    // preventDefault: true, // Deze instelling zorgde ervoor dat normale inputs niet meer werkte, zie de CRPR-lijst voor een beter beschrijving.
	      // Het is een barcode wanneer de waarde gelijk is aan 13(standaard lengte van een gtin-barcode).
	      endChar: [13],
	      // Wanneer alle parameters voldoen aan de minimale waarden, wordt de volgende functie uitgevoerd.
	      onComplete: function(barcode, qty){
	      // Controleer of het gaat om een GTIN-barcode, zo niet laat een melding zien aan de gebruiker die na 3 seconden weg gaat.
	      if(barcode.length != 13){
	        $(".alert-scan").text("De barcode levert helaas geen resultaten op! Probeer een nieuwe barcode of voeg het product handmatig toe.");
	        $(".alert-scan").show().delay(3000).fadeOut();
	      }else{
	      validScan = true;
	      // Voeg een 0 toe aan de barcode, de reden hiervoor staat in de CRPR-lijst
	      retrieveData("0" + barcode);
	      }
	      },
	      // Wanneer een barcode onsuccesvol ingescand is, wordt de volgende code uitgevoerd. GitTest
	      onError: function(string, qty) {
	      }
	    });
	
	    // Stop de gescande waarde van de barcodescanner in de functieparameter, om te gebruiken bij het ophalen van een product.
	    function retrieveData(barcode){
	      // Token die verstopt zit in een ontzichtbare div.
	      $token = $(".hidden-token").text();
	
	      // Ajax call naar een lokaal php-script genaamd: retrieveProductInfo.php(script wat productinfo ophaalt).
	      $.ajax({
	              url: "http://127.0.0.1:8000/retrieveProductInfo.php",
	              contentType: "application/json",
	              dataType: 'json',
	              data: {
	                  barcode : barcode,
	                  token : $token
	              },
	              // Als de query succesvol is uitgevoerd, voer het volgende uit:
	              success: function(result){
	
	                  // JSON parse de opgehaalde waardes(stop ze in een makkelijk uitleesbare javascript object).
	                  if(result == ""){
	                    $(".alert-scan").text("De barcode levert helaas geen resultaten op! Probeer een nieuwe barcode of voeg het product handmatig toe.");
	                    $(".alert-scan").show().delay(3000).fadeOut();
	                  }else{
	                  var result = JSON.parse(result);
	                  console.log(result);
	
	                  // Vul de tabel die men te zien krijgt met de nieuwe opgehaalde waarde.
	                  $(".custom-modal-id").val(result.Id);
	                  $(".custom-modal-merk").val(result.ManufacturerName);
	                  $(".custom-modal-productnaam").val(result.ProductClassDescription);
	                  $(".custom-modal-productomschrijving").val(result.LongDescription);
	                  $(".custom-modal-productcode").val(result.Productcode);
	                  $(".custom-modal-gln").val(result.ManufacturerGLN);
	                  $(".custom-modal-gtin").val(result.GTIN);
	                  $(".custom-modal-deeplink").val(result.ManufacturerName);
	                  $(".custom-modal-deeplink2").attr("href", result.Deeplink);
	                  $(".custom-modal-img").attr("src", "https://api.2ba.nl/1/json/Thumbnail/Product?gln="+ result.ManufacturerGLN +"&productcode="+ result.Productcode +"");
	
	                  // ... versopte inputs, hierin komt informatie die niet relevant is voor de gebruiker te staan.
	
	                  $(".hidden-gewicht-eenheid").val(result.WeightMeasureUnitDescription);
	                  $(".hidden-gewicht").val(result.WeightQuantity);
	                  $(".hidden-productnaam-volledig").val(result.Description);
	                  $(".custom-modal-serie").val(result.Model);
	                  $(".custom-modal-type").val(result.Version);
	                  
	                  $(".hidden-image").val("https://api.2ba.nl/1/json/Thumbnail/Product?gln="+ result.ManufacturerGLN +"&productcode="+ result.Productcode +"");
	                  $(".hidden-producttype").val(result.ProductClassDescription);
	                  }
	                  
	              }
	          });
	      }
	
	
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
	    });
	
</script>