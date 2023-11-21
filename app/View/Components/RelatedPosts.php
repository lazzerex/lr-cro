<?php

namespace App\View\Components;

use App\Models\Post;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RelatedPosts extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public Post $post)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        if ($this->post->categories->count() === 0) return '';

        $categoryIds = $this->post->categories->pluck('id')->all();

        $relatedPosts = Post::query()
            ->whereRelation('categories', fn($q) => $q->whereIn('id', $categoryIds))
            ->limit(3)
            ->get();
        return view('components.related-posts', [
            'posts' => $relatedPosts
        ]);
    }
}
