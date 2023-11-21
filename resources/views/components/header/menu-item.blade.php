@props(['items' => []])

<!-- dropdown menu -->
<ul class="block absolute left-1/2 right-auto transform -translate-x-1/2 border-t-2 border-indigo-500 rounded rounded-t-none top-full z-50 py-0.5 text-left bg-white shadow-md"
    style="min-width: 12rem; display: none;" x-show="open" role="menu"
    aria-orientation="vertical" aria-labelledby="dropdown-02" x-transition:enter="transition duration-200"
    x-transition:enter-start="transform opacity-0 translate-y-4"
    x-transition:enter-end="transform opacity-100 translate-y-0" x-transition:leave="transition translate-y-4"
    x-transition:leave-start="transform opacity-100 translate-y-0"
    x-transition:leave-end="transform opacity-0 translate-y-4">

    @foreach($items as $item)
    <li class="relative" @if ($item->hasChildren()) x-data="{ open: false }" @keydown.escape.stop="open = false" @mouseleave="open = false" @endif>
        <a class="block w-full py-2 px-6 clear-both whitespace-nowrap hover:text-indigo-500"
            @if ($item->hasChildren())
            href="javascript:;" @mouseenter="open = !open" aria-haspopup="true" x-bind:aria-expanded="open" aria-expanded="false"
            @else
            href="{!! $item->url() !!}"
            @endif
        >
            {!! $item->title !!}
            @if ($item->hasChildren())
            <!-- caret -->
            <span class="inline-block float-right mt-1 pt-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="transform -rotate-90" width=".8rem" height=".8rem"
                    fill="currentColor" viewBox="0 0 512 512">
                    <polyline points="112 184 256 328 400 184"
                        style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:48px">
                    </polyline>
                </svg>
            </span>
            @endif
        </a>
        @if ($item->hasChildren())
        <!--dropdown submenu-->
        <x-header.menu-item :items="$item->children()" />
        @endif
    </li>
    @endforeach
</ul>