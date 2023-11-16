@extends('theme/test-theme::frontend.layout.master')

@section('content')
    <main class="container">
        <div class="blog-post">
            <img src="{{ asset(getFilePath($blog->image)) }}" alt="" class="img-fluid">
            <h3 class="blog-post-title mt-4">{{ $blog->name }}</h2>
            <p class="blog-post-meta">{{ $blog->publish_at }} by <a href="#">{{ $blog->user->name }}</a></p>
            <p>{!! $blog->content !!}</p>
        </div>
    </main>
@endsection
