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
@section('message', __('Sorry, the page you are looking for could not be found.'))