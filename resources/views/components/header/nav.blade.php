@props(['logo_url'])
@php
    $mainMenu = Menu::get('MainMenu')->roots();
@endphp

<!-- desktop nav -->
<div class="desktop-nav hidden lg:flex lg:flex-row lg:flex-nowrap lg:items-center lg:justify-between lg:mt-0"
    id="desktop-nav">
    <!-- logo -->
    <a class="site-logo hidden lg:flex items-center mr-4 text-xl" href="#">
        <h2 class="text-2xl font-semibold text-gray-200">
            <img class="inline-block h-auto mr-2" src="{{ $logo_url }}">
        </h2>
    </a>

    <!-- menu -->
    <x-header.menu :items="$mainMenu" />

    <!-- button -->
    <div class="grid text-center lg:block my-4 lg:my-auto">
        <a class="py-2 px-4 text-sm inline-block text-center rounded leading-5 text-gray-100 bg-indigo-500 border border-indigo-500 hover:text-white hover:bg-indigo-600 hover:ring-0 hover:border-indigo-600 focus:bg-indigo-600 focus:border-indigo-600 focus:outline-none focus:ring-0"
            target="_blank" rel="noopener" href="#">
            <svg xmlns="http://www.w3.org/2000/svg" class="inline mr-1" width="1.2rem" height="1.2rem"
                fill="currentColor" viewBox="0 0 512 512">
                <circle cx="176" cy="416" r="16"
                    style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                <circle cx="400" cy="416" r="16"
                    style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                <polyline points="48 80 112 80 160 352 416 352"
                    style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                <path d="M160,288H409.44a8,8,0,0,0,7.85-6.43l28.8-144a8,8,0,0,0-7.85-9.57H128"
                    style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
            </svg> Buy Now
        </a>
    </div>
</div><!-- end desktop menu -->