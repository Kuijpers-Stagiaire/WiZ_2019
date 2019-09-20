@extends('layouts.errorLayout')

@section('code', '419')
@section('title', __('Page Expired'))

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

@section('message', __('Sorry, your session has expired. Please refresh and try again.'))
