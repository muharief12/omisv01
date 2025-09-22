<?php

namespace App\Filament\Resources\AdminFees\Pages;

use App\Filament\Resources\AdminFees\AdminFeeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAdminFee extends EditRecord
{
    protected static string $resource = AdminFeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
