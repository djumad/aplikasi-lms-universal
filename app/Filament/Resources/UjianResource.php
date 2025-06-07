<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UjianResource\Pages;
use App\Filament\Resources\UjianResource\RelationManagers;
use App\Filament\Resources\UjianResource\RelationManagers\SoalEsaiRelationManager;
use App\Filament\Resources\UjianResource\RelationManagers\SoalPilihanGandaRelationManager;
use App\Models\Ujian;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class UjianResource extends Resource
{
    protected static ?string $model = Ujian::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id' , Auth::user()->id);
    }
    
    public static function canViewAny() : bool{
        return Auth::user()->role === "guru";
    }
    
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Hidden::make('user_id')
                    ->default(Auth::id()),
                Forms\Components\TextInput::make('judul')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('Deskripsi')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('jenis')
                    ->options([
                        'UTS' => 'UTS',
                        'UAS' => 'UAS'
                    ])
                    ->required(),
                Forms\Components\DateTimePicker::make('jam_mulai')
                    ->required(),
                Forms\Components\DateTimePicker::make('jam_selesai')
                    ->required(),
                Forms\Components\Select::make('kelas')
                    ->label('Kelas')
                    ->multiple()
                    ->relationship(
                        name: 'kelas',
                        titleAttribute: 'nama',
                        modifyQueryUsing: fn(Builder $query) => $query->whereHas('user', function ($q) {
                            $q->where('users.id', Auth::id());
                        })
                    )
                    ->preload()
                    ->searchable()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('judul')
                    ->searchable(),
                Tables\Columns\TextColumn::make('Deskripsi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('jenis')
                    ->searchable(),
                Tables\Columns\TextColumn::make('jam_mulai')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jam_selesai')
                    ->dateTime()
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
                Tables\Actions\EditAction::make(),
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
            SoalPilihanGandaRelationManager::class,
            SoalEsaiRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUjians::route('/'),
            'create' => Pages\CreateUjian::route('/create'),
            'edit' => Pages\EditUjian::route('/{record}/edit'),
        ];
    }
}
