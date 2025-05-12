<?php

namespace App\Filament\Resources\PermintaanCustomResource\Pages;

use App\Filament\Resources\PermintaanCustomResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPermintaanCustoms extends ListRecords
{
    protected static string $resource = PermintaanCustomResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
