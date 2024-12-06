<?php

namespace App\Filament\Clusters\Networking\Resources\CommentResource\Pages;

use App\Filament\Clusters\Networking\Resources\CommentResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewComment extends ViewRecord
{
    protected static string $resource = CommentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
