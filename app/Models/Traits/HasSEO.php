<?php
namespace App\Models\Traits;

use App\Models\ValueObjects\SEOData;
use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasSEO
{
    public function seo(): Attribute
    {
        $seoColumn = $this->getSeoColumn();

        return Attribute::make(
            get: fn () => SEOData::fromArray($this->{$seoColumn}),
        );
    }

    private function getSeoColumn()
    {
        if (property_exists($this, 'seo_data')) {
            return $this->seo_data;
        }

        return 'seo_data';
    }
}