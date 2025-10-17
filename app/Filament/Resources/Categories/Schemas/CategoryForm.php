<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Storage;

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
                    ->afterStateUpdated(function ($state, $component, $record) {
                        // Pastikan kita sedang dalam mode edit, bukan create
                        if (!$record) return;
                        if ($record && $record->icon && $record->icon !== $state) {
                            // Hapus file lama dari storage
                            if (Storage::disk('public')->exists($record->icon)) {
                                Storage::disk('public')->delete($record->icon);
                            }
                        }
                    })
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
