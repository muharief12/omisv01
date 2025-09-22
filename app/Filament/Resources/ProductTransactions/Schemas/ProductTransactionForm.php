<?php

namespace App\Filament\Resources\ProductTransactions\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProductTransactionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                TextInput::make('total_amount')
                    ->required()
                    ->numeric(),
                Toggle::make('is_paid')
                    ->required(),
                TextInput::make('address')
                    ->required(),
                TextInput::make('city')
                    ->required(),
                TextInput::make('postal_code')
                    ->required(),
                TextInput::make('phone_number')
                    ->tel()
                    ->required(),
                Textarea::make('notes')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('proof')
                    ->required(),
            ]);
    }
}
