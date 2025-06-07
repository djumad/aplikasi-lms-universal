<?php

// app/Filament/Resources/TugasResource.php

namespace App\Filament\Resources;

use App\Filament\Resources\TugasResource\Pages;
use App\Models\Tugas;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class TugasResource extends Resource
{
    protected static ?string $model = Tugas::class;

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
                Forms\Components\TextInput::make('judul')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Textarea::make('deskripsi')
                    ->required(),

                Forms\Components\DatePicker::make('deadline')
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

                Forms\Components\Hidden::make('user_id')
                    ->default(fn()=> Auth::id()),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('judul')->searchable(),
                Tables\Columns\TextColumn::make('deskripsi')->limit(50),
                Tables\Columns\TextColumn::make('deadline'),
                Tables\Columns\TextColumn::make('user.name')->label('Dibuat oleh'),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTugas::route('/'),
            'create' => Pages\CreateTugas::route('/create'),
            'edit' => Pages\EditTugas::route('/{record}/edit'),
        ];
    }
}
