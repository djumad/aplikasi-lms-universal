<?php

namespace App\Filament\Resources\HasilTugasSiswaResource\Pages;

use App\Filament\Resources\HasilTugasSiswaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHasilTugasSiswas extends ListRecords
{
    protected static string $resource = HasilTugasSiswaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
