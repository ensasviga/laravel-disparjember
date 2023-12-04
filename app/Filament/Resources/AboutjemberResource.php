<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutjemberResource\Pages;
use App\Filament\Resources\AboutjemberResource\RelationManagers;
use App\Models\Aboutjember;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;

class AboutjemberResource extends Resource
{
    protected static ?string $model = Aboutjember::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            Card::make()->schema([
                Forms\Components\Select::make('type')->required()->options([
                    'TEXTPICT' => 'TEXTPICT',
                ]),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('thumbnail1')
                    ->required()->image()->disk('public'),
                Forms\Components\FileUpload::make('thumbnail2')
                    ->required()->image()->disk('public'),
                Forms\Components\FileUpload::make('thumbnail3')
                    ->required()->image()->disk('public'),
                Forms\Components\RichEditor::make('content')
                    ->required()
                    ->maxLength(255),

            ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('thumbnail1')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('thumbnail2')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('thumbnail3')
                    ->searchable(),
                Tables\Columns\TextColumn::make('content')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()->after(function (Collection
                $records) {
                    foreach( $records as $key => $value ) {
                        if( $value -> thumbnail1 ) {
                            Storage::disk('public')->delete($value->thumbnail1);
                        }

                        if( $value -> thumbnail2 ) {
                            Storage::disk('public')->delete($value->thumbnail2);
                        }

                        if( $value -> thumbnail3 ) {
                            Storage::disk('public')->delete($value->thumbnail3);
                        }
                    }
                }),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAboutjembers::route('/'),
            'create' => Pages\CreateAboutjember::route('/create'),
            'edit' => Pages\EditAboutjember::route('/{record}/edit'),
        ];
    }
}
