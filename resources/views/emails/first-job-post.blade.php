<!DOCTYPE html>

<html lang="en">

<head>
    <title></title>
</head>

<body>
    <h1>A new job posted!</h1>
    <h2>{{$post->title}}</h2>
    <p>{{$post->description}}</p>

    <a href="{{route('approve',['post_id'=>$post->id])}}">Approve Job Offer</a>  or <a href="{{route('spam',['post_id'=>$post->id])}}">Mark as spam</a>
</body>
</html>