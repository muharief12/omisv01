<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Products\ProductResource;
use App\Models\Product;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class WarningStock extends TableWidget
{
    protected static ?int $sort = 3;
    public function table(Table $table): Table
    {
        return $table
            ->query(
                Product::where('stock', '<=', 10)->orderBy('stock', 'asc')->take(5)
            )
            ->columns([
                ImageColumn::make('photo')
                    ->disk('public'),
                TextColumn::make('name'),
                TextColumn::make('safety_stock'),
                TextColumn::make('stock'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                //
            ])
            ->recordUrl(fn($record) => ProductResource::getUrl('edit', ['record' => $record]))
            ->recordActions([
                Action::make('edit')
                    ->label('Edit')
                    ->icon('heroicon-o-pencil')
                    ->url(fn($record) => ProductResource::getUrl('edit', ['record' => $record])),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ]),
            ]);
    }
}
