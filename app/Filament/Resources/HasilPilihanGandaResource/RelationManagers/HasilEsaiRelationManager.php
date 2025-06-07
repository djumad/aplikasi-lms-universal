<?php

namespace App\Filament\Resources\HasilPilihanGandaResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class HasilEsaiRelationManager extends RelationManager
{
    protected static string $relationship = 'HasilEsai';
    
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->whereHas('ujian' , function ($query){
            $query->where('user_id' , Auth::user()->id);
        });
    }
    public static function canViewAny() : bool{
        return Auth::user()->role === "guru";
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nilai')
                    ->numeric()
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('jawaban')
            ->columns([
                Tables\Columns\TextColumn::make('jawaban'),
                Tables\Columns\TextColumn::make('nilai'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Input Nilai'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
