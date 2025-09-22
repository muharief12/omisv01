<?php

namespace App\Filament\Resources\AdminFees\Schemas;

use App\Models\User;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class AdminFeeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Hidden::make('user_id')
                    ->default(Auth::id()) // ini yang disimpan ke DB
                    ->required(),
                TextInput::make('tax')
                    ->required()
                    ->numeric(),
                TextInput::make('delivery')
                    ->required()
                    ->numeric(),
                TextInput::make('insurance')
                    ->required()
                    ->numeric(),
                Toggle::make('is_active')
                    ->required(),
                FileUpload::make('logo')
                    ->disk('public')
                    ->directory('logo')
                    ->visibility('public')
                    ->columnSpanFull(),
            ]);
    }
}
