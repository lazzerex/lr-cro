<?php

namespace App\View\Components;

use App\Models\Post;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FeaturedPosts extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $posts = Post::query()
            ->with('categories')
            ->latest('id')
            ->limit(5)
            ->get();
        return view('components.featured-posts', [
            'posts' => $posts,
        ]);
    }
}
