<html>
<head>
    <title>{{ config('blog.title') }}</title>
    <meta name="description" content="{!! htmlspecialchars_decode(nl2br(e($post->meta_description))) !!}">
    <meta name="keywords" content="{{$post->meta_keywords}}">
    <meta name="title" content="{{$post->meta_title}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>{{ $post->title }}</h1>
        <h5>{{ $post->published_at->format('M jS Y g:ia') }}</h5>
        <hr>
        <h4>Category : {{$post->category}}</h4>
        <h4>Tags : 
        @foreach($post->tags as $tags)
         <span class="label label-default">{{$tags->name}}</span>
        @endforeach  
        </h4>
        {!! htmlspecialchars_decode(nl2br(e($post->content))) !!}
        <hr>
        <button class="btn btn-primary" onclick="history.go(-1)">back</button>
    </div>
</body>
</html>