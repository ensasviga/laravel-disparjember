<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategorywisataResource\Pages;
use App\Filament\Resources\CategorywisataResource\RelationManagers;
use App\Models\Categorywisata;
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

class CategorywisataResource extends Resource
{
    protected static ?string $model = Categorywisata::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Card::make()->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('thumbnail')
                    ->required()->image()->disk('public'),
                Forms\Components\Select::make('category')->required()->options([
                    'Wisata Religi'=> 'Wisata Religi',
                    'Wisata Pesisir'=> 'Wisata Pesisir',
                    'Wisata Non Peisir'=> 'Wisata Non Peisir',
                    'Wisata Kuliner'=> 'Wisata Kuliner',
                ]),
            ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('thumbnail')
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
                        if( $value -> thumbnail ) {
                            Storage::disk('public')->delete($value->thumbnail);
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
            'index' => Pages\ListCategorywisatas::route('/'),
            'create' => Pages\CreateCategorywisata::route('/create'),
            'edit' => Pages\EditCategorywisata::route('/{record}/edit'),
        ];
    }
}
