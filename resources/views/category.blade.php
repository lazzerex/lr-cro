<x-guest-layout :title="$category->name">
    <div class="grid lg:grid-cols-3 gap-8 py-6 xl:container mx-auto px-3 sm:px-4 xl:px-2 xl:max-w-6xl">
        <div class="lg:col-span-2">
            <div class="w-full py-3">
                <h2 class="text-gray-800 text-2xl font-bold text-uppercase">
                    {{ $category->name }}
                </h2>
            </div>
            <!-- posts list -->
            <div class="flex flex-col">
                @foreach($posts as $post)
                <article class="grid md:grid-cols-12 gap-6 border-solid border-b border-gray-100 py-8">
                    <a href="{{ route('post', $post->slug) }}" class="block col-span-5">
                        <img class="max-w-full w-full mx-auto" src="{{ $post->image }}"
                            alt="{{ $post->title }}">
                    </a>
                    <div class="col-span-7">
                        <h3 class="font-bold mb-2 text-xl">
                            <a href="{{ route('post', $post->slug) }}">{{ $post->title }}</a>
                        </h3>
                        <span class="text-gray-500 text-sm flex items-center mb-2" href="#"><x-heroicon-o-calendar-days class="w-4 inline-block mr-1" /> {{ $post->published_at->formatDateDMY() }}</span>
                        @if ($post->excerpt)
                        <p class="">{{ $post->excerpt }}</p>
                        @endif

                    </div>
                </article>
                @endforeach
            </div>
            <div class="mt-6">
                {!! $posts->links() !!}
            </div>
        </div>
        <aside class="sidebar">
            <x-latest-posts-block />
        </aside>
    </div>

</x-guest-layout>