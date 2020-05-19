@extends('layouts.errorLayout')

@section('code', '401')
@section('title', __('Unauthorized'))

{{-- @section('image')
<div style="background-image: url({{ asset('/svg/403.svg') }});" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
</div>
@endsection --}}

@section('homebutton')
<a href="{{ url('/') }}">
    <button class="bg-transparent text-kuijpers-blue font-bold uppercase tracking-wide py-3 px-6 border-2 border-grey-light hover:border-grey rounded-lg">
        {{ __('Log in') }}
    </button>
</a>
@endsection  

@section('message', __('Sorry, u bent niet geautoriseerd om deze pagina te bezoeken.'))
<script
src="http://code.jquery.com/jquery-3.3.1.js"
integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        setTimeout(function() {
         window.location.href = "/"
        }, 5000);
      });
</script>