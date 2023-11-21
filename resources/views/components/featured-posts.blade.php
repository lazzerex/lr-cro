@php
    $firstPost = $posts->shift();

@endphp

    <div class="xl:container mx-auto px-3 sm:px-4 xl:px-2 xl:max-w-6xl py-6"">
        <div class="flex flex-row flex-wrap">
            <!--Start left cover-->
            <div class="flex-shrink max-w-full w-full lg:w-1/2 pb-1 lg:pb-0 lg:pr-1">
                <div class="relative hover-img h-98 overflow-hidden">
                    <a href="#" class="block h-full">
                        <img class="max-w-full w-full mx-auto h-full" src="{{ url($firstPost->image) }}" alt="Image description">
                    </a>
                    <div class="absolute px-5 pt-8 pb-5 bottom-0 w-full bg-gradient-cover">
                        <a href="#">
                            <h2 class="text-3xl font-bold capitalize text-white mb-3">{{ $firstPost->title }}</h2>
                        </a>
                        @if ($firstPost->excerpt)
                        <p class="text-gray-100 hidden sm:inline-block">{{ $firstPost->excerpt }}</p>
                        @endif
                        @if ($firstPost->categories->count() > 0)
                        <div class="pt-2 flex flex-wrap text-sm gap-1">
                            @foreach ($firstPost->categories->all() as $cat)
                            <span class="inline-block leading-none text-center py-1 px-2 bg-indigo-500 text-gray-100 font-bold rounded">
                                <a href="{{ route('category', $cat->slug) }}" title="{{ $cat->name }}">{{ $cat->name }}</a>
                            </span>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!--Start box news-->
            <div class="flex-shrink max-w-full w-full lg:w-1/2">
                <div class="box-one flex flex-row flex-wrap">
                    @foreach ($posts as $post)
                    <article class="flex-shrink max-w-full w-full sm:w-1/2">
                        <div class="relative hover-img h-48 overflow-hidden">
                            <a href="#" class="block h-full">
                                <img class="max-w-full w-full h-full mx-auto object-cover" src="{{ url($post->image) }}"
                                    alt="Image description">
                            </a>
                            <div class="absolute px-4 pt-7 pb-4 bottom-0 w-full bg-gradient-cover">
                                <a href="#">
                                    <h2 class="text-lg font-bold capitalize leading-tight text-white mb-1">{{ $post->title }}</h2>
                                </a>
                                @if ($post->categories->count() > 0)
                                <div class="pt-1 flex flex-wrap text-sm gap-1">
                                    @foreach ($post->categories->all() as $cat)
                                    <span class="inline-block leading-none text-center py-1 px-2 bg-indigo-500 text-gray-100 font-bold rounded">
                                        <a href="{{ route('category', $cat->slug) }}" title="{{ $cat->name }}">{{ $cat->name }}</a>
                                    </span>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
