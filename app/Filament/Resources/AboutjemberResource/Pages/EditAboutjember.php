<?php

namespace App\Filament\Resources\AboutjemberResource\Pages;

use App\Filament\Resources\AboutjemberResource;
use App\Models\aboutjember;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditAboutjember extends EditRecord
{
    protected static string $resource = AboutjemberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->after(
                function (aboutjember $record) {
                    if($record->thumbnail1){
                        Storage::disk('public')->delete($record->thumbnail1);
                    }

                    if($record->thumbnail2){
                        Storage::disk('public')->delete($record->thumbnail2);
                    }

                    if($record->thumbnail3){
                        Storage::disk('public')->delete($record->thumbnail3);
                    }
                }
            )
        ];
    }
}
