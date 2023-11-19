@foreach ($posts as $post)
<ul>
    <li>{{ $post->id }}</li>
    <li>{{ $post->title }}</li>
    @if($post->gallery_data)
        @foreach($post->gallery_data as $item)
        <li>
            <ul>
                <li>{{ Arr::get($item, 'image') }}</li>
                <li>{{ Arr::get($item, 'caption') }}</li>
            </ul>
        </li>
        @endforeach
    @endif
    <li>
        <pre>
        @php
            print_r($post->seo);
        @endphp
        </pre>

    </li>
    <li>
    <pre>
        @php
            print_r($post->gallery);
        @endphp
        </pre>
    </li>
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
