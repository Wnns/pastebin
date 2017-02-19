@extends('master')


@section('content')
	{{ $pasteContent }}
	<hr>
	<b>Created by:</b> {{ $pasteAuthor }} <b>on</b> {{ \Carbon\Carbon::parse($pasteCreatedDate)->format('d-m-Y') }}<br>
	<i>Expires: {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $pasteExpiryDate)->diffForHumans() }}</i>
@stop