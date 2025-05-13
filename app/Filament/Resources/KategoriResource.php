<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KategoriResource\Pages;
use App\Filament\Resources\KategoriResource\RelationManagers;
use App\Models\Kategori;
use App\Models\KategoriProduk;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Forms;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KategoriResource extends Resource
{
    protected static ?string $model            = KategoriProduk::class;
    protected static ?string $navigationIcon   = 'heroicon-o-tag';
    protected static ?string $modelLabel       = 'Kategori';
    protected static ?string $pluralModelLabel = 'Kategori';
    protected static ?int $navigationSort      = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('nama_2222336')
                            ->label('Nama Kategori')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('deskripsi_2222336')
                            ->label('Deskripsi')
                            ->required(),
                        Forms\Components\TextInput::make('tags_2222336')
                            ->label('Tag (pisahkan dengan koma)')
                            ->maxLength(100),
                        Forms\Components\FileUpload::make('path_img_2222336')
                            ->label('Gambar Kategori')
                            ->image()
                            ->required()
                            ->directory('kategori'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('path_img_2222336')
                    ->label('Gambar')
                    ->image(),
                Tables\Columns\TextColumn::make('nama_2222336')
                    ->label('Nama Kategori')
                    ->searchable(),
                // Tables\Columns\TextColumn::make('produk_count')
                //     ->label('Jumlah Produk')
                //     ->counts('produk')
                //     ->sortable(),
                Tables\Columns\TextColumn::make('tags_2222336')
                    ->label('Tag')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index'  => Pages\ListKategoris::route('/'),
            'create' => Pages\CreateKategori::route('/create'),
            'edit'   => Pages\EditKategori::route('/{record}/edit'),
        ];
    }
}
