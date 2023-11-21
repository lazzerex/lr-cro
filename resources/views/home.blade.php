<x-guest-layout>
    <div class="py-8">
        <x-featured-posts />
        <div class="grid lg:grid-cols-3 gap-5 py-6 xl:container mx-auto px-3 sm:px-4 xl:px-2 xl:max-w-6xl">
            <div class="lg:col-span-2">
                <x-category-posts-block class="pb-6" category-id="1" />
                <x-category-posts-block slug="vero-illo-voluptatum-autem" />
            </div>
            <aside class="sidebar">
                <x-latest-posts-block />
            </aside>
        </div>
    </div>
</x-guest-layout>