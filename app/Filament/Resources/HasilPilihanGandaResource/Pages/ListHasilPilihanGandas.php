<?php

namespace App\Filament\Resources\HasilPilihanGandaResource\Pages;

use App\Filament\Resources\HasilPilihanGandaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHasilPilihanGandas extends ListRecords
{
    protected static string $resource = HasilPilihanGandaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
