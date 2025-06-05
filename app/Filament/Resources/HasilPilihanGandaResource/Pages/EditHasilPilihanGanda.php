<?php

namespace App\Filament\Resources\HasilPilihanGandaResource\Pages;

use App\Filament\Resources\HasilPilihanGandaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;

class EditHasilPilihanGanda extends EditRecord
{
    protected static string $resource = HasilPilihanGandaResource::class;

    public function getTitle(): string|Htmlable
    {
        return "List Esai";
    }


    protected function getHeaderActions(): array
    {
        return [];
    }

    protected function getFormActions(): array
    {
        return [];
    }
}
