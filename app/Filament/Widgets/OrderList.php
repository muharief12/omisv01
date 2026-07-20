<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\ProductTransactions\ProductTransactionResource;
use App\Models\ProductTransaction;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class OrderList extends TableWidget
{
    protected static ?int $sort = 2;
    public function table(Table $table): Table
    {
        return $table
            ->query(
                ProductTransaction::where('is_paid', false)->orderBy('created_at', 'asc')->take(5)
            )
            ->columns([
                TextColumn::make('code'),
                TextColumn::make('is_paid')
                    ->badge()
                    ->formatStateUsing(fn($state) => $state ? 'Paid' : 'Waiting')
                    ->color(fn($state) => $state ? 'success' : 'warning'),
                TextColumn::make('created_at')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                //
            ])
            ->recordUrl(fn($record) => ProductTransactionResource::getUrl('edit', ['record' => $record]))
            ->recordActions([
                Action::make('edit')
                    ->label('Edit')
                    ->icon('heroicon-o-pencil')
                    ->url(fn($record) => ProductTransactionResource::getUrl('edit', ['record' => $record])),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ]),
            ]);
    }
}
