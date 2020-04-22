<div style="width:650px;  padding : 10px; border-radius: 6px;">
	<div style="display: flex; justify-content: space-between; align-items: center;">
		<div>
			{{-- <p>Auth: {{ $demo->auth }}</p> --}}
			<p>Beste {{ $demo->receiver }},</p>
			<p>{{ $demo->message }}</p>
		</div>
		<div>
			<img src="https://scontent-amt2-1.xx.fbcdn.net/v/t1.0-9/15542453_1351765381521627_7777454073274214397_n.png?_nc_cat=111&_nc_ht=scontent-amt2-1.xx&oh=45bb5c4fef859b3f705e5b66a9124262&oe=5D540DC5" width="100">
		</div>
	</div>
	<p><b>Naam:</b>&nbsp;{{ $demo->demo_one }}</p>
	<p><b>Email:</b>&nbsp;{{ $demo->demo_two }}</p>
<p>Bestelling:</p>
<table width="600" style=" display: flex; justify-content: space-around; align-items: center; margin : 0 auto">
	<tr style="width : 600px; display: flex; justify-content: space-around; align-items: center; ">
		<td style="text-align:center;width: 150px;height : 40px; color:white;background:#f28e0b; line-height: 40px;">
			<strong>#</strong>
		</td>
		<td style="text-align:center;width: 150px;height : 40px; color:white;background:#f28e0b; line-height: 40px;">
			<strong>Afbeelding</strong>
		</td>
		<td style="text-align:center;width: 150px;height : 40px; color:white;background:#f28e0b; line-height: 40px;">
			<strong>Naam</strong>
		</td>
		<td style="text-align:center;width: 150px;height : 40px; color:white;background:#f28e0b; line-height: 40px;">
			<strong>Aantal</strong>
		</td>
	</tr>
	@php $count = 0; @endphp
	@foreach($demo->image_array as $product)
	<tr style="width : 600px; display: flex; justify-content: space-around; align-items: center;  border-bottom : 1px solid #dee2e6 !important;">
		@php $count++; @endphp
		<td style=" width : 150px; text-align: center;">
			@php echo $count; @endphp
		</td>
		<td style=" width : 150px; text-align: center;">
			<img src="{{asset($demo->image_array[$count - 1])}}" width="100" height="100">
		</td>
		<td style=" width : 150px; text-align: center;">
			{{ $demo->name_array[$count - 1] }}
		</td>
		<td style=" width : 150px; text-align: center;">
			{{ $demo->amount_array[$count - 1] }}
		</td>
	</tr>
	@endforeach
</table>
<br>
<div style="display: flex;justify-content: space-between;width: 520px;">
	<div>
		<img alt="WiZ Kuijpers Logo" src="{{ asset('img/icons/icon-512x512.png') }}" class="nav-home" height="90">
	</div>
	<div style="margin-top: 54px;">
		<i>Dit is een automatisch bericht van WiZ, antwoord alsjeblieft niet.</i>
		<br>
		<i>This is an automated message by WiZ, please do not reply.</i>	
	</div>
</div>
</div>


