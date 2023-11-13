<?php
namespace App\Models\Enums;

use Filament\Support\Contracts\HasLabel;

enum TagTypes: string implements HasLabel
{
    case PostTag = 'post-tag';
    case PortofiloTag = 'portfolio-tag';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::PostTag => __('Post Tag'),
            self::PortofiloTag => __('Portfolio Tag'),
        };
    }
}