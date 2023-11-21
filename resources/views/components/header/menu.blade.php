@props(['items' => []])
<ul class="flex flex-col lg:mx-auto mt-2 lg:flex-row lg:mt-0">
    @foreach($items as $item)
    <li @lm_attrs($item) class="relative" @if ($item->hasChildren()) x-data="{ open: false }" @keydown.escape.stop="open = false" @mouseleave="open = false" @endif>
        <a class="group block py-3 lg:py-7 px-6 hover:text-indigo-500 focus:text-indigo-500"
            href="{!! $item->url() !!}"
            @if ($item->hasChildren()) @mouseenter="open = !open" aria-haspopup="true" x-bind:aria-expanded="open" aria-expanded="false" @endif
        >
            <span
                class="absolute bottom-4 left-1/2 transform -translate-x-1/2 w-6 h-0.5 bg-indigo-500 transition duration-700 ease-in-out opacity-0 group-hover:opacity-100"
                :class="{ 'opacity-100': open }"></span>
            {!! $item->title !!}

            @if ($item->hasChildren())
            <!-- caret -->
            <span class="inline-block ml-2">
                <svg xmlns="http://www.w3.org/2000/svg" width=".8rem" height=".8rem" fill="currentColor"
                    viewBox="0 0 512 512">
                    <polyline points="112 184 256 328 400 184"
                        style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:48px">
                    </polyline>
                </svg>
            </span>
            @endif
        </a>

        @if ($item->hasChildren())
        <x-header.menu-item :items="$item->children()" />
        @endif
    </li>
    @endforeach

</ul>