<html>
<head>
    <title>{{ config('blog.title') }}</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>{{ $post->title }}</h1>
        <h5>{{ $post->published_at->format('M jS Y g:ia') }}</h5>
        <hr>
        {!! nl2br(e($post->content)) !!}
        <hr>
        <button class="btn btn-primary" onclick="history.go(-1)">back</button>
    </div>
</body>
</html>