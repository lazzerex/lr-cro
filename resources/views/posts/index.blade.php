@foreach ($posts as $post)
<ul>
    <li>{{ $post->id }}</li>
    <li>{{ $post->title }}</li>
    @if($post->gallery)
        @foreach($post->gallery as $item)
        <li>
            <ul>
                <li>{{ $item['image'] }}</li>
                <li>{{ $item['caption'] }}</li>
            </ul>
        </li>
        @endforeach
    @endif
    @php
        print_r($post->seo)
    @endphp
    {{-- @if($post->options)
        <li>
            <ul>
                <li>{{ $post->options['chuoi'] }}</li>
                <li>{{ $post->options['so'] }}</li>
                <li>{{ $post->options['ngay'] }}</li>
            </ul>
        </li>
    @endif --}}
</ul>
@endforeach
