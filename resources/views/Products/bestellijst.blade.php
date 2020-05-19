@extends('layouts.layout')
@section('pageSpecificCSS')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/homegraphs.css') }}" />
@endsection
@section('titlePage')
    <title>WiZ Kuijpers - Bestellijst</title>
@endsection
@section('shopmenu')
    {{-- <div class="container-fluid">
        <div class="row " id="Searchnavbar"> 
            <div class="col order1 shop-bar">
                <form class="Sbar" action="/producten/products/search" method="POST" role="search">
                    {{ csrf_field() }}
                    <input aria-label="Search product" type="text" placeholder="Search product" name="q">
                    <button aria-label="Search product" type="submit"><i class="fa fa-search"></i></button>
                </form>
                
                <select class="form-control category" aria-label="Select category" onchange="window.location=this.options[this.selectedIndex].value">
                    <option value="" disabled selected hidden>Categorieën</option>
                    @foreach ($categories as $category)
                    <option value="/producten/products/{{ $category->productserie_naam }}">{{ $category->productserie_naam }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="col order-12 shop-bar addcol">
                <div class="addprod">
                    <a aria-label="Product toevoegen" href="/producten/nieuw" aria-label="Nieuw product toevoegen">
                        <i class="far fa-plus-square"></i>
                    </a>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
@section('content')
<div class="container-bestelijst" style="height:auto !important">
    <div class="container table-wrapper-scroll-y my-custom-scrollbar table-responsive">
        <table class="table">
            <thead>
                <th>Bestelling #</th>
                <th>Afbeelding</th>
                <th>Productnaam</th>
                <th>Productcode</th>
                <th>Aantal</th>
                <th>Toegevoegd op</th>
                <th>Acties</th>
            </thead>
                @if (isset($getBasket))
                    @foreach($getBasket as $getBasketItem)
                        <tr>
                            <td><strong>{{$getBasketItem->bestelling_id}}</strong></td>
                            {{-- Deze code hieronder zorgt er voor dat er een standaard foto ingeladen wordt op moment van een error met de oorspronkelijke foto. --}}
                            <td><img src="{{$getBasketItem->product_img}}" height="50" onerror=this.src="{{ url('/img/img-placeholder.png') }}"></td>
                            {{-- <td><img src="{{$getBasketItem->product_img}}" height="50"></td> --}}

                            <td  class="default-{{$getBasketItem->bestelling_id}}">{{$getBasketItem->product_naam}}</td>
                            <td  class="default-{{$getBasketItem->bestelling_id}}">{{$getBasketItem->product_code}}</td>
                            <td  class="default-{{$getBasketItem->bestelling_id}}">{{$getBasketItem->product_aantal}}</td>
                            <td  class="default-{{$getBasketItem->bestelling_id}}">{{$getBasketItem->created_at}}</td>
                            <td  class="default-{{$getBasketItem->bestelling_id}}"><button type="button" class="btn btn-success btn-edit" id="{{$getBasketItem->bestelling_id}}">Bewerken</button></td>

                            <td  style="display : none;" class="edit-{{$getBasketItem->bestelling_id}}">{{$getBasketItem->product_naam}}</td>
                            <td  style="display : none;" class="edit-{{$getBasketItem->bestelling_id}}">{{$getBasketItem->product_code}}</td>
                            <td  style="display : none;" class="edit-{{$getBasketItem->bestelling_id}}"><input class="{{$getBasketItem->bestelling_id}}" value="{{$getBasketItem->product_aantal}}" type="number"></input></td>
                            <td  style="display : none;" class="edit-{{$getBasketItem->bestelling_id}}">{{$getBasketItem->created_at}}</td>
                            <td style="display : none;" class="edit-{{$getBasketItem->bestelling_id}}">
                                <a type="button" class="btn btn-success btn-save" id="{{$getBasketItem->bestelling_id}}" href="/producten/bestellijst/">Opslaan</a> 
                                <a type="button" class="btn btn-info btn-edit" id="{{$getBasketItem->bestelling_id}}">Annuleer</a>
                                <a type="button" class="btn btn-danger" href="/producten/bestellijst/destroy/{{$getBasketItem->bestelling_id}}/{{$getBasketItem->product_id}}/{{$getBasketItem->product_aantal}}">X</a>
                            </td>
                        </tr>
                    @endforeach             
                
                
            @endif
        </table>
    </div>
    @if (isset($getBasketItem))
        <div class="container mt-4 d-flex justify-content-center">
            <a href="/mail/send/{{$getBasketItem->product_toevoeger_id}}" type="button" class="btn btn-primary"><i class="fas fa-shopping-cart"></i>   Plaats bestelling</a>
        </div>
    @else
        <div class="noProducts" >Geen producten beschikbaar</div>
    @endif
</div>

    @endsection
<style>
    body, html{
        height: 20%;
    }
    .footer-distributed{
        margin-top: 0px;
    }
    .container-bestelijst{
        height: 100%;
    }

    input{
        width: 60px;
    }

    .my-custom-scrollbar {
        position: relative;
        max-height: 700px;
        overflow: auto;
    }
    .table-wrapper-scroll-y {
        display: block;
    }

    #edit{
        display : none !important;
    }

    .btn-save{
        color: #fff;
        background-color: #28a745;
        border-color: #28a745;
        border-radius: .25rem !important;
    }

    #app{
        margin-bottom: 10px !important;
    }

    .noProducts{
        text-align: center;
    }
</style>

<script
  src="https://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous">
</script>

<script>
    

    $(document).ready(function () {

                setTimeout(function() {
                $("#app").fadeOut("slow");
                }, 3000);
        $(".btn-edit").on("click", function(){
            item = $(this).attr("id");

            console.log(item);

            $('.edit-' + item).toggle();
            $('.default-' + item).toggle();

            console.log($(".edit-" + item).attr("class"));
        });

        $(".btn-save").on("click", function(){
            item = $(this).attr("id");
            aantal = $("." + item).val();

            href = $(this).attr("href");

            href_new = href + item + "/" + aantal;
        // alert(href_new);

            $(".btn-save").attr("href", href_new);

        });
    });

</script>