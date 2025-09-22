<?php

namespace App\Filament\Resources\Products\Schemas;

use App\Models\Category;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->columns(4),
                Select::make('category_id')
                    ->required()
                    ->options(Category::pluck('name', 'id'))
                    ->columns(3),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('Rp')
                    ->columns(3),
                Textarea::make('about')
                    ->required(),
                FileUpload::make('photo')
                    ->disk('public')
                    ->directory('products')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
