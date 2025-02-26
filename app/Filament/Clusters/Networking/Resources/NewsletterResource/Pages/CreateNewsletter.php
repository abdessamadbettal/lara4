<?php

namespace App\Filament\Clusters\Networking\Resources\NewsletterResource\Pages;

use App\Filament\Clusters\Networking\Resources\NewsletterResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateNewsletter extends CreateRecord
{
    protected static string $resource = NewsletterResource::class;
}
