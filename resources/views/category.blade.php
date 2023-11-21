<x-guest-layout>
    @foreach($posts as $post)
        <div>{{ $post->title }}</div>
    @endforeach
</x-guest-layout>