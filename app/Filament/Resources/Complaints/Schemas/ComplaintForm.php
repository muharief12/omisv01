<?php

namespace App\Filament\Resources\Complaints\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ComplaintForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('product_transaction_id')
                    ->required()
                    ->numeric(),
                TextInput::make('title')
                    ->required(),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('attachment')
                    ->disk('public')
                    ->directory('complaint_attachment')
                    ->default(null),
                Select::make('status')
                    ->options([
                        'submission' => 'Submission',
                        'progress' => 'Progress',
                        'resolved' => 'Resolved',
                        'closed' => 'Closed',
                    ])
                    ->default('submission')
                    ->required(),
                Textarea::make('response_note')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
