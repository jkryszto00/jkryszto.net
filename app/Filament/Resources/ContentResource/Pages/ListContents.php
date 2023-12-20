<?php

namespace App\Filament\Resources\ContentResource\Pages;

use App\Enums\ContentTypeEnum;
use App\Filament\Resources\ContentResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListContents extends ListRecords
{
    protected static string $resource = ContentResource::class;

    public function getTabs(): array
    {
        return [
            'all' => Tab::make(),
            'articles' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->whereType(ContentTypeEnum::ARTICLE)),
            'pages' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->whereType(ContentTypeEnum::PAGE)),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
