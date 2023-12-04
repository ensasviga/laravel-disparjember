<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Filament\Resources\ArticleResource\RelationManagers;
use App\Models\Article;
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

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            Card::make()->schema([
                Forms\Components\TextInput::make('type')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('thumbnailimg')
                    ->required()->image()->disk('public'),
                Forms\Components\Select::make('place')->required()->options([
                    'Ajung'=> 'Ajung',
                    'Ambulu'=> 'Ambulu',
                    'Arjasa'=> 'Arjasa',
                    'Bangsalsari'=> 'Bangsalsari',
                    'Balung'=> 'Balung',
                    'Gumukmas'=> 'Gumukmas',
                    'Jelbuk'=> 'Jelbuk',
                    'Jenggawah'=> 'Jenggawah',
                    'Jombang'=> 'Jombang',
                    'Kalisat'=> 'Kalisat',
                    'Kaliwates'=> 'Kaliwates',
                    'Kencong'=> 'Kencong',
                    'Ledokombo'=> 'Ledokombo',
                    'Mayang'=> 'Mayang',
                    'Mumbulsari'=> 'Mumbulsari',
                    'Panti'=> 'Panti',
                    'Pakusari'=> 'Pakusari',
                    'Patrang'=> 'Patrang',
                    'Puger'=> 'Puger',
                    'Rambipuji'=> 'Rambipuji',
                    'Semboro'=> 'Semboro',
                    'Silo'=> 'Silo',
                    'Sukorambi'=> 'Sukorambi',
                    'Sukowono'=> 'Sukowono',
                    'Sumberbaru'=> 'Sumberbaru',
                    'Sumberjambe'=> 'Sumberjambe',
                    'Sumbersari'=> 'Sumbersari',
                    'Tanggul'=> 'Tanggul',
                    'Tempurejo'=> 'Tempurejo',
                    'Umbulsari'=> 'Umbulsari',
                    'Wuluhan' => 'Wuluhan'
                ]),
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
                Tables\Columns\TextColumn::make('type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('thumbnailimg')
                    ->searchable(),
                Tables\Columns\TextColumn::make('place')
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
                        if( $value -> thumbnailimg ) {
                            Storage::disk('public')->delete($value->thumbnailimg);
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
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}
