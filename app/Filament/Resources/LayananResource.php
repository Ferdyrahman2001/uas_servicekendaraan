<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LayananResource\Pages;
use App\Filament\Resources\LayananResource\RelationManagers;
use App\Models\Layanan;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TextInput\Mask;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Number;

class LayananResource extends Resource
{
    protected static ?string $model = Layanan::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('kode')
                    ->required()
                    ->unique(ignoreRecord: true),

                TextInput::make('nama')
                    ->required(),

                TextInput::make('deskripsi'),

                TextInput::make('nomor_polisi')
                    ->required(),

                FileUpload::make('foto_kendaraan')
                    ->image()
                    ->directory('foto_kendaraan')
                    ->required(),

                Select::make('jenis_kendaraan')
                    ->options([
                        'motor' => 'Motor',
                        'mobil' => 'Mobil',
                    ])
                    ->required(),

                // Repeater for detail layanan
                Repeater::make('detailLayanans')
                    ->relationship()
                    ->schema([
                        TextInput::make('pekerjaan')
                            ->required(),

                        TextInput::make('biaya')
                            ->numeric()
                            ->default(0)
                            ->required(),

                        Select::make('montir_id')
                            ->label('Montir')
                            ->relationship('montir', 'nama')
                            ->searchable()
                            ->preload()
                            ->required(),
                    ])
                    ->columnSpanFull()
                    ->columns(3)
                    ->label('Detail Layanan')
                    ->addActionLabel('Tambah Detail Layanan')
                    ->afterStateUpdated(function ($state, callable $set) {
                        $total = collect($state)->sum(function ($item) {
                            return $item['biaya'] ?? 0;
                        });
                        $set('total_biaya', $total);
                    })
                    ->live(debounce: 500),

                TextInput::make('total_biaya')
                    ->disabled()
                    ->dehydrated()
                    ->default(0)
                    ->prefix('Rp'),

                TextInput::make('jumlah_bayar')
                    ->numeric()
                    ->default(0)
                    ->required()
                    ->prefix('Rp')
                    ->rules([
                        function ($get) {
                            return function (string $attribute, $value, $fail) use ($get) {
                                $totalBiaya = (float) str_replace(',', '', $get('total_biaya'));
                                if ((float) $value < $totalBiaya) {
                                    $fail('Jumlah bayar harus lebih besar atau sama dengan total biaya.');
                                }
                            };
                        }
                    ])
                    ->live(),

                Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'proses' => 'Proses',
                        'selesai' => 'Selesai',
                        'batal' => 'Batal',
                    ])
                    ->default('pending')
                    ->live()
                    ->afterStateUpdated(function ($state, Set $set) {
                        if ($state !== 'selesai') $set('rating', 0);
                    }),

                TextInput::make('rating')
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(5)
                    ->default(0)
                    ->required()
                    ->visible(fn($get) => $get('status') === 'selesai')

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(
                Layanan::query()
                    ->withCount('detailLayanans') // Preload count
                    ->with(['detailLayanans', 'detailLayanans.montir']) // Preload relationships
            )
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
                Tables\Columns\TextColumn::make('detail_layanans_count')
                    ->label('Details')
                    ->badge()
                    ->color('primary')
                    ->sortable()
                    ->url(fn($record): string => route('filament.admin.resources.detail-layanans.index', [
                        'tableFilters' => [
                            'layanan_id' => ['layanan_id' => $record->id],
                        ],
                    ])),
                Tables\Columns\TextColumn::make('total_biaya')
                    ->numeric()
                    ->money('IDR')
                    ->color('danger')
                    ->sortable(),
                Tables\Columns\TextColumn::make('jumlah_bayar')
                    ->numeric()
                    ->money('IDR')
                    ->color('success')
                    ->sortable(),
                Tables\Columns\TextColumn::make('rating')
                    ->numeric()
                    ->sortable()
                    ->color(fn($state) => match (true) {
                        $state >= 4 => 'success',
                        $state >= 3 => 'warning',
                        $state > 0  => 'danger',
                        default     => null,
                    }),
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
