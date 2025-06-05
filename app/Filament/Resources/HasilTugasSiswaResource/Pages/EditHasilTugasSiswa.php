<?php

namespace App\Filament\Resources\HasilTugasSiswaResource\Pages;

use App\Filament\Resources\HasilTugasSiswaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHasilTugasSiswa extends EditRecord
{
    protected static string $resource = HasilTugasSiswaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
