<?php
namespace App\Models\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum PostStatus: string implements HasLabel, HasColor
{
    case Draft = 'draft';
    case Publish = 'publish';
    case Reject = 'reject';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Draft => __('Draft'),
            self::Publish => __('Publish'),
            self::Reject => __('Reject'),
        };
    }

    public function getColor(): ?string
    {
        return match ($this) {
            self::Draft => 'gray',
            self::Publish => 'success',
            self::Reject => 'warning',
        };
    }
}