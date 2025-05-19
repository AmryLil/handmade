<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProdukResource\RelationManagers\GambarRelationManager as RelationManagersGambarRelationManager;
use App\Filament\Resources\ProdukResource\Pages;
use App\Filament\Resources\ProdukResource\RelationManagers;
use App\Models\Gambar;
use App\Models\KategoriProduk;
use App\Models\Produk;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Forms;
use Filament\Tables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class ProdukResource extends Resource
{
    protected static ?string $model            = Produk::class;
    protected static ?string $navigationIcon   = 'heroicon-o-rectangle-stack';
    protected static ?string $modelLabel       = 'Produk';
    protected static ?string $pluralModelLabel = 'Produk';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Produk')
                    ->schema([
                        TextInput::make('nama_222336')
                            ->label('Nama Produk')
                            ->required()
                            ->maxLength(255),
                        Textarea::make('deskripsi_222336')
                            ->label('Deskripsi')
                            ->required(),
                        TextInput::make('harga_222336')
                            ->label('Harga')
                            ->required()
                            ->numeric()
                            ->prefix('Rp'),
                        Select::make('kategori_id_222336')
                            ->label('Kategori')
                            ->options(KategoriProduk::all()->pluck('nama_222336', 'id_222336'))
                            ->searchable()
                            ->required(),
                        TextInput::make('jumlah_222336')
                            ->label('Stok')
                            ->required()
                            ->numeric()
                            ->minValue(0),
                    ])
                    ->columnSpan(2),
                Section::make('Gambar Utama')
                    ->schema([
                        FileUpload::make('path_img_222336')
                            ->label('Gambar Utama')
                            ->image()
                            ->disk('public')
                            ->visibility('public')
                            ->image()
                            ->maxSize(2048)
                    ])
                    ->columnSpan(1),
                Section::make('Gambar Tambahan')
                    ->schema([
                        FileUpload::make('additional_images')
                            ->label('Gambar Tambahan')
                            ->multiple()
                            ->image()
                            ->disk('public')
                            ->directory('produk/gallery')
                            ->imageResizeMode('cover')
                            ->imageResizeTargetWidth('800')
                            ->imageResizeTargetHeight('600')
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg', 'image/gif'])
                            ->maxSize(5120)  // 5MB
                            ->helperText('Anda dapat mengunggah beberapa gambar sekaligus')
                            ->columnSpanFull()
                            ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file): string {
                                $extension = $file->getClientOriginalExtension();
                                return Str::random(10) . '_' . time() . '.' . $extension;
                            })
                            ->visibility('public')
                            // Di sini kita menampilkan gambar-gambar galeri yang sudah ada
                            ->afterStateHydrated(function ($component, $state, $record) {
                                if ($record) {
                                    $existingImages = $record
                                        ->gambar()
                                        ->where('is_main_222336', false)
                                        ->pluck('path_img_222336')
                                        ->toArray();

                                    $component->state($existingImages);
                                }
                            })
                            ->saveRelationshipsUsing(function ($record, $state) {
                                $existingPaths = [];

                                if ($record->exists && count($state) > 0) {
                                    $existingPaths = $record
                                        ->gambar()
                                        ->where('is_main_222336', false)
                                        ->pluck('path_img_222336')
                                        ->toArray();

                                    // Delete existing gallery images that are no longer in the state
                                    $toDelete = $record
                                        ->gambar()
                                        ->where('is_main_222336', false)
                                        ->whereNotIn('path_img_222336', $state)
                                        ->get();

                                    foreach ($toDelete as $image) {
                                        Storage::disk('public')->delete($image->path_img_222336);
                                        $image->delete();
                                    }
                                }

                                // Create new relationships for each new image
                                $sortOrder = $record->gambar()->max('sort_order_222336') ?: 0;

                                foreach ($state as $path) {
                                    // Skip if this image already exists
                                    if (in_array($path, $existingPaths)) {
                                        continue;
                                    }

                                    $sortOrder++;

                                    // Create new gallery image
                                    $record->gambar()->create([
                                        'path_img_222336'   => $path,
                                        'produk_id_222336'  => $record->id_222336,
                                        'alt_text_222336'   => $record->nama_222336 . ' - Gallery ' . $sortOrder,
                                        'is_main_222336'    => false,
                                        'sort_order_222336' => $sortOrder,
                                    ]);
                                }
                            })
                    ])
                    ->columnSpan(3),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id_222336')
                    ->label('ID')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('path_img_222336')
                    ->label('Gambar')
                    ->visibility('public')
                    ->square(),
                Tables\Columns\TextColumn::make('nama_222336')
                    ->label('Nama Produk')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kategori.nama_222336')
                    ->label('Kategori')
                    ->sortable(),
                Tables\Columns\TextColumn::make('harga_222336')
                    ->label('Harga')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('jumlah_222336')
                    ->label('Stok')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Dibuat')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Filter di sini jika diperlukan
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->before(function ($record) {
                        // Hapus gambar utama dari storage
                        if ($record->path_img_222336) {
                            Storage::disk('public')->delete($record->path_img_222336);
                        }

                        // Hapus semua gambar galeri dari storage
                        foreach ($record->gambar as $gambar) {
                            Storage::disk('public')->delete($gambar->path_img_222336);
                        }
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->before(function ($records) {
                            foreach ($records as $record) {
                                // Hapus gambar utama dari storage
                                if ($record->path_img_222336) {
                                    Storage::disk('public')->delete($record->path_img_222336);
                                }

                                // Hapus semua gambar galeri dari storage
                                foreach ($record->gambar as $gambar) {
                                    Storage::disk('public')->delete($gambar->path_img_222336);
                                }
                            }
                        }),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagersGambarRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListProduks::route('/'),
            'create' => Pages\CreateProduk::route('/create'),
            'edit'   => Pages\EditProduk::route('/{record}/edit'),
        ];
    }
}
