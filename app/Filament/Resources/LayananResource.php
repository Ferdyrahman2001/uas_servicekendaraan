<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LayananResource\Pages;
use App\Filament\Resources\LayananResource\RelationManagers;
use App\Models\Layanan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class LayananResource extends Resource
{
    protected static ?string $model = Layanan::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('kode')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('deskripsi')
                    ->maxLength(255),
                Forms\Components\TextInput::make('nomor_polisi')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('foto_kendaraan')
                    ->image()
                    ->directory('foto_kendaraan')
                    ->maxSize(2048) // 2MB
                    ->acceptedFileTypes(['image/*'])
                    ->required(),
                Forms\Components\Select::make('jenis_kendaraan')
                    ->required()
                    ->options([
                        'motor' => 'Motor',
                        'mobil' => 'Mobil',
                    ]),
                Forms\Components\Select::make('status')
                    ->required()
                    ->live()
                    ->options([
                        'pending' => 'Pending',
                        'proses' => 'Proses',
                        'selesai' => 'Selesai',
                        'batal' => 'Batal',
                    ]),
                Forms\Components\TextInput::make('jumlah_bayar')
                    ->required(fn($get) => $get('status') === 'selesai')
                    ->numeric()
                    ->visible(fn($get) => $get('status') === 'selesai'),
                Forms\Components\TextInput::make('total_biaya')
                    ->required(fn($get) => $get('status') === 'selesai')
                    ->numeric()
                    ->default(0.00)
                    ->visible(fn($get) => $get('status') === 'selesai'),
                Forms\Components\TextInput::make('rating')
                    ->required(fn($get) => $get('status') === 'selesai')
                    ->numeric()
                    ->default(0)
                    ->visible(fn($get) => $get('status') === 'selesai'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kode')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('deskripsi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nomor_polisi')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('foto_kendaraan')
                    ->circular()
                    ->limit(3),
                Tables\Columns\TextColumn::make('jenis_kendaraan')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->sortable(),
                Tables\Columns\TextColumn::make('jumlah_bayar')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_biaya')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('rating')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('id')
                    ->label('Detail')
                    ->formatStateUsing(function ($state, $record) {
                        return '<a href="/admin/detail-layanans/create?layanan_id=' . $record->id . '" class="text-primary underline">Tambah Detail</a>';
                    })
                    ->html(),
                    // TODO: Lanjutkan disini
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
            'index' => Pages\ListLayanans::route('/'),
            'create' => Pages\CreateLayanan::route('/create'),
            'edit' => Pages\EditLayanan::route('/{record}/edit'),
        ];
    }

    //* Authorization
    static function can(string $action, ?\Illuminate\Database\Eloquent\Model $record = null): bool
    {
        $user = Auth::user();

        if (!$user) return false;

        // Allow all
        return $user && true;
    }
}
