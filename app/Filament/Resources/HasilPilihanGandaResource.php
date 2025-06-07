<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HasilPilihanGandaResource\Pages;
use App\Filament\Resources\HasilPilihanGandaResource\RelationManagers;
use App\Filament\Resources\HasilPilihanGandaResource\RelationManagers\HasilEsaiRelationManager;
use App\Models\HasilPilihanGanda;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class HasilPilihanGandaResource extends Resource
{
    protected static ?string $model = HasilPilihanGanda::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getLabel(): ?string
    {
        return "Hasil Ujian";
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->whereHas('ujian', function ($query) {
            $query->where('user_id', Auth::user()->id);
        });
    }

    public static function canViewAny(): bool
    {
        return Auth::user()->role === "guru";
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Nama Siswa')
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.kelas.nama')
                    ->label('Kelas')
                    ->sortable(),
                Tables\Columns\TextColumn::make('nilai')
                    ->label('Nilai Pilihan Ganda')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nilai_esai')
                    ->label('Nilai Esai')
                    ->getStateUsing(function ($record) {
                        return round($record->hasilEsais->avg('nilai') ?? 0, 2);
                    }),
                Tables\Columns\TextColumn::make('nilai_akhir')
                    ->label('Nilai Akhir')
                    ->getStateUsing(function ($record) {
                        $pilihanGanda = $record->nilai ?? 0;
                        $esai = $record->hasilEsais->avg('nilai') ?? 0;
                        return round(($pilihanGanda + $esai) / 2, 2);
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Periksa Esai'),
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
            HasilEsaiRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHasilPilihanGandas::route('/'),
            'create' => Pages\CreateHasilPilihanGanda::route('/create'),
            'edit' => Pages\EditHasilPilihanGanda::route('/{record}/edit'),
        ];
    }
}
