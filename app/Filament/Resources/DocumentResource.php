<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Drawer;
use App\Models\Folder;
use Filament\Forms\Get;
use Filament\Forms\Set;
use App\Models\Document;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Illuminate\Support\Collection;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\DocumentResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\DocumentResource\RelationManagers;
use App\Filament\Resources\DocumentResource\RelationManagers\AttachmentsRelationManager;

class DocumentResource extends Resource
{
    protected static ?string $model = Document::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('control')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\DatePicker::make('date_received')
                            ->required(),
                        // Select::make('drawer_id')
                        //     ->options(Drawer::query()->pluck('name', 'id'))
                        //     ->reactive(),
                        // Select::make('folder_id')
                        //     ->options(fn (Get $get): Collection => Folder::query()
                        //         ->where('drawer_id', $get('drawer_id'))
                        //         ->pluck('name', 'id')),

                        Select::make('drawer_id')
                            ->searchable()

                            ->options(Drawer::query()->pluck('name', 'id'))
                            ->afterStateUpdated(fn (Set $set) => dd('state updated'))
                            ->live()
                            ->preload(),

                        Select::make('folder_id')
                            ->searchable()
                            ->getSearchResultsUsing(fn (Get $get): array => dd($get('drawer_id')))
                            ->getOptionLabelUsing(fn ($value): ?string => Folder::find($value)?->name),

                        Forms\Components\Textarea::make('description')
                            ->required()
                            ->maxLength(65535)
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('personnel')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Toggle::make('is_public')
                            ->inline(false)
                            ->default(0),
                    ])->columns(['default' => 2])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('control')
                    ->searchable(),
                Tables\Columns\TextColumn::make('folder.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('folder.drawer.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_public')
                    ->boolean(),
                Tables\Columns\TextColumn::make('date_received')
                    ->date()
                    ->label('Date')
                    ->sortable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('Description')
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
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            AttachmentsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDocuments::route('/'),
            'create' => Pages\CreateDocument::route('/create'),
            'edit' => Pages\EditDocument::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['control', 'description'];
    }

    public static function getGlobalSearchResultDetails($model): array
    {
        return [
            'Control' => $model->control,
            'Folder' => $model->folder->name,
        ];
    }
}
