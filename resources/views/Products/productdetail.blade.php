@extends('layouts.layout')
@section('titlePage')
{{-- veriable aangepast --}}
<title>WiZ Kuijpers - {{ $productdetail[0]->Description }}</title>
@endsection
@section('pageSpecificCSS')
<link rel="stylesheet" type="text/css" href="{{ asset('css/shop.css') }}" />
@endsection
@section('shopmenu')
{{-- <div class="container-fluid searchcontainer">
	<div class="row">
		<div class="col">
			<form class="Sbar" action="/producten/products/search" method="POST" role="search">
				{{ csrf_field() }}
				<input aria-label="Search product" type="text" placeholder="Search product" name="q">
				<button aria-label="Search product" type="submit"><i class="fa fa-search"></i></button>
			</form>
		</div>
		<div class="col">
			<select class="form-control category" aria-label="Select category" onchange="window.location=this.options[this.selectedIndex].value">
				<option value="" disabled selected hidden>Categorieën</option>
				@foreach ($categories as $category)
				<option value="/producten/products/{{ $category->productserie_naam }}">{{ $category->productserie_naam }}</option>
				@endforeach
			</select>
		</div>
		<div class="col">
			<div class="addprod">
				<a aria-label="Product toevoegen" href="/producten/nieuw" aria-label="Nieuw product toevoegen">
				<i class="far fa-plus-square"></i>
				</a>
			</div>
        </div>
        <div class="col">
			<div class="addprod">
				<a aria-label="Product toevoegen" href="/producten/nieuw" aria-label="Nieuw product toevoegen">
				<i class="far fa-plus-square"></i>
				</a>
			</div>
		</div>
	</div>
</div> --}}

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
</div>

@endsection
@section('content')
@if ($productdetail > '')
<div class="container">
	<br>
	<div class="row">
		<div class="col-8">
			{{-- variable aangepast. --}}
			{{-- 
			<h2 class="Producttitle">{{ $productdetail[0]->productnaam }}</h2>
			<h6 class="Productundertitle"><i>{{ $productdetail[0]->productomschrijving }}</i></h6>
			--}}
			<h2 class="Producttitle">{{ $productdetail[0]->Description }}</h2>
			<h6 class="Productundertitle"><i>{{ $productdetail[0]->LongDescription }}</i></h6>
		</div>
		<div class="col">
			@if($productdetail[0]->Aantal <= 0)
				<button class='btn-open btn btn-product' id='{{$productdetail[0]->Product_id}}' disabled='disabled'>Toevoegen</button>
			@else
				<button class='btn-open btn btn-product' id='{{$productdetail[0]->Product_id}}'>Toevoegen</button>
			@endif
		</div>
		<div class="modal {{$productdetail[0]->Product_id}}" id="myModal" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						{{-- Product omschrijving is veranderd naar productnaam --}}
						<h5 class="modal-title">{{$productdetail[0]->Description}}</h5>
						<button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					{{-- Aanpassing van code zodat de id per element verschillend is en dat de form nu klopt en de aantal meestuurd naar de winkelwagen pagina. --}}
					<form method="Get" action="/producten/addItem/{{$productdetail[0]->Product_id}}">
						@csrf
						<div class="modal-body">
							<img alt="{{$productdetail[0]->Description}}" src="{{$productdetail[0]->ProductImage}}" onerror=this.src="{{url('/img/img-placeholder.png')}}" class="producttypeimg" width="150"/>
							<div class="form-group">
								<label for="InputAantal-{{$productdetail[0]->Product_id}}-onlangstoegevoegd">Aantal</label>
								<input name="Aantal" type="text" class="form-control form-amount-{{$productdetail[0]->Product_id}}" id="InputAantal-{{$productdetail[0]->Product_id}}-onlangstoegevoegd" aria-describedby="emailHelp" max="{{$productdetail[0]->Aantal}}">
								<small id="emailHelp" class="form-text text-muted">Vul hier het gewenste aantal producten in.</small>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary btn-close" data-dismiss="modal">Close</button>
								{{-- <a href="/producten/addItem/{{$productsOT->id}}/" id="{{$productsOT->id}}" class="btn-primary btn-add btn-add-{{$productsOT->id}}">Toevoegen</a> --}}
								<button type="submit" id="{{$productdetail[0]->Product_id}}-Toevoegen" class="btn-primary btn-add btn-add-{{$productdetail[0]->Product_id}}">Toevoegen</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="col prodedit">

			<a aria-label="Pagina terug" href="/producten"><i class="fas fa-arrow-circle-left editdeleteicons "></i></a>
			{{-- Hier wordt de rol van de gebruiker gecontroleerd --}}
			{{-- Alleen de managers en de admin mogen de "edit" en/of "verwijder" knopjes zien --}}
			@if ($currentuser !== "User")
			<a aria-label="Product wijzigen" href="/producten/{{ $productdetail[0]->Product_id }}/edit"><i class="fas fa-wrench editdeleteicons "></i></a>
			<i aria-label="Product verwijderen" class="tablinks far fa-trash-alt editdeleteicons proddel" onclick="openCity(event, 'proddel')"></i>
			@endif
			<i class="tablinks fas fa-info editdeleteicons" onclick="openCity(event, 'prodinfo')" id="defaultOpen" style="display: none;"></i>
		</div>
	</div>
	<hr id="userdetailline">
	<div class="usrinfo tabcontent" id="prodinfo">
		<div class="row">
			<div class="col-6 detailimg">
				<a href="#" id="pop" data-toggle='modal' data-target='#imagemodal'>
				<img aria-label="Product foto" src="{{ $productdetail[0]->ProductImage }}" data-target='#imagemodal' id="imageresource" class="productImg img-fluid myImg" onerror=this.src="{{ url('/img/img-placeholder.png') }}" width="330px" height="250px"/>
				</a>                    
			</div>
			<!-- Modal -->
			<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content detailmodal">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">{{ $productdetail[0]->Description }}</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body detailmodal">
							<img aria-label="Prodcut foto" src="{{ $productdetail[0]->ProductImage }}"  class=" img-fluid modalimage" onerror=this.src="{{ url('/img/img-placeholder.png') }}">
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
			{{-- De code hier onder zorgt er voor dat de data niet meer versprint door gebruikt te maken van een tabel en verder er wordt een error message geladen als er
			product informatie ontbreekt. --}}
			<div class="userdetailverticalline"></div>
			<div class="col prodinformatie">
				<table class="table table-borderless">
					<br>
					<tbody>
						<tr>
							<th>Productcode:</th>
							<td>{{(empty($productdetail[0]->Productcode))? "Gegevens Ontbreken" : $productdetail[0]->Productcode }}</td>
						</tr>
						<tr>
							<th>Ingangsdatum:</th>
							{{-- 
							<td>{{ (empty($productdetail[0]->ingangsdatum)) ? $productdetail[0]->createdas : $productdetail[0]->ingangsdatum }}</td>
							--}}
							<td>{{(empty($productdetail[0]->created_at))? "Gegevens Ontbreken" : $productdetail[0]->created_at }}</td>
						</tr>
						<tr>
							<th>GTIN:</th>
							<td>{{ (empty($productdetail[0]->GTIN)) ? 'Gegevens Ontbreken' : $productdetail[0]->GTIN }}</td>
						</tr>
						<tr>
							<th>Fabrikaat:</th>
							<td>{{(empty($productdetail[0]->ManufacturerName))? "Gegevens Ontbreken" : $productdetail[0]->ManufacturerName }}</td>
						</tr>
						<tr>
							<th>Serie:</th>
							<td>{{(empty($productdetail[0]->Model))? "Gegevens Ontbreken" : $productdetail[0]->Model }}</td>
						</tr>
						<tr>
							<th>Type:</th>
							<td>{{(empty($productdetail[0]->Version))? "Gegevens Ontbreken" : $productdetail[0]->Version }}</td>
						</tr>
						{{-- 1/2 --}}
						<tr>
							<th>Locatie:</th>
							<td>{{(empty($productdetail[0]->Locatie))? "Gegevens Ontbreken" : $productdetail[0]->Locatie }}</td>
						</tr>
						<tr>
							<th>Product gewicht:</th>
							<td>{{(empty($productdetail[0]->WeightQuantity))? "Gegevens Ontbreken" : $productdetail[0]->WeightQuantity }}&nbsp;{{(empty($productdetail[0]->WeightMeasureUnitDescription))? "Gegevens Ontbreken" : $productdetail[0]->WeightMeasureUnitDescription }}</td>
						</tr>
						<tr>
							<th>Aantal:</th>
							<td>
							@if($productdetail[0]->Aantal == 0)
								{{$productdetail[0]->Aantal}}
							 @elseif(empty($productdetail[0]->Aantal))
							 	{{"Gegevens Ontbreken"}}
							 @else
							 {{$productdetail[0]->Aantal}}
							 @endif
							 </td>
						</tr>
						<tr>
							<th>Voornaam:</th>
							<td>{{(empty($userinformation[0]->voornaam))? "Gegevens Ontbreken" : $userinformation[0]->voornaam }}</td>
						</tr>
						<tr>
							<th>Achternaam:</th>
							<td>{{(empty($userinformation[0]->achternaam))? "Gegevens Ontbreken" : $userinformation[0]->achternaam }}</td>
						</tr>
						<tr>
							<th>Email:</th>
							<td>{{(empty($userinformation[0]->email))? "Gegevens Ontbreken" : $userinformation[0]->email }}</td>
						</tr>
					</tbody>
				</table>
				
			</div>
			{{-- Oude Code --}}
			{{-- 
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
		--}}
	</div>
</div>
</div>
<!-- Modal -->
{{-- Variablen zijn aangepast hieronder vooral id => Product_id --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">{{ $productdetail[0]->LongDescription }} specificaties</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				{{-- {{ $productdetail[0]->specs }} --}}
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
				<form action="/producten/productdetail/destroy/{{ $productdetail[0]->Product_id}}" method="POST" class="delform" id="DelForm">
					@method('DELETE')
					@csrf
					<button aria-label="Product verwijderen" type="submit" class="btn btn-success">Verwijder</button>
				</form>
			</div>
			<div class="col" id="delannuleer">
				<a href="/producten/productdetail/{{$productdetail[0]->Product_id}}"><button aria-label="Annuleer" type="submit" class="btn btn-danger">Annuleer</button></a>
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
			<h2 class="Producttitle">{{ $productdetail->LongDescription }}</h2>
		</div>
		<div class="col prodedit">
			<a href="/producten"><i class="fas fa-arrow-circle-left editdeleteicons "></i></a>
			<a href="/producten/{{ $productdetail->Product_id }}/edit"><i class="fas fa-wrench editdeleteicons "></i></a>
			<i class="tablinks far fa-trash-alt editdeleteicons proddel" onclick="openCity(event, 'proddel')"></i>
			<i class="tablinks fas fa-info editdeleteicons" onclick="openCity(event, 'prodinfo')" id="defaultOpen" style="display: none;"></i>
		</div>
	</div>
	<hr id="userdetailline">
	<div class="row">
		<div class="col-6">
			<a href="#" id="pop">
			<img src="{{ $productdetail->ProductImage }}" id="imageresource" class="productImg img-fluid myImg" onerror=this.src="{{ url('/img/img-placeholder.png') }}" width="330px" height="250px"/>
			</a>
		</div>
		<!-- Modal -->
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog " role="document">
				<div class="modal-content detailmodal">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">{{ $productdetail[0]->LongDescription }} specificaties</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						{{-- {{ $productdetail[0]->specs }} --}}
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
			{{ $productdetail->Productcode}} <br><br>
			{{ $productdetail->Created_at }} <br><br>
			{{ $productdetail->GTIN }}  <br><br>
			{{ $productdetail->ManufacturerName }} <br><br>
			{{ $productdetail->productserie_id }} <br><br>
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
				<form action="/producten/productdetail/destroy/{{ $productdetail[0]->Product_id}}" method="POST" class="delform" id="DelForm">
					@method('DELETE')
					@csrf
					<button type="submit" class="btn btn-success">Verwijder</button>
				</form>
			</div>
			<div class="col" id="delannuleer">
				<a href="/producten"><button type="submit" class="btn btn-danger">Annuleer</button></a>
			</div>
			<div class="col"></div>
		</div>
	</div>
</div>
</div>
@endif
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
@section('tabJS')
<script src="{{ asset('js/tab.js') }}"></script> 
@endsection
