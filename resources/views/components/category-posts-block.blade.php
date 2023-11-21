@if ($posts->count() > 0)
@php
$firstPost = $posts->shift();
@endphp
<div {{ $attributes->merge(['class' => 'category-posts']) }}>
    <div class="w-full py-3">
        <h2 class="text-gray-800 text-2xl font-bold">
            <span class="inline-block h-5 border-l-4 border-red-600 mr-2"></span>{{ $category->name }}
        </h2>
    </div>
    <div class="grid lg:grid-cols-2 gap-2">
        <!-- first post -->
        <div
            class="flex-shrink max-w-full w-full px-3 pb-3 pt-3 sm:pt-0 border-b-2 sm:border-b-0 border-dotted border-gray-100">
            <div class="flex flex-row sm:block hover-img">
                <a href="{{ route('post', $firstPost->slug) }}">
                    <img class="max-w-full w-full mx-auto" src="{{ $firstPost->image }}"
                        alt="{{ $firstPost->title }}">
                </a>
                <div class="py-0 sm:py-3 pl-3 sm:pl-0">
                    <h3 class="text-xl font-bold mb-2">
                        <a href="{{ route('post', $firstPost->slug) }}">{{ $firstPost->title }}</a>
                    </h3>
                    <span class="text-gray-500 text-sm flex items-center mb-2" href="#"><x-heroicon-o-calendar-days class="w-4 inline-block mr-1" /> {{ $firstPost->published_at->formatDateDMY() }}</span>
                    <p class="hidden md:block text-gray-600">{{ $firstPost->excerpt }}</p>

                </div>
            </div>
        </div>
        <!-- posts list -->
        <div class="flex flex-col gap-3">
            @foreach($posts as $post)
            <div class="grid grid-cols-4 gap-2">
                <a href="{{ route('post', $post->slug) }}" class="block">
                    <img class="max-w-full w-full mx-auto aspect-square" src="{{ $post->image }}"
                        alt="{{ $post->title }}">
                </a>
                <div class="col-span-3">
                    <h3 class="font-bold mb-2">
                        <a href="{{ route('post', $post->slug) }}">{{ $post->title }}</a>
                    </h3>
                    <span class="text-gray-500 text-sm flex items-center" href="#"><x-heroicon-o-calendar-days class="w-4 inline-block mr-1" /> {{ $post->published_at->formatDateDMY() }}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif