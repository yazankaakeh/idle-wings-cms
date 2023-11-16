<?php

namespace Theme\TestTheme\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Core\Models\TlBlog;

class FrontendController extends Controller
{
    public function index()
    {
        $popular_post = TlBlog::with('user:id,name')->orderBy('views', 'desc')
            ->select(['id', 'name', 'user_id' ,'permalink', 'publish_at', 'short_description'])
            ->take(4)
            ->get();

        $most_comment_post = TlBlog::select(['id', 'image', 'name', 'permalink', 'publish_at', 'short_description'])
            ->withCount('allblogComment')
            ->orderBy('allblog_comment_count', 'desc')
            ->take(2)
            ->get();

        $featured_post = TlBlog::where('is_featured', 1)
            ->select(['id', 'name', 'permalink', 'publish_at', 'short_description', 'image'])
            ->first();

        
        return view('theme/test-theme::frontend.pages.home', [
            'popular_post' => $popular_post, 
            'most_comment_post' => $most_comment_post, 
            'featured_post' => $featured_post
        ]);
    }

    public function details($permalink)
    {
        return view('theme/test-theme::frontend.pages.details', [
            'blog' => TlBlog::where('permalink', $permalink)->first()
        ]);
    }
}
