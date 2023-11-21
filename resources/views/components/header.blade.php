<header id="main-header" class="main-header">
    <!-- Navbar -->
    <nav x-data="{ open: false }"
        class="flex flex-nowrap lg:flex-start items-center z-20 top-0 left-0 right-0 bg-white dark:bg-gray-800 overflow-y-auto max-h-screen lg:overflow-visible lg:max-h-full">
        <div class="container mx-auto px-4 xl:max-w-6xl ">
            <x-header.mobile-nav :logo_url="$logo_url" />
            <x-header.nav :logo_url="$logo_url" />
        </div>
    </nav><!-- End Navbar -->
</header>