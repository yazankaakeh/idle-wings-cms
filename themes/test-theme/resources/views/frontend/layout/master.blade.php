

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Test Template</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('themes/test-theme/public/assets/css/bootstrap.min.css') }}" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    
    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{ asset('themes/test-theme/public/assets/css/blog.css') }}" rel="stylesheet">
  </head>
  <body>
    
    <div class="container">
        @include('theme/test-theme::frontend.layout.header')
    </div>

    @yield('content')

    {{-- Footer --}}
    @include('theme/test-theme::frontend.layout.footer')

    <script src="{{ asset('themes/test-theme/public/assets/js/bootstrap.bundle.min.js') }}"></script>
    </body>
</html>
