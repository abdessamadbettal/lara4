<?php

namespace App\Filament\Clusters\Networking\Resources\CommentResource\Pages;

use App\Filament\Clusters\Networking\Resources\CommentResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateComment extends CreateRecord
{
    protected static string $resource = CommentResource::class;
}
