Last pastes
<hr>
@if($lastPastes)
	@foreach($lastPastes as $paste)
		
		<a href="{{ URL::to('/p/' . $paste['string_id']) }}">{{ $paste['title'] }}</a><br>
		{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $paste['created_at'])->diffForHumans() }}<br>
		<hr>
	@endforeach
@endif