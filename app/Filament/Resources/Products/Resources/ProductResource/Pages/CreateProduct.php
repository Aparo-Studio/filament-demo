<?php

namespace App\Filament\Resources\Products\Resources\ProductResource\Pages;

use App\Filament\Resources\Products\Resources\ProductResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\LocaleSwitcher::make(),
            // ...
        ];
    }
}
