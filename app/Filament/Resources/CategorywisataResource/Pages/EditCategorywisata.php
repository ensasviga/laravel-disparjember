<?php

namespace App\Filament\Resources\CategorywisataResource\Pages;

use App\Filament\Resources\CategorywisataResource;
use App\Models\categorywisata;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditCategorywisata extends EditRecord
{
    protected static string $resource = CategorywisataResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->after(
                function (categorywisata $record) {
                    if($record->thumbnail){
                        Storage::disk('public')->delete($record->thumbnail);
                    }
                }
            )
        ];
    }
}
