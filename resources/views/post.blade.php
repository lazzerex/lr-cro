<x-guest-layout :title="$post->title">
    <div class="grid lg:grid-cols-3 gap-8 py-6 xl:container mx-auto px-3 sm:px-4 xl:px-2 xl:max-w-6xl">
        <div class="lg:col-span-2">
            <div class="w-full py-3">
                <h2 class="text-gray-800 text-2xl font-bold text-uppercase">
                    {{ $post->title }}
                </h2>
            </div>
            <div class="post-meta flex gap-4 mb-6">
                <div class="post-meta__date">
                    <span class="text-gray-500 text-sm flex items-center mb-2" href="#"><x-heroicon-o-calendar-days class="w-4 inline-block mr-1" /> {{ $post->published_at->formatDateDMY() }}</span>
                </div>
                <div class="post-meta__categories">
                    <span class="text-gray-500 text-sm flex items-center mb-2" href="#"><x-heroicon-o-folder-open class="w-4 inline-block mr-1" /> {!! $post->categoryLinks !!}</span>
                </div>
            </div>
            {{-- @if ($post->excerpt)
            <div class="post-excerpt mb-4 font-bold">{!! $post->excerpt !!}</div>
            @endif --}}
            <div class="post-content mb-8">
                {!! $post->content !!}
            </div>

            <x-related-posts :post="$post" class="" />
        </div>
        <aside class="sidebar">
            <x-latest-posts-block />
        </aside>
    </div>
</x-guest-layout>