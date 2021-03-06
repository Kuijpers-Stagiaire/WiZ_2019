@if ($message = Session::get('success'))
<div class="alert alert-success alert-block" style="margin-top:10px !important;width:900px;margin:0 auto;">
	<button type="button" class="close" data-dismiss="alert">×</button>	
        <strong>{{ $message }}</strong>
</div>
@endif


@if ($message = Session::get('error'))
<div class="alert alert-danger alert-block" style="margin-top:10px !important;width:900px;margin:0 auto;">
	<button type="button" class="close" data-dismiss="alert">×</button>	
        <strong>{{ $message }}</strong>
</div>
@endif


@if ($message = Session::get('warning'))
<div class="alert alert-warning alert-block" style="margin-top:10px !important;width:900px;margin:0 auto;">
	<button type="button" class="close" data-dismiss="alert">×</button>	
	<strong>{{ $message }}</strong>
</div>
@endif


@if ($message = Session::get('info'))
<div class="alert alert-info alert-block" style="margin-top:10px !important;width:900px;margin:0 auto;">
	<button type="button" class="close" data-dismiss="alert">×</button>	
	<strong>{{ $message }}</strong>
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger" style="margin-top:10px !important;width:900px;margin:0 auto;">
  <button type="button" class="close" data-dismiss="alert">×</button>	
    <ul>
        @foreach ($errors->all() as $error)
            {{-- nieuwe melding tekst --}}
            {{-- <div class="Err">{{ $error }}</div> --}}
            <div class="Err">Foutieve waarden ingevuld</div>
        @endforeach
    </ul>
</div>
@endif