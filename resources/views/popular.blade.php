@extends('master')

@section('content')
	<h1>Popular pastes</h1><br>
	@if($popularPastes)
	<table class="table table-striped">
		
		<thead class="thead-inverse">

			<tr>

				<td class="col-md-8">Title</td>
				<td>Added</td>
				<td>Views</td>
				<td>Author</td>
			</tr>
		</thead>
		<tbody>
		@foreach($popularPastes as $pasteData)
			<tr>
				
				<td><a href="{{ URL::to('/p/' . $pasteData['string_id']) }}">{{ $pasteData['title'] }} </a></td>
				<td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $pasteData['created_at'])->diffForHumans() }} </td>
				<td>{{ $pasteData['views'] }} </td>
				<td>{{ $pasteData['name'] = (empty($pasteData['name']) ? 'Anonymous' : $pasteData['name']) }} </td>
			</tr>
		@endforeach
		</tbody>
	</table>
	@else
	No pastes yet.
	@endif
@stop