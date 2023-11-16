@extends('theme/test-theme::frontend.layout.master')

@section('content')
    <main class="container">
        <div class="p-4 p-md-5 mb-4 text-white rounded bg-dark">
            <div class="col-md-6 px-0">
                <h1 class="display-4 fst-italic">{{ $featured_post->name }}</h1>
                <p class="lead my-3">{{ $featured_post->short_description }}</p>
                <p class="lead mb-0"><a href="{{ route('blog.details', $featured_post->permalink) }}"
                        class="text-white fw-bold">Continue reading...</a></p>
            </div>
        </div>

        <div class="row mb-2">
            @foreach ($most_comment_post as $post)
                <div class="col-md-6">
                    <div
                        class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                        <div class="col p-4 d-flex flex-column position-static">
                            <strong class="d-inline-block mb-2 text-primary">World</strong>
                            <h3 class="mb-0">{{ $post->name }}</h3>
                            <div class="mb-1 text-muted">{{ $post->publish_at }}</div>
                            <p class="card-text mb-auto">{{ $post->short_description }}</p>
                            <a href="{{ route('blog.details', $post->permalink) }}" class="stretched-link">Continue reading</a>
                        </div>
                        <div class="col-auto d-none d-lg-block">
                            <img src="{{ asset(getFilePath($post->image)) }}" alt="" class="bd-placeholder-img" width="200" height="250" style="object-fit: cover;">
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row g-5">
            <div class="col-md-12">
                <h3 class="pb-4 mb-4 fst-italic border-bottom">
                    Popular Posts
                </h3>

                @foreach ($popular_post as $post)
                    <div class="blog-post">
                        <a href="{{ route('blog.details', $post->permalink) }}"><h3 class="blog-post-title text-dark text-transform-none">{{ $post->name }}</h2></a>
                        <p class="blog-post-meta">{{ $post->publish_at }} by <a href="#">{{ $post->user->name }}</a></p>
                        <p>{{ $post->short_description }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </main>
@endsection
