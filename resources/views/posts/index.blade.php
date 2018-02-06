@extends('layouts.app')

@section('content')
    <div class="row">
        @guest
            <a href="/login">Login</a> or <a href="/register">register</a> to submit job offer
        @else
            <a href="/posts/create" class="btn btn-primary">Submit job offer</a>
        @endguest
    </div>

    <div>
        @foreach($posts as $post)
            @include('posts.post')
        @endforeach
    </div>

@endsection