<?php

namespace App\Filament\Resources\PostTagResource\Pages;

use App\Filament\Resources\PostTagResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePostTags extends ManageRecords
{
    protected static string $resource = PostTagResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
