@php
    $firstPost = $posts->shift();
@endphp

<div {{ $attributes->merge(['class' => 'latest-posts']) }}>
    <div class="w-full py-3">
        <h2 class="text-gray-800 text-2xl font-bold">
            <span class="inline-block h-5 border-l-4 border-red-600 mr-2"></span> {{ __('Bài viết mới') }}
        </h2>
    </div>
    <div
        class="flex-shrink max-w-full w-full pb-3 pt-3 sm:pt-0 border-b-2 sm:border-b-0 border-dotted border-gray-100">
        <div class="relative hover-img overflow-hidden">
            <a href="{{ route('post', $firstPost->slug) }}" class="block h-full">
                <img class="max-w-full w-full mx-auto h-full" src="{{ url($firstPost->image) }}" alt="Image description">
            </a>
            <div class="absolute px-5 pt-8 pb-5 bottom-0 w-full bg-gradient-cover">
                <a href="{{ route('post', $firstPost->slug) }}">
                    <h2 class="text-2xl font-bold text-white mb-3">{{ $firstPost->title }}</h2>
                </a>
            </div>
        </div>
    </div>
    <div class="flex flex-col">
        @foreach($posts as $post)
        <div class="grid grid-cols-5 gap-2 border-dashed border-b border-gray-300 py-6">
            <a href="{{ route('post', $post->slug) }}" class="block col-span-2">
                <img class="max-w-full w-full mx-auto aspect-square" src="{{ $post->image }}"
                    alt="{{ $post->title }}">
            </a>
            <div class="col-span-3">
                <h3 class="font-bold mb-2">
                    <a href="{{ route('post', $post->slug) }}">{{ $post->title }}</a>
                </h3>
                <span class="text-gray-500 text-sm flex items-center mb-2" href="#"><x-heroicon-o-calendar-days class="w-4 inline-block mr-1" /> {{ $post->published_at->formatDateDMY() }}</span>
            </div>
        </div>
        @endforeach
    </div>
</div>