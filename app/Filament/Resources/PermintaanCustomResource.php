<?php
// 7. Permintaan Custom Resource
namespace App\Filament\Resources;

use App\Filament\Resources\PermintaanCustomResource\Pages;
use App\Models\PermintaanCustom;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Forms;
use Filament\Tables;

class PermintaanCustomResource extends Resource
{
    protected static ?string $model            = PermintaanCustom::class;
    protected static ?string $navigationIcon   = 'heroicon-o-sparkles';
    protected static ?string $modelLabel       = 'Permintaan Custom';
    protected static ?string $pluralModelLabel = 'Permintaan Custom';
    protected static ?int $navigationSort      = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Detail Permintaan')
                            ->schema([
                                Forms\Components\Select::make('user_id_2222336')
                                    ->label('Pelanggan')
                                    ->relationship('user', 'name_2222336')
                                    ->searchable()
                                    ->preload()
                                    ->required(),
                                Forms\Components\TextInput::make('judul_2222336')
                                    ->label('Judul Permintaan')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\Textarea::make('deskripsi_2222336')
                                    ->label('Deskripsi Permintaan')
                                    ->required()
                                    ->columnSpanFull(),
                                Forms\Components\TextInput::make('harga_penawaran_2222336')
                                    ->label('Harga Penawaran')
                                    ->numeric()
                                    ->prefix('Rp')
                                    ->required(),
                                Forms\Components\TextInput::make('harga_akhir_2222336')
                                    ->label('Harga Akhir')
                                    ->numeric()
                                    ->prefix('Rp'),
                            ])
                            ->columns(2),
                    ])
                    ->columnSpan(['lg' => 2]),
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Status & Lampiran')
                            ->schema([
                                Forms\Components\Select::make('status_2222336')
                                    ->label('Status')
                                    ->options([
                                        'pending'  => 'Menunggu Review',
                                        'diproses' => 'Sedang Diproses',
                                        'selesai'  => 'Selesai',
                                        'ditolak'  => 'Ditolak',
                                    ])
                                    ->default('pending')
                                    ->required(),
                                Forms\Components\Textarea::make('catatan_admin_2222336')
                                    ->label('Catatan Admin')
                                    ->placeholder('Catatan untuk permintaan ini'),
                                Forms\Components\FileUpload::make('path_img_2222336')
                                    ->label('Lampiran')
                                    ->directory('permintaan-custom')
                                    ->acceptedFileTypes(['image/*', 'application/pdf']),
                            ]),
                    ])
                    ->columnSpan(['lg' => 1]),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id_2222336')
                    ->label('ID Permintaan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name_2222336')
                    ->label('Pelanggan')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('judul_2222336')
                    ->label('Judul Permintaan')
                    ->searchable()
                    ->limit(30),
                Tables\Columns\TextColumn::make('harga_penawaran_2222336')
                    ->label('Harga Penawaran')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('harga_akhir_2222336')
                    ->label('Harga Akhir')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\SelectColumn::make('status_2222336')
                    ->label('Status')
                    ->options([
                        'pending'  => 'Menunggu Review',
                        'diproses' => 'Sedang Diproses',
                        'selesai'  => 'Selesai',
                        'ditolak'  => 'Ditolak',
                    ])
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status_2222336')
                    ->label('Status')
                    ->options([
                        'pending'  => 'Menunggu Review',
                        'diproses' => 'Sedang Diproses',
                        'selesai'  => 'Selesai',
                        'ditolak'  => 'Ditolak',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('update_status')
                    ->label('Update Status')
                    ->icon('heroicon-o-arrow-path')
                    ->color('warning')
                    ->form([
                        Forms\Components\Select::make('status_2222336')
                            ->label('Status Baru')
                            ->options([
                                'pending'  => 'Menunggu Review',
                                'diproses' => 'Sedang Diproses',
                                'selesai'  => 'Selesai',
                                'ditolak'  => 'Ditolak',
                            ])
                            ->required(),
                        Forms\Components\Textarea::make('catatan_admin_2222336')
                            ->label('Catatan Admin')
                            ->placeholder('Tambahkan catatan untuk permintaan ini'),
                    ])
                    ->action(function (array $data, $record): void {
                        $record->update([
                            'status_2222336'        => $data['status_2222336'],
                            'catatan_admin_2222336' => $data['catatan_admin_2222336'],
                        ]);
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('update_status_bulk')
                        ->label('Update Status')
                        ->icon('heroicon-o-arrow-path')
                        ->form([
                            Forms\Components\Select::make('status_2222336')
                                ->label('Status Baru')
                                ->options([
                                    'pending'  => 'Menunggu Review',
                                    'diproses' => 'Sedang Diproses',
                                    'selesai'  => 'Selesai',
                                    'ditolak'  => 'Ditolak',
                                ])
                                ->required(),
                        ])
                        ->action(function (array $data, \Illuminate\Database\Eloquent\Collection $records): void {
                            $records->each(function ($record) use ($data) {
                                $record->update([
                                    'status_2222336' => $data['status_2222336'],
                                ]);
                            });
                        }),
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
            'index'  => Pages\ListPermintaanCustoms::route('/'),
            'create' => Pages\CreatePermintaanCustom::route('/create'),
            // 'view'   => Pages\ViewPermintaanCustom::route('/{record}'),
            'edit'   => Pages\EditPermintaanCustom::route('/{record}/edit'),
        ];
    }
}
