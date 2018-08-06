@extends('reworkedlayout.layout')

@section('content')


<form action="{{ route('upload.json') }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    JSON:
    <br />
    <input type="file" name="json" />
    <br /><br />
    <input type="submit" value=" Save " />
</form>
@endsection