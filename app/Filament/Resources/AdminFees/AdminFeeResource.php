<?php

namespace App\Filament\Resources\AdminFees;

use App\Filament\Resources\AdminFees\Pages\CreateAdminFee;
use App\Filament\Resources\AdminFees\Pages\EditAdminFee;
use App\Filament\Resources\AdminFees\Pages\ListAdminFees;
use App\Filament\Resources\AdminFees\Schemas\AdminFeeForm;
use App\Filament\Resources\AdminFees\Tables\AdminFeesTable;
use App\Models\AdminFee;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class AdminFeeResource extends Resource
{
    protected static ?string $model = AdminFee::class;
    protected static ?int $navigationSort = 80;
    protected static string | UnitEnum | null $navigationGroup = 'Policy Management';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::CurrencyDollar;

    protected static ?string $recordTitleAttribute = 'Admin Fee';

    public static function form(Schema $schema): Schema
    {
        return AdminFeeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AdminFeesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAdminFees::route('/'),
            'create' => CreateAdminFee::route('/create'),
            'edit' => EditAdminFee::route('/{record}/edit'),
        ];
    }
}
