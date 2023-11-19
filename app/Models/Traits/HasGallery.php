<?php
namespace App\Models\Traits;

use App\Models\ValueObjects\GalleryItem;
use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasGallery
{
    public function gallery(): Attribute
    {
        $column = $this->getGalleryColumn();

        return Attribute::make(
            get: function () use ($column) {
                $gallery_data = $this->{$column};
                return $gallery_data ? collect(array_map(fn ($item) => GalleryItem::fromArray($item), $gallery_data)) : collect([]);
            },
        );
    }

    private function getGalleryColumn()
    {
        if (property_exists($this, 'gallery_data')) {
            return $this->gallery_data;
        }

        return 'gallery_data';
    }
}