<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\Users;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Forms;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model            = Users::class;
    protected static ?string $navigationIcon   = 'heroicon-o-users';
    protected static ?string $modelLabel       = 'Pengguna';
    protected static ?string $pluralModelLabel = 'Pengguna';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Akun')
                    ->schema([
                        Forms\Components\TextInput::make('name_2222336')
                            ->label('Nama')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email_2222336')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->unique(table: 'users_2222336', column: 'email_2222336', ignoreRecord: true)
                            ->maxLength(255),
                        Forms\Components\TextInput::make('password_2222336')
                            ->label('Password')
                            ->password()
                            ->dehydrateStateUsing(fn(string $state): string => Hash::make($state))
                            ->dehydrated(fn(?string $state): bool => filled($state))
                            ->required(fn(string $operation): bool => $operation === 'create'),
                        Forms\Components\Select::make('role_2222336')
                            ->label('Peran')
                            ->options([
                                'admin'    => 'Admin',
                                'customer' => 'Pelanggan',
                            ])
                            ->required()
                            ->default('customer'),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('Informasi Pribadi')
                    ->schema([
                        Forms\Components\Select::make('gender_2222336')
                            ->label('Jenis Kelamin')
                            ->options([
                                'male'   => 'Laki-laki',
                                'female' => 'Perempuan',
                            ]),
                        Forms\Components\DatePicker::make('birth_date_2222336')
                            ->label('Tanggal Lahir'),
                        Forms\Components\TextInput::make('phone_2222336')
                            ->label('Nomor Telepon')
                            ->tel()
                            ->maxLength(15),
                        Forms\Components\Textarea::make('address_2222336')
                            ->label('Alamat')
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('profile_photo_2222336')
                            ->label('Foto Profil')
                            ->image()
                            ->directory('profile-photos')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('profile_photo_2222336')
                    ->label('Foto')
                    ->circular(),
                Tables\Columns\TextColumn::make('name_2222336')
                    ->label('Nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email_2222336')
                    ->label('Email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('role_2222336')
                    ->label('Peran')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'admin'    => 'success',
                        'customer' => 'info',
                        default    => 'gray',
                    }),
                Tables\Columns\TextColumn::make('phone_2222336')
                    ->label('Telepon')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Terdaftar')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('role_2222336')
                    ->label('Peran')
                    ->options([
                        'admin'    => 'Admin',
                        'customer' => 'Pelanggan',
                    ]),
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
            'index'  => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit'   => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
