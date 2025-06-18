<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KategoriMontirResource\Pages;
use App\Filament\Resources\KategoriMontirResource\RelationManagers;
use App\Models\KategoriMontir;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KategoriMontirResource extends Resource
{
    protected static ?string $model = KategoriMontir::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationLabel(): string
    {
        return 'Kategori Montir';
    }
    public static function getNavigationGroup(): ?string
    {
        return 'Master Data';
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->searchable(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKategoriMontirs::route('/'),
            'create' => Pages\CreateKategoriMontir::route('/create'),
            'edit' => Pages\EditKategoriMontir::route('/{record}/edit'),
        ];
    }

    //* Authorization
    static function can(string $action, ?\Illuminate\Database\Eloquent\Model $record = null): bool
    {
        $user = \Illuminate\Support\Facades\Auth::user();

        if (!$user) return false;

        // Allow all
        return $user && $user->role === 'admin';
    }
}
