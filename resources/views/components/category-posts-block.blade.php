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
        <div>
            <div
                class="flex-shrink max-w-full w-full px-3 pb-3 pt-3 sm:pt-0 border-b-2 sm:border-b-0 border-dotted border-gray-100">
                <div class="flex flex-row sm:block hover-img">
                    <a href="">
                        <img class="max-w-full w-full mx-auto" src="{{ $firstPost->image }}"
                            alt="{{ $firstPost->title }}">
                    </a>
                    <div class="py-0 sm:py-3 pl-3 sm:pl-0">
                        <h3 class="text-lg font-bold leading-tight mb-2">
                            <a href="#">{{ $firstPost->title }}</a>
                        </h3>
                        <p class="hidden md:block text-gray-600 leading-tight mb-1">{{ $firstPost->excerpt }}</p>
                        <a class="text-gray-500" href="#"><span
                                class="inline-block h-3 border-l-2 border-red-600 mr-2"></span>Europe</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-3">
            @foreach($posts as $post)
            <div class="grid grid-cols-4 gap-2">
                <a href="" class="block">
                    <img class="max-w-full w-full mx-auto aspect-square" src="{{ $post->image }}"
                        alt="{{ $post->title }}">
                </a>
                <div class="col-span-3">
                    <h3 class="text-lg font-bold leading-tight mb-2">
                        <a href="#">{{ $post->title }}</a>
                    </h3>
                    <a class="text-gray-500" href="#"><span
                            class="inline-block h-3 border-l-2 border-red-600 mr-2"></span>Europe</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif