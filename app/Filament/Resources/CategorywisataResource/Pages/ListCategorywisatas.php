<?php

namespace App\Filament\Resources\CategorywisataResource\Pages;

use App\Filament\Resources\CategorywisataResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCategorywisatas extends ListRecords
{
    protected static string $resource = CategorywisataResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
