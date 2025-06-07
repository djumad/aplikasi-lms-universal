<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HasilTugasSiswaResource\Pages;
use App\Filament\Resources\HasilTugasSiswaResource\RelationManagers;
use App\Models\HasilTugasSiswa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class HasilTugasSiswaResource extends Resource
{
    protected static ?string $model = HasilTugasSiswa::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->whereHas('tugas' , function ($query){
            $query->where('user_id' , Auth::user()->id);
        });
    }
    public static function canViewAny() : bool{
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
                Forms\Components\TextInput::make('nilai')
                    ->numeric()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Nama Siswa')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tugas.judul')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('file_tugas')
                    ->formatStateUsing(fn() => 'Lihat Jawaban')
                    ->url(fn($record) => "/storage/$record->file_tugas")
                    ->searchable(),
                Tables\Columns\TextColumn::make('nilai')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Input Nilai')
                    ->modalHeading('Input Nilai')
                    ->form([
                        Forms\Components\TextInput::make('nilai')
                            ->label('Nilai')
                            ->required()
                            ->numeric(),
                    ]),

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
            'index' => Pages\ListHasilTugasSiswas::route('/'),
        ];
    }
}
