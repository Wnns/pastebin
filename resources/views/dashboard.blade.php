@extends('master')

@section('content')
	
	<h1>Hello {{ Auth::user()->name }}</h1>

	@if(sizeOf($userPastes) == 0)

		You don't have any pastes yet. <a href="{{ URL::to('/') }}">Create one!</a>
		<br><br>

	@else

		Pastes: {{ sizeOf($userPastes) }}
		<br><br>
		<table class="table table-striped">
		
		<thead class="thead-inverse">

			<tr>

				<td class="col-md-3">Title</td>
				<td>Added</td>
				<td>Expires</td>
				<td>Syntax</td>
				<td>Views</td>
				<td>Private</td>
				<td class="text-center">Remove</td>
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
				<td class="text-center"><a href="{{ URL::to('/p/' . $paste['string_id']) . '/remove'}}" onclick="return confirm('Are you sure?');"><span class="glyphicon glyphicon-remove
"></span></a></td>
			</tr>
		@endforeach
		</tbody>
	</table>
	@endif
@stop