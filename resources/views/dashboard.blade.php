@extends('master')

@section('content')
	
	<h1>Hello {{ Auth::user()->name }}</h1>

	Total pastes: {{ sizeOf($userPastes) }}
	<br><br>

	@if(sizeOf($userPastes) > 0)

		<table class="table table-striped">
		
		<thead class="thead-inverse">

			<tr>

				<td class="col-md-5">Title</td>
				<td>Added</td>
				<td>Expires</td>
				<td>Syntax</td>
				<td>Views</td>
				<td>Private</td>
			</tr>
		</thead>
		<tbody>
		@foreach($userPastes as $paste)
			<tr>
				
				<td><a href="{{ URL::to('/p/' . $paste['string_id']) }}">{{ $paste['title'] }} </a></td>
				<td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $paste['created_at'])->diffForHumans() }} </td>
				<td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $paste['expiry_at'])->diffForHumans() }} </td>
				<td>{{ $paste['syntax'] }} </td>
				<td>{{ $paste['views'] }} </td>
				<td>{{ $paste['is_private'] = ($paste['is_private'] == '1' ? 'Yes' : 'No') }} </td>
			</tr>
		@endforeach
		</tbody>
	</table>
	@endif
@stop