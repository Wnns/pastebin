@extends('master')

@section('content')

@foreach($errors->all() as $error)

    <div class="alert alert-danger">
        
        {{$error}}
    </div>
@endforeach
    
    <h1>Create new paste</h1><br><br>
    <form action="addPaste" method="post">
        
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <textarea class="form-control paste-textarea" name="pasteContent">{{ old('pasteContent')}}</textarea><br><br>
        <div class="form-inline">

            <label for="pasteTitle">Title</label>
            <input type="text" name="pasteTitle" class="form-control" value="{{ old('pasteTitle', '') }}">
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
        <div class="form-inline">

            <label for="pasteSyntaxHighlighting">Syntax highlighting:</label>
            <select class="form-control" name="pasteSyntaxHighlighting">
                
                <option>None</option>
                <option>C#</option>
                <option>C++</option>
                <option>CSS</option>
                <option>HTML</option>
                <option>JSON</option>
                <option>Java</option>
                <option>JavaScript</option>
                <option>PHP</option>
                <option>Python</option>
                <option>Ruby</option>
                <option>SQL</option>
            </select>
        </div><br>
        <input type="checkbox" name="pasteIsPrivate" />
        <abbr title="Paste will not be showed in Last pastes section">Private</abbr>
        <br><br>
        <input type="submit" class="btn btn-success" value="Create new paste">
        <br><br><br>
    </form>
@stop