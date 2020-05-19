@extends('layouts.errorLayout')

@section('code', '404')
@section('title', __('Page Not Found'))
@section('homebutton')
<a href="{{ url('/home') }}">
    <button class="bg-transparent text-kuijpers-blue font-bold uppercase tracking-wide py-3 px-6 border-2 border-grey-light hover:border-grey rounded-lg">
        {{ __('Go Home') }}
    </button>
</a>
@endsection  
@section('message', __('Sorry, de pagina is niet gevonden.'))
<script
src="http://code.jquery.com/jquery-3.3.1.js"
integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        setTimeout(function() {
         window.location.href = "/home"
        }, 5000);
      });
</script>