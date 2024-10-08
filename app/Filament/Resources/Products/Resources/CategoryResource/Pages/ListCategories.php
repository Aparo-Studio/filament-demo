<?php

namespace App\Filament\Resources\Products\Resources\CategoryResource\Pages;

use App\Filament\Imports\Shop\CategoryImporter;
use App\Filament\Resources\Products\Resources\CategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCategories extends ListRecords
{
    protected static string $resource = CategoryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\ImportAction::make()
                ->importer(CategoryImporter::class),
            Actions\CreateAction::make(),
        ];
    }
}
