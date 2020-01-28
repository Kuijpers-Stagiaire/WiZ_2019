@if(session('status'))
    {{ session('status') }}
@endif
@extends('layouts.layout')
<meta name="viewport" content="width=device-width, initial-scale=1.0">
@section('pageSpecificCSS')
<link rel="stylesheet" type="text/css" href="{{ asset('css/shop.css') }}" />
@endsection
@section('titlePage')
    <title>WiZ Kuijpers - Overzicht</title>
@endsection
@section('shopmenu')
<?php 
// Haal de token op uit de sessie, om deze te gebruiken bij het ophalen van producten.
echo '<div class="hidden-token" hidden>' . Session::get('token') . '</div>';
?>

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
    </div>
  </div>
<!-- Modal -->
  <div id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <!-- <div class="modal-dialog modal-lg" role="document" style="height : 490px;margin-top:150px;"> -->
    <div class="modal-header custom-modal-header">
      <!-- <div class="modal-title-tab-1">Barcode</div> -->
      <!-- <a class="modal-title-tab-2" href="http://127.0.0.1:8000/overzicht/nieuw">Handmatig</a> -->
      <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button> -->

    </div>
    <div class="modal-body">
      <div class="hr"></div>
      <div class="alert alert-danger alert-scan" role="alert" style="font-size:16px !important; display: none !important; display: flex; align-items: center;justify-content: flex-start !important;">Fout! Uw barcode is incorrect.
      </div>
      <div class="custom-modal-body">
        <form method="post" action="/overzicht/nieuw_scanned" enctype="multipart/form-data" class="custom-modal-body" id="form-barcode"> 
          @method('POST')
          @csrf
          <div class="custom-modal-body-child-1">
            <!-- Tijdelijke placeholder afbeelding, zodra er een product gescand is, wordt deze afbeelding veranderdt naar de afbeelding van het product. -->
            <img src="https://oie.msu.edu/_assets/images/placeholder/placeholder-200x200.jpg" onerror=this.src="{{ url('/img/img-placeholder.png') }}" class="custom-modal-img" width="200" height="200">
          </div>
          <br/>
          <div class="custom-modal-body-child-2">
          <!-- Tabel waar alle productinformatie te zien gaat worden. -->
            <table class="table table-striped table-bordered table-hover table-responsive custom-table">
              <tbody>
                <thead>
                  <tr>
                    <td style="width:18%;">Barcode 2BA:</td>
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
              <!-- <button type="button" class="btn btn-secondary push" data-dismiss="modal">Sluiten</button> -->
              <button type="submit" class="btn btn-primary custom-modal-opslaan" form="form-barcode">Product toevoegen</button>
          </div>
          </div>
        <!-- </div> -->
      <!-- </div> -->
    </div>

                      

@endsection
@section('content')

{{-- <div class="container-fluid bekijkook">
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
  crossorigin="anonymous">
</script>


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

                  // laat de waarden van 2ba zien op de site.
                  $(".custom-modal-id").val(result.Id);
                  $(".custom-modal-merk").val(result.ManufacturerName);
                  $(".custom-modal-productnaam").val(result.ProductClassDescription);
                  $(".custom-modal-productomschrijving").val(result.LongDescription);
                  $(".custom-modal-productcode").val(result.Productcode);
                  $(".custom-modal-gln").val(result.ManufacturerGLN);
                  $(".custom-modal-gtin").val(result.GTIN);
                  $(".custom-modal-serie").val(result.Model);
                  $(".custom-modal-type").val(result.Version);

                  // laat het merk zien als een hyperlink om naar website fabrikant te gaan
                  $(".custom-modal-deeplink").val(result.ManufacturerName);
                  $(".custom-modal-deeplink2").attr("href", result.Deeplink);
                  // link afbeelding van 2ba
                  $(".custom-modal-img").attr("src", "https://api.2ba.nl/1/json/Thumbnail/Product?gln="+ result.ManufacturerGLN +"&productcode="+ result.Productcode +"");

                  // waardens niet worden laten zien op site wel in de database opgeslagen.
                  $(".hidden-gewicht-eenheid").val(result.WeightMeasureUnitDescription);
                  $(".hidden-gewicht").val(result.WeightQuantity);
                  $(".hidden-productnaam-volledig").val(result.Description);
                  $(".hidden-producttype").val(result.ProductClassDescription);
                  
                  //link afbeelding, link wordt niet laten zien
                  $(".hidden-image").val("https://api.2ba.nl/1/json/Thumbnail/Product?gln="+ result.ManufacturerGLN +"&productcode="+ result.Productcode +"");
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