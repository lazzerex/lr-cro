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

</div><!-- end desktop menu -->