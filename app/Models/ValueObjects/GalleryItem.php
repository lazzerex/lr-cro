<?php
namespace App\Models\ValueObjects;

use Illuminate\Support\Arr;

class GalleryItem
{
    public function __construct(
        public string $image = '',
        public string $caption = '',
        public string $description = '',
    )
    {

    }

    public static function fromArray(?array $array)
    {
        if (is_null($array)) return null;

        return new static(
            image: Arr::get($array, 'image', ''),
            caption: Arr::get($array, 'caption', ''),
            description: Arr::get($array, 'description', ''),
        );
    }
}