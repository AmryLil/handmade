<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransaksiResource\Pages;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\Users;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Forms;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class TransaksiResource extends Resource
{
    protected static ?string $model                = Transaksi::class;
    protected static ?string $navigationIcon       = 'heroicon-o-shopping-cart';
    protected static ?string $navigationLabel      = 'Transaksi';
    protected static ?string $recordTitleAttribute = 'id_transaksi_2222336';
    protected static ?int $navigationSort          = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Transaksi')
                    ->schema([
                        Select::make('id_pelanggan_2222336')
                            ->label('Pelanggan')
                            ->relationship('pelanggan', 'name_2222336')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Select::make('id_produk_2222336')
                            ->label('Produk')
                            ->relationship('produk', 'nama_2222336')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->live()
                            ->afterStateUpdated(function ($state, Forms\Set $set, Forms\Get $get) {
                                if ($state) {
                                    $produk = Produk::find($state);
                                    if ($produk) {
                                        $jumlah = (int) $get('jumlah_2222336') ?: 1;
                                        $set('harga_total_2222336', $produk->harga_2222336 * $jumlah);
                                    }
                                }
                            }),
                        TextInput::make('jumlah_2222336')
                            ->label('Jumlah')
                            ->numeric()
                            ->default(1)
                            ->minValue(1)
                            ->required()
                            ->live()
                            ->afterStateUpdated(function ($state, Forms\Get $get, Forms\Set $set) {
                                $productId = $get('id_produk_2222336');
                                if ($productId) {
                                    $produk = Produk::find($productId);
                                    if ($produk) {
                                        $set('harga_total_2222336', $produk->harga_2222336 * (int) ($state ?: 1));
                                    }
                                }
                            }),
                        TextInput::make('harga_total_2222336')
                            ->label('Harga Total')
                            ->numeric()
                            ->prefix('Rp')
                            ->required(),
                    ])
                    ->columns(2),
                Section::make('Status dan Pembayaran')
                    ->schema([
                        Select::make('status_2222336')
                            ->label('Status')
                            ->options([
                                'pending'   => 'Pending',
                                'paid'      => 'Paid',
                                'delivered' => 'Delivered',
                                'completed' => 'Completed',
                                'cancelled' => 'Cancelled',
                            ])
                            ->required()
                            ->default('pending'),
                        FileUpload::make('bukti_tf_2222336')
                            ->label('Bukti Transfer')
                            ->image()
                            ->maxSize(2048)
                            ->directory('bukti-transfer')
                            ->visibility('public')
                            ->imageResizeMode('cover')
                            ->imageCropAspectRatio('1:1')
                            ->imageResizeTargetWidth('300')
                            ->imageResizeTargetHeight('300'),
                        DateTimePicker::make('tanggal_transaksi_2222336')
                            ->label('Tanggal Transaksi')
                            ->required()
                            ->default(now()),
                    ])
                    ->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id_transaksi_2222336')
                    ->label('ID Transaksi')
                    ->searchable()
                    ->sortable()
                    ->copyable(),
                TextColumn::make('pelanggan.name_2222336')
                    ->label('Pelanggan')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('produk.nama_2222336')
                    ->label('Produk')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('jumlah_2222336')
                    ->label('Jumlah')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('harga_total_2222336')
                    ->label('Harga Total')
                    ->money('IDR')
                    ->sortable(),
                TextColumn::make('status_2222336')
                    ->label('Status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'pending'   => 'warning',
                        'paid'      => 'info',
                        'delivered' => 'primary',
                        'completed' => 'success',
                        'cancelled' => 'danger',
                        default     => 'gray',
                    })
                    ->sortable(),
                ImageColumn::make('bukti_tf_2222336')
                    ->label('Bukti Transfer')
                    ->circular()
                    ->defaultImageUrl(url('/images/no-image.png'))
                    ->extraImgAttributes(['loading' => 'lazy']),
                TextColumn::make('tanggal_transaksi_2222336')
                    ->label('Tanggal Transaksi')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Updated At')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('id_transaksi_2222336', 'desc')
            ->filters([
                SelectFilter::make('status_2222336')
                    ->label('Status')
                    ->options([
                        'pending'   => 'Pending',
                        'paid'      => 'Paid',
                        'delivered' => 'Delivered',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                    ]),
                SelectFilter::make('id_pelanggan_2222336')
                    ->label('Pelanggan')
                    ->relationship('pelanggan', 'name_2222336')
                    ->searchable()
                    ->preload(),
                SelectFilter::make('id_produk_2222336')
                    ->label('Produk')
                    ->relationship('produk', 'nama_2222336')
                    ->searchable()
                    ->preload(),
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->label('Created from'),
                        Forms\Components\DatePicker::make('created_until')
                            ->label('Created until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                // Action::make('print_invoice')
                //     ->label('Cetak Invoice')
                //     ->icon('heroicon-o-printer')
                //     ->url(fn(Transaksi $record): string => route('transaksi.invoice', $record))
                //     ->openUrlInNewTab(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('update_status')
                        ->label('Update Status')
                        ->icon('heroicon-o-check-circle')
                        ->form([
                            Select::make('status_2222336')
                                ->label('Status')
                                ->options([
                                    'pending'   => 'Pending',
                                    'paid'      => 'Paid',
                                    'delivered' => 'Delivered',
                                    'completed' => 'Completed',
                                    'cancelled' => 'Cancelled',
                                ])
                                ->required(),
                        ])
                        ->action(function (Collection $records, array $data): void {
                            foreach ($records as $record) {
                                $record->update([
                                    'status_2222336' => $data['status_2222336'],
                                ]);
                            }
                        }),
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
            'index'  => Pages\ListTransaksis::route('/'),
            'create' => Pages\CreateTransaksi::route('/create'),
            'edit'   => Pages\EditTransaksi::route('/{record}/edit'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            // You can add widgets here if needed
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status_2222336', 'pending')->count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return static::getModel()::where('status_2222336', 'pending')->count() > 0 ? 'warning' : 'success';
    }
}
