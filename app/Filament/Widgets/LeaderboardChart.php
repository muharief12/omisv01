<?php

namespace App\Filament\Widgets;

use App\Models\ProductTransaction;
use App\Models\TransactionDetail;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class LeaderboardChart extends ChartWidget
{
    protected ?string $heading = 'Leaderboard Chart';
    protected static ?int $sort = 5;

    protected function getData(): array
    {
        // Ambil data 5 user dengan total point tertinggi
        $leaderboard = ProductTransaction::select(
            DB::raw('SUM(point) as total_points'),
            'user_id'
        )
            ->with('user')
            ->groupBy('user_id')
            ->orderByDesc('total_points')
            ->take(5)
            ->get();


        return [
            'datasets' => [
                [
                    'label' => 'Total Point',
                    'data' => $leaderboard->pluck('total_points'),
                    'backgroundColor' => [
                        '#3b82f6', // biru
                        '#22c55e', // hijau
                        '#facc15', // kuning
                        '#ef4444', // merah
                        '#a855f7', // ungu
                    ],
                    'borderRadius' => 8,
                ],
            ],
            'labels' => $leaderboard->pluck('user.name') ?? 'unknown',
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
