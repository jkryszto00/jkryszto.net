<?php

namespace App\Filament\Resources;

use App\Enums\ContentStatusEnum;
use App\Enums\ContentTypeEnum;
use App\Filament\Resources\ContentResource\Pages;
use App\Filament\Resources\ContentResource\RelationManagers;
use App\Models\Content;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContentResource extends Resource
{
    protected static ?string $model = Content::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(3)->schema([
                    Forms\Components\Section::make('Content')->schema([
                        Forms\Components\TextInput::make('label'),
                        Forms\Components\RichEditor::make('content')
                    ])->columnSpan(2),
                    Forms\Components\Section::make('Options')->schema([
                        Forms\Components\Select::make('type')->options(ContentTypeEnum::labels())->native(false),
                        Forms\Components\Select::make('status')->options(ContentStatusEnum::labels())->native(false)
                    ])->columnSpan(1)
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('label'),
                Tables\Columns\TextColumn::make('type')->formatStateUsing(fn (ContentTypeEnum $state): string => ucfirst($state->value)),
                Tables\Columns\TextColumn::make('status')->formatStateUsing(fn (ContentStatusEnum $state): string => ucfirst($state->value)),
                Tables\Columns\TextColumn::make('updated_at'),
                Tables\Columns\TextColumn::make('created_at')
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListContents::route('/'),
            'create' => Pages\CreateContent::route('/create'),
            'edit' => Pages\EditContent::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
