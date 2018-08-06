@extends('reworkedlayout.layout')

@section('content')
    <h2>Write a Post!</h2>
    <form method="POST" action="{{ url('/posts') }}">

        {{ csrf_field() }}

        <div class="form-group">
            <label for="title">Title:</label>
            <input type="title" class="form-control" id="title" placeholder="Title" name="title" required>
        </div>
        <div class="form-control">
            <label for="body">Text</label>
            <input type="body" class="form-control" id="body" placeholder="What is your post about?" name="body" required>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Send to Review</button>
            </div>
        </div>
        <!--
        <div class="checkbox">
            <label>
                <input type="checkbox"> Check me out
            </label>
        </div>
        -->


        @include('partials.errors')

    </form>



@endsection