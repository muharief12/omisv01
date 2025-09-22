<?php

namespace App\Filament\Resources\PostTypes\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PostTypeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
            ]);
    }
}
