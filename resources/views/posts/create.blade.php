@extends('layouts.app')

@section('content')



    <h1>Submit Job Offer</h1>
    <hr>
    <form method="POST" action="/posts">

        {{ csrf_field() }}

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        
        <div class="form-group">
            <label for="body">Job description</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input name="email" type="email" class="form-control" id="exampleInputEmail1" required>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>

        @include('layouts.errors')

    </form>

@endsection



