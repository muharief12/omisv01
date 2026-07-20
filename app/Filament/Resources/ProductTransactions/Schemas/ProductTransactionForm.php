<?php

namespace App\Filament\Resources\ProductTransactions\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
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
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->required(),
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
                FileUpload::make('proof')
                    ->nullable(),
            ]);
    }
}
