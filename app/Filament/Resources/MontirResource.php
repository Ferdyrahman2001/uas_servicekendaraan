<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MontirResource\Pages;
use App\Models\Montir;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

class MontirResource extends Resource
{
    protected static ?string $model = Montir::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nomor')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('gender')
                    ->required()
                    ->options([
                        'L' => 'Laki-laki',
                        'P' => 'Perempuan',
                    ]),
                Forms\Components\DatePicker::make('tgl_lahir')
                    ->required(),
                Forms\Components\TextInput::make('tmp_lahir')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('keahlian')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('kategori_montir_id')
                    ->label('Kategori Montir')
                    ->required()
                    ->options(\App\Models\KategoriMontir::pluck('nama', 'id'))
                    ->searchable(),
                Forms\Components\FileUpload::make('foto')
                    ->label('Foto')
                    ->disk('public')
                    ->directory('montir')
                    ->image()
                    ->imagePreviewHeight('100')
                    ->maxSize(2048)
                    ->acceptedFileTypes(['image/*'])
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nomor')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('gender')
                    ->label('Gender')
                    ->formatStateUsing(fn ($state) => $state === 'L' ? 'Laki-Laki' : 'Perempuan'),
                Tables\Columns\TextColumn::make('tgl_lahir')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tmp_lahir')
                    ->searchable(),
                Tables\Columns\TextColumn::make('keahlian')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kategoriMontir.nama')
                    ->label('Kategori Montir')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\ImageColumn::make('foto') // nama kolom di database
                    ->label('Foto')
                    ->disk('public') // sesuai disk di config/filesystems.php
                    ->defaultImageUrl(asset('img/user.png'))
                    ->height(50)
                    ->width(50)
                    ->circular(), // opsional: tampilkan sebagai lingkaran
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->recordUrl(fn($record): ?string => null)
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
            'index' => Pages\ListMontirs::route('/'),
            'create' => Pages\CreateMontir::route('/create'),
            'edit' => Pages\EditMontir::route('/{record}/edit'),
        ];
    }

    //* Authorization
    static function can(string $action, ?Model $record = null): bool
    {
        $user = Auth::user();

        if (!$user) return false;

        return match ($action) {
            'viewAny', 'view' => in_array($user->role, ['admin', 'manager']),
            'create', 'update', 'delete' => in_array($user->role, ['admin', 'manager']),
            default => parent::can($action, $record),
        };
    }
}
