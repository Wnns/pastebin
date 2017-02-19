@extends('master')

@section('content')

@foreach($errors->all() as $error)
	<div class="alert alert-danger">
	{{$error}}
	</div>
@endforeach

<div class="">

	<form action="addPaste" method="post">
		
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<textarea class="form-control paste-textarea" name="pasteContent">{{ old('pasteContent')}}</textarea><br><br>
		<div class="form-inline">

			<label for="pasteAuthor">Author</label>
			<input type="text" name="pasteAuthor" class="form-control" value="{{ old('pasteAuthor', 'Anonymous') }}">
		</div><br>
		<div class="form-inline">

			<label for="pasteExpiryDate">Paste Expiration:</label>
			<select class="form-control" name="pasteExpiryDate">
				
				<option>Never</option>
				<option>5 minutes</option>
				<option>30 minutes</option>
				<option>1 hour</option>
				<option>1 day</option>
				<option>1 week</option>
				<option>1 month</option>
			</select>
		</div><br>
		<input type="submit" class="btn btn-success" value="Create new paste">
	</form>
</div>
@stop