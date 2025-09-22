<?php

namespace App\Filament\Resources\AdminFees\Pages;

use App\Filament\Resources\AdminFees\AdminFeeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAdminFees extends ListRecords
{
    protected static string $resource = AdminFeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
