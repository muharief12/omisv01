<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('icon')
                    ->disk('public') // penting -> arahkan ke storage/app/public
                    ->directory('category_icon')
                    ->visibility('public')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
