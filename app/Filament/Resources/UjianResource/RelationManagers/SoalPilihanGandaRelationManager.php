<?php

namespace App\Filament\Resources\UjianResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class SoalPilihanGandaRelationManager extends RelationManager
{
    protected static string $relationship = 'soalPilihanGanda';

    public static function canViewAny() : bool{
        return Auth::user()->role === "guru";
    }
    
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make([
                    Forms\Components\TextInput::make('pertanyaan.soal')
                        ->label('Teks Pertanyaan')
                        ->required(),
                    FileUpload::make('pertanyaan.gambar')
                        ->label('Gambar Pertanyaan')
                        ->image()
                        ->directory('soal-gambar')
                        ->preserveFilenames(),
                ]),

                Forms\Components\Fieldset::make('Opsi A')->schema([
                    Forms\Components\TextInput::make('opsi_a.nilai')
                        ->label('Nilai'),
                    Forms\Components\TextInput::make('opsi_a.teks')
                        ->label('Teks Opsi A')
                        ->required(),
                    FileUpload::make('opsi_a.gambar')
                        ->label('Gambar Opsi A')
                        ->image()
                        ->directory('opsi-gambar')
                        ->preserveFilenames(),
                ]),
                Forms\Components\Fieldset::make('Opsi B')->schema([
                    Forms\Components\TextInput::make('opsi_b.nilai')
                        ->label('Nilai'),
                    Forms\Components\TextInput::make('opsi_b.teks')
                        ->label('Teks Opsi B')
                        ->required(),
                    FileUpload::make('opsi_b.gambar')
                        ->label('Gambar Opsi B')
                        ->image()
                        ->directory('opsi-gambar')
                        ->preserveFilenames(),
                ]),
                Forms\Components\Fieldset::make('Opsi C')->schema([
                    Forms\Components\TextInput::make('opsi_c.nilai')
                        ->label('Nilai'),
                    Forms\Components\TextInput::make('opsi_c.teks')
                        ->label('Teks Opsi C')
                        ->required(),
                    FileUpload::make('opsi_c.gambar')
                        ->label('Gambar Opsi C')
                        ->image()
                        ->directory('opsi-gambar')
                        ->preserveFilenames(),
                ]),
                Forms\Components\Fieldset::make('Opsi D')->schema([
                    Forms\Components\TextInput::make('opsi_d.nilai')
                        ->label('Nilai'),
                    Forms\Components\TextInput::make('opsi_d.teks')
                        ->label('Teks Opsi D')
                        ->required(),
                    FileUpload::make('opsi_d.gambar')
                        ->label('Gambar Opsi D')
                        ->image()
                        ->directory('opsi-gambar')
                        ->preserveFilenames(),
                ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('soal pilihan ganda')
            ->columns([
                Tables\Columns\TextColumn::make('pertanyaan')
                    ->label('Pertanyaan')
                    ->getStateUsing(fn($record) => $record->pertanyaan['soal'] ?? '')
                    ->searchable(),

                Tables\Columns\TextColumn::make('opsi_a')
                    ->label('Opsi A')
                    ->getStateUsing(fn($record) => $record->opsi_a['teks'] ?? ''),

                Tables\Columns\TextColumn::make('opsi_b')
                    ->label('Opsi B')
                    ->getStateUsing(fn($record) => $record->opsi_b['teks'] ?? ''),

                Tables\Columns\TextColumn::make('opsi_c')
                    ->label('Opsi C')
                    ->getStateUsing(fn($record) => $record->opsi_c['teks'] ?? ''),

                Tables\Columns\TextColumn::make('opsi_d')
                    ->label('Opsi D')
                    ->getStateUsing(fn($record) => $record->opsi_d['teks'] ?? ''),

                Tables\Columns\TextColumn::make('nilai')
                    ->label('Nilai')
                    ->getStateUsing(fn($record) => $record->opsi_a['nilai'] ?? ''),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
}
