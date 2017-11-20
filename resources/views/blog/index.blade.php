<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>{{ config('blog.title') }}</title>
    <!-- Bootstrap core CSS -->
    {{ Html::style('css/bootstrap.min.css') }}
    <!-- Custom styles for this template -->
    {{ Html::style('css/blog-home.css') }}
  </head>
  <body>
    <!-- Page Content -->
    <div class="container">
        <h2>{{ config('blog.title') }}</h2>
        <h5>Page {{ $posts->currentPage() }} of {{ $posts->lastPage() }}</h5>
        <hr>
      <div class="row">
        <!-- Blog Entries Column -->
        <div class="col-md-8">
        @foreach($posts as $post)
          <!-- Blog Post -->
          <div class="card mb-4">
            <div class="card-body">
              <h2 class="card-title"><a href="/blog/{{ $post->slug }}">{{ $post->title }}</a></h2>
              <p class="card-text">
                <p>
                {!! str_limit(htmlspecialchars_decode(nl2br(e($post->content)))) !!}
                </p>
              </p>
              <a href="/blog/{{ $post->slug }}" class="btn btn-primary">Read More &rarr;</a>
            </div>
            <div class="card-footer text-muted">
              Posted on {{ $post->published_at->format('M jS Y g:ia') }}

            </div>
          </div>
        @endforeach
       <!-- Pagination -->
          <ul class="pagination justify-content-center mb-4">
            {!! $posts->render() !!}
          </ul>

        </div>
      </div>
    </div>
    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Your Website 2017</p>
      </div>
      <!-- /.container -->
    </footer>
    {{ Html::script('js/jquery-2.2.1.min.js') }}
    {{ Html::script('js/bootstrap.bundle.min.js') }}
  </body>
</html>
