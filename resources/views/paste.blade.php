@extends('master')

@section('head')

	<link rel="stylesheet" href="{{ URL::asset('public/css/highlightjs/github-gist.css') }}">
	<script src="{{ URL::asset('public/js/highlight.pack.js') }}"></script>
	<script>hljs.initHighlightingOnLoad();</script>
@stop

@section('content')

	<pre><code class="{{ ($syntax == 'None' ? 'nohighlight' : $syntax ) }}">{{ $content }}</code></pre>
	<hr>
	{{ $title }}<br><br>
	<b>Created by:</b> {{ $name = (empty($name) ? 'Anonymous' : $name) }} <b>on</b> {{ \Carbon\Carbon::parse($created_at)->format('d-m-Y') }}<br>
	<small><i>Expires: {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $expiry_at)->diffForHumans() }}</i><br>
	Syntax: {{ $syntax }}<br>
	Views: {{ $views }}</small><br>
	<a href="{{ URL::to('/p/' . $string_id) . '/raw'}}"><button type="button" class="btn btn-primary btn-xs">View raw</button></a>
	
@stop