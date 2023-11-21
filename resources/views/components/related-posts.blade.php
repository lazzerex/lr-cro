<div {{ $attributes->merge(['class' => 'related-posts']) }}>
    <div class="w-full py-3">
        <h3 class="text-gray-800 text-2xl font-bold text-uppercase">
            {{ __('Bài viết liên quan') }}
        </h3>
    </div>

    <div class="mx-auto">
        <div class="grid gap-6 lg:grid-cols-3 sm:max-w-sm sm:mx-auto lg:max-w-full">
            @foreach($posts as $post)
            <article class="overflow-hidden duration-300">
                @if ($post->image)
                <a href="{{ route('post', $post->slug) }}" class="block">
                    <img src="{{ url($post->image) }}" class="object-cover w-full" alt="" />
                </a>
                @endif
                <div class="py-5">
                    <a href="{{ route('post', $post->slug) }}" title="{{ $post->title }}"
                        class="inline-block mb-3 text-lg font-bold"
                        ><h3>{{ $post->title }}</h3>
                    </a>
                    @if ($post->excerpt)
                    <p class="mb-2 text-gray-600 text-sm">
                       {!! $post->excerpt !!}
                    </p>
                    @endif
                </div>
            </article>
            @endforeach

        </div>
    </div>
</div>