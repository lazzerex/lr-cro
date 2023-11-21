@props([
'logo_url',
'direction' => 'left',
])

<!-- mobile navigation -->
<div class="mobile-nav flex flex-row justify-between py-3 lg:hidden">
    <!-- logo -->
    <a class="site-logo flex items-center py-2 mr-4 text-xl" href="#">
        <h2 class="text-2xl font-semibold text-gray-200">
            <img class="inline-block mr-2" src="{{ $logo_url }}">
        </h2>
    </a>
    <!-- navbar toggler -->
    <div class="right-0 flex items-center">
        <!-- Mobile menu button-->
        <button id="navbartoggle" type="button"
            class="inline-flex items-center justify-center text-gray-800 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 focus:outline-none focus:ring-0"
            aria-controls="mobile-menu" @click="open = !open" aria-expanded="false"
            x-bind:aria-expanded="open.toString()">
            <span class="sr-only">Mobile menu</span>
            <svg x-description="Icon closed" x-state:on="Menu open" x-state:off="Menu closed" class="block h-8 w-8"
                :class="{ 'hidden': open, 'block': !(open) }" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                </path>
            </svg>

            <svg x-description="Icon open" x-state:on="Menu open" x-state:off="Menu closed" class="hidden h-8 w-8"
                :class="{ 'block': open, 'hidden': !(open) }" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
</div>

<!-- Mobile menu -->
<div class="lg:hidden fixed w-full h-full inset-0 z-50" id="mobile-menu" x-description="Mobile menu" x-show="open"
    style="display: none;">
    <!-- bg open -->
    <span class="fixed bg-gray-900 bg-opacity-70 w-full h-full inset-x-0 top-0"></span>

    <!-- Mobile navbar -->
    <nav id="mobile-nav"
        class="flex flex-col left-0 w-64 fixed top-0 py-4 bg-white dark:bg-gray-800 h-full overflow-auto z-40"
        x-show="open" @click.away="open=false" x-description="Mobile menu" x-show="open" role="menu"
        aria-orientation="vertical" aria-labelledby="navbartoggle"
        x-transition:enter="transform transition-transform duration-300" x-transition:enter-start="-translate-x-full"
        x-transition:enter-end="-translate-x-0" x-transition:leave="transform transition-transform duration-300"
        x-transition:leave-start="-translate-x-0" x-transition:leave-end="-translate-x-full">
        <div class="mb-auto">
            <!--logo-->
            <div class="mh-18 text-center px-12 mb-8">
                <a href="#" class="flex relative">
                    <h2 class="text-2xl font-semibold text-gray-200 px-4 max-h-9 overflow-hidden">
                        <img class="inline-block" src="{{ $logo_url }}">
                    </h2>
                </a>
            </div>
            <!--navigation-->
            <div class="mb-4">
                <nav class="relative flex flex-wrap items-center justify-between">
                    <ul id="side-menu" class="w-full float-none flex flex-col">
                        <li class="relative">
                            <a href="#" class="block py-3 px-4 hover:text-indigo-700 focus:text-indigo-700">Home</a>
                        </li>

                        <!-- dropdown with submenu-->
                        <li class="relative" x-data="{ open: false }" @keydown.escape.stop="open = false"
                            @click.away="open = false">
                            <a id="mobiledrop-04"
                                class="block py-3 px-4 hover:text-indigo-500 focus:text-indigo-500 dark:hover:text-gray-100 dark:focus:text-gray-100"
                                href="javascript:;" @click="open = !open" aria-haspopup="true"
                                x-bind:aria-expanded="open" :class="{ 'text-indigo-500 dark:text-gray-100': open }">
                                Dropdown
                                <!-- caret -->
                                <span class="inline-block float-right mt-1 pt-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="transform transition duration-300"
                                        :class="{ 'rotate-90' : open , 'rotate-0' : !open }" width=".8rem"
                                        height=".8rem" fill="currentColor" viewBox="0 0 512 512">
                                        <polyline points="184 112 328 256 184 400"
                                            style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:48px" />
                                    </svg>
                                </span>
                            </a>

                            <!-- dropdown menu -->
                            <ul class="block rounded rounded-t-none top-full z-50 py-0.5 text-left bg-white dark:bg-gray-800 mb-4"
                                style="min-width: 12rem" x-description="Dropdown menu" x-show="open" role="menu"
                                aria-orientation="vertical" aria-labelledby="mobiledrop-04">
                                <!--submenu-->
                                <li class="relative" x-data="{ open: false }" @keydown.escape.stop="open = false"
                                    @click.away="open = false">
                                    <a id="sidemenu-01"
                                        class="block w-full py-2 px-6 clear-both whitespace-nowrap hover:text-indigo-500 dark:hover:text-gray-100"
                                        href="javascript:;" @click="open = !open" aria-haspopup="true"
                                        x-bind:aria-expanded="open"
                                        :class="{ 'text-indigo-500 dark:text-gray-100': open }">
                                        Dropdown Item
                                        <!-- caret -->
                                        <span class="inline-block float-right mt-1 pt-1">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="transform transition duration-300"
                                                :class="{ 'rotate-90' : open , 'rotate-0' : !open }" width=".8rem"
                                                height=".8rem" fill="currentColor" viewBox="0 0 512 512">
                                                <polyline points="184 112 328 256 184 400"
                                                    style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:48px" />
                                            </svg>
                                        </span>
                                    </a>

                                    <!--dropdown submenu-->
                                    <ul class="block rounded rounded-t-none top-full z-50 ml-3 py-0.5 text-left bg-white dark:bg-gray-800"
                                        style="min-width: 12rem" x-description="Dropdown menu" x-show="open" role="menu"
                                        aria-orientation="vertical" aria-labelledby="sidemenu-01">
                                        <li><a class="block w-full py-2 px-6 clear-both whitespace-nowrap hover:text-indigo-500 dark:hover:text-gray-100"
                                                href="#">Dropdown sub item</a></li>
                                        <li><a class="block w-full py-2 px-6 clear-both whitespace-nowrap hover:text-indigo-500 dark:hover:text-gray-100"
                                                href="#">Dropdown sub item</a></li>
                                        <li><a class="block w-full py-2 px-6 clear-both whitespace-nowrap hover:text-indigo-500 dark:hover:text-gray-100"
                                                href="#">Dropdown sub item</a></li>
                                        <li><a class="block w-full py-2 px-6 clear-both whitespace-nowrap hover:text-indigo-500 dark:hover:text-gray-100"
                                                href="#">Dropdown sub item</a></li>
                                    </ul>
                                </li>
                                <!--end submenu-->

                                <!--submenu-->
                                <li class="relative" x-data="{ open: false }" @keydown.escape.stop="open = false"
                                    @click.away="open = false">
                                    <a id="sidemenu-02"
                                        class="block w-full py-2 px-6 clear-both whitespace-nowrap hover:text-indigo-500 dark:hover:text-gray-100"
                                        href="javascript:;" @click="open = !open" aria-haspopup="true"
                                        x-bind:aria-expanded="open"
                                        :class="{ 'text-indigo-500 dark:text-gray-100': open }">
                                        Dropdown item
                                        <!-- caret -->
                                        <span class="inline-block float-right mt-1 pt-1">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="transform transition duration-300"
                                                :class="{ 'rotate-90' : open , 'rotate-0' : !open }" width=".8rem"
                                                height=".8rem" fill="currentColor" viewBox="0 0 512 512">
                                                <polyline points="184 112 328 256 184 400"
                                                    style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:48px" />
                                            </svg>
                                        </span>
                                    </a>

                                    <!--dropdown submenu-->
                                    <ul class="block rounded rounded-t-none top-full z-50 ml-3 py-0.5 text-left bg-white dark:bg-gray-800"
                                        style="min-width: 12rem" x-description="Dropdown menu" x-show="open" role="menu"
                                        aria-orientation="vertical" aria-labelledby="sidemenu-02">
                                        <li><a class="block w-full py-2 px-6 clear-both whitespace-nowrap hover:text-indigo-500 dark:hover:text-gray-100"
                                                href="#">Dropdown sub item</a></li>
                                        <li><a class="block w-full py-2 px-6 clear-both whitespace-nowrap hover:text-indigo-500 dark:hover:text-gray-100"
                                                href="#">Dropdown sub item</a></li>
                                        <li><a class="block w-full py-2 px-6 clear-both whitespace-nowrap hover:text-indigo-500 dark:hover:text-gray-100"
                                                href="#">Dropdown sub item</a></li>
                                    </ul>
                                </li>
                                <!--end submenu-->

                                <!--submenu-->
                                <li class="relative" x-data="{ open: false }" @keydown.escape.stop="open = false"
                                    @click.away="open = false">
                                    <a id="sidemenu-03"
                                        class="block w-full py-2 px-6 clear-both whitespace-nowrap hover:text-indigo-500 dark:hover:text-gray-100"
                                        href="javascript:;" @click="open = !open" aria-haspopup="true"
                                        x-bind:aria-expanded="open"
                                        :class="{ 'text-indigo-500 dark:text-gray-100': open }">
                                        Dropdown item
                                        <!-- caret -->
                                        <span class="inline-block float-right mt-1 pt-1">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="transform transition duration-300"
                                                :class="{ 'rotate-90' : open , 'rotate-0' : !open }" width=".8rem"
                                                height=".8rem" fill="currentColor" viewBox="0 0 512 512">
                                                <polyline points="184 112 328 256 184 400"
                                                    style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:48px" />
                                            </svg>
                                        </span>
                                    </a>

                                    <!--dropdown submenu-->
                                    <ul class="block rounded rounded-t-none top-full z-50 ml-3 py-0.5 text-left bg-white dark:bg-gray-800"
                                        style="min-width: 12rem" x-description="Dropdown menu" x-show="open" role="menu"
                                        aria-orientation="vertical" aria-labelledby="sidemenu-03">
                                        <li><a class="block w-full py-2 px-6 clear-both whitespace-nowrap hover:text-indigo-500 dark:hover:text-gray-100"
                                                href="#">Dropdown sub item</a></li>
                                        <li><a class="block w-full py-2 px-6 clear-both whitespace-nowrap hover:text-indigo-500 dark:hover:text-gray-100"
                                                href="#">Dropdown sub item</a></li>
                                    </ul>
                                </li>
                                <!--end submenu-->
                            </ul>
                        </li>

                        <li class="relative">
                            <a href="#" class="block py-3 px-4 hover:text-indigo-700 focus:text-indigo-700">About</a>
                        </li>
                        <li class="relative">
                            <a href="#" class="block py-3 px-4 hover:text-indigo-700 focus:text-indigo-700">Services</a>
                        </li>
                        <li class="relative">
                            <a href="#" class="block py-3 px-4 hover:text-indigo-700 focus:text-indigo-700">Support</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </nav>
</div><!-- End Mobile menu -->