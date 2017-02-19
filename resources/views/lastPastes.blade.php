Last pastes
<hr>

@foreach($lastPastes as $paste)
	
	<a href="/pastebin/p/{{ $paste['pasteStringID'] }}">{{ $paste['pasteStringID'] }}</a><br>
	{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $paste['pasteCreatedDate'])->diffForHumans() }}
	<hr>
@endforeach