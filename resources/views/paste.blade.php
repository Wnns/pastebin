@extends('master')


@section('content')
	{{ $content }}
	<hr>
	{{ $title }}<br>
	<b>Created by:</b> {{ $author }} <b>on</b> {{ \Carbon\Carbon::parse($created_at)->format('d-m-Y') }}<br>
	<i>Expires: {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $expiry_at)->diffForHumans() }}</i><br>
	<small>Views: {{ $views }} </small>
@stop