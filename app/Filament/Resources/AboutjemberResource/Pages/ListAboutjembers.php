<?php

namespace App\Filament\Resources\AboutjemberResource\Pages;

use App\Filament\Resources\AboutjemberResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAboutjembers extends ListRecords
{
    protected static string $resource = AboutjemberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
