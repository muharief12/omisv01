<?php

namespace App\Filament\Widgets;

use App\Models\ProductTransaction;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $customers = User::count();
        $trxs = ProductTransaction::count();
        $maxPoint = User::withSum('transactions', 'point')
            ->orderByDesc('transactions_sum_point')
            ->first()?->transactions_sum_point ?? 0;
        return [
            Stat::make('Customers', $customers)
                // ->description('12% increase')
                // ->descriptionIcon('heroicon-s-trending-up')
                ->color('info')
                ->extraAttributes([
                    'class' => 'border-l-4 border-green-500 rounded-lg shadow-sm p-3',
                ]),
            Stat::make('Transactions', $trxs)
                // ->description('8% decrease')
                // ->descriptionIcon('heroicon-s-trending-down')
                ->color('purple'),
            Stat::make('Max Point', $maxPoint)
                // ->description('5% increase')
                // ->descriptionIcon('heroicon-s-trending-up')
                ->color('black'),
        ];
    }
}
