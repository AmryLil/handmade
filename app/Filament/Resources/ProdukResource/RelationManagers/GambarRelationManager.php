<?php

namespace App\Filament\Resources\ProdukResource\RelationManagers;

use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Filament\Forms;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class GambarRelationManager extends RelationManager
{
  protected static string $relationship          = 'gambar';
  protected static ?string $recordTitleAttribute = 'alt_text_222336';
  protected static ?string $title                = 'Gambar Produk';

  public function form(Form $form): Form
  {
    return $form
      ->schema([
        Forms\Components\FileUpload::make('path_img_222336')
          ->label('Gambar')
          ->image()
          ->disk('public')
          ->preserveFilenames()
          ->directory('produk/gallery')
          ->visibility('public')
          ->required(),
        Forms\Components\TextInput::make('alt_text_222336')
          ->label('Teks Alternatif (Alt Text)')
          ->required()
          ->maxLength(255),
        Forms\Components\Toggle::make('is_main_222336')
          ->label('Gambar Utama')
          ->helperText('Jika diaktifkan, gambar ini akan menjadi gambar utama produk')
          ->reactive()
          ->afterStateUpdated(function ($state, $set, $record, $livewire) {
            if ($state) {
              // Update path di model produk jika gambar ini diset sebagai utama
              $produk                  = $record->produk;
              $produk->path_img_222336 = $record->path_img_222336;
              $produk->save();

              // Set semua gambar lain menjadi bukan utama
              $livewire
                ->getOwnerRecord()
                ->gambar()
                ->where('id_222336', '!=', $record->id_222336)
                ->update(['is_main_222336' => false]);
            }
          }),
        Forms\Components\TextInput::make('sort_order_222336')
          ->label('Urutan')
          ->numeric()
          ->default(0)
          ->helperText('Angka yang lebih kecil akan ditampilkan lebih dulu'),
      ]);
  }

  public function table(Table $table): Table
  {
    return $table
      ->columns([
        Tables\Columns\ImageColumn::make('path_img_222336')
          ->label('Gambar')
          ->disk('public')
          ->visibility('public')
          ->square(),
        Tables\Columns\TextColumn::make('alt_text_222336')
          ->label('Alt Text')
          ->searchable()
          ->limit(30),
        Tables\Columns\IconColumn::make('is_main_222336')
          ->label('Gambar Utama')
          ->boolean(),
        Tables\Columns\TextColumn::make('sort_order_222336')
          ->label('Urutan')
          ->sortable(),
        Tables\Columns\TextColumn::make('created_at')
          ->label('Tanggal Ditambahkan')
          ->dateTime()
          ->sortable()
          ->toggleable(isToggledHiddenByDefault: true),
      ])
      ->defaultSort('sort_order_222336')
      ->filters([
        //
      ])
      ->headerActions([
        Tables\Actions\CreateAction::make()
          ->using(function (array $data, $livewire): mixed {
            $data['produk_id_222336'] = $livewire->getOwnerRecord()->id_222336;

            // Jika ini gambar utama, update gambar utama di produk
            if (isset($data['is_main_222336']) && $data['is_main_222336'] === true) {
              $produk                  = $livewire->getOwnerRecord();
              $produk->path_img_222336 = $data['path_img_222336'];
              $produk->save();

              // Set semua gambar lain menjadi bukan utama
              $produk->gambar()->update(['is_main_222336' => false]);
            }

            return $livewire->getRelationship()->create($data);
          }),
      ])
      ->actions([
        Tables\Actions\EditAction::make(),
        Tables\Actions\DeleteAction::make()
          ->before(function ($record, $livewire) {
            // Jika ini gambar utama, hapus referensi dari produk
            if ($record->is_main_222336) {
              $produk                  = $livewire->getOwnerRecord();
              $produk->path_img_222336 = null;
              $produk->save();
            }

            // Delete the image from local storage
            if ($record->path_img_222336) {
              try {
                Storage::disk('public')->delete($record->path_img_222336);
              } catch (\Exception $e) {
                Log::error('Failed to delete image from local storage: ' . $e->getMessage());
              }
            }
          }),
        Tables\Actions\Action::make('set_as_main')
          ->label('Jadikan Utama')
          ->icon('heroicon-o-star')
          ->color('success')
          ->hidden(fn($record) => $record->is_main_222336)
          ->action(function ($record, $livewire) {
            // Set sebagai gambar utama
            $record->is_main_222336 = true;
            $record->save();

            // Update path di produk
            $produk                  = $livewire->getOwnerRecord();
            $produk->path_img_222336 = $record->path_img_222336;
            $produk->save();

            // Set semua gambar lain menjadi bukan utama
            $livewire
              ->getOwnerRecord()
              ->gambar()
              ->where('id_222336', '!=', $record->id_222336)
              ->update(['is_main_222336' => false]);
          }),
      ])
      ->bulkActions([
        Tables\Actions\BulkActionGroup::make([
          Tables\Actions\DeleteBulkAction::make()
            ->before(function ($records, $livewire) {
              // Jika ada gambar utama yang akan dihapus, hapus referensi di produk
              if ($records->where('is_main_222336', true)->count() > 0) {
                $produk                  = $livewire->getOwnerRecord();
                $produk->path_img_222336 = null;
                $produk->save();
              }

              // Delete all selected images from local storage
              foreach ($records as $record) {
                if ($record->path_img_222336) {
                  try {
                    Storage::disk('public')->delete($record->path_img_222336);
                  } catch (\Exception $e) {
                    Log::error('Failed to delete image from local storage: ' . $e->getMessage());
                  }
                }
              }
            }),
          Tables\Actions\BulkAction::make('update_order')
            ->label('Update Urutan')
            ->icon('heroicon-o-arrows-up-down')
            ->action(function ($records, $data) {
              // Update urutan gambar berdasarkan ID
              $startOrder = (int) $data['start_order'];
              $i          = 0;

              foreach ($records as $record) {
                $record->sort_order_222336 = $startOrder + $i;
                $record->save();
                $i++;
              }
            })
            ->form([
              Forms\Components\TextInput::make('start_order')
                ->label('Mulai dari Urutan')
                ->numeric()
                ->default(1)
                ->required(),
            ]),
        ]),
      ]);
  }
}
