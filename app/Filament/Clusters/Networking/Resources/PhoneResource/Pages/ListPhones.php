<?php

namespace App\Filament\Clusters\Networking\Resources\PhoneResource\Pages;

use App\Filament\Clusters\Networking\Resources\PhoneResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPhones extends ListRecords
{
    protected static string $resource = PhoneResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
