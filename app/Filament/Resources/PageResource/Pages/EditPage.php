<?php

namespace App\Filament\Resources\PageResource\Pages;

use App\Filament\Resources\PageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Log;

class EditPage extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = PageResource::class;

    public function afterStateUpdated(string $statePath, $state)
    {
        Log::info('State updated for ' . $statePath, $state);
    }

    public function beforeSave()
    {
        Log::info('Données avant sauvegarde:', $this->form->getState());
    }


    protected function getActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
