<?php

namespace App\View\Components;

use App\Models\Category;
use App\Models\Post;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CategoryPostsBlock extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public ?string $slug = '',
        public ?int $categoryId = 0
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        if ($this->categoryId <= 0 && blank($this->slug)) return '';

        $posts = collect([]);
        $categoryId = $this->categoryId;

        $categoryQuery = Category::query();

        if ($categoryId > 0) {
            $categoryQuery->where('id', $categoryId);
        } else {
            $categoryQuery->where('slug', $this->slug);
        }

        $category = $categoryQuery->first();

        if (! $category) return '';

        $posts = $category->posts()->latest('id')->limit(6)->get();

        return view('components.category-posts-block', [
            'posts' => $posts,
            'category' => $category,
        ]);
    }
}
