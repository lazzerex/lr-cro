<?php
namespace App\Models\ValueObjects;

use Illuminate\Support\Arr;

class SEOData
{
    private function __construct(
        public string $metaTitle = "",
        public string $metaDescription = "",
        public string $metaKeyword = "",
        public string $ogTitle = "",
        public string $ogDescription = "",
        public string $twitterTitle = "",
        public string $twitterDescription = "",
    ) { }

    public static function fromArray(?array $array = [])
    {
        if (is_null($array)) return null;

        return new static(
            metaTitle: Arr::get($array, 'meta_title', ''),
            metaDescription: Arr::get($array, 'meta_description', ''),
            metaKeyword: Arr::get($array, 'meta_keyword', ''),
            ogTitle: Arr::get($array, 'og_title', ''),
            ogDescription: Arr::get($array, 'og_description', ''),
            twitterTitle: Arr::get($array, 'twitter_title', ''),
            twitterDescription: Arr::get($array, 'twitter_description', ''),
        );
    }
}
