<?php

namespace App\Filament\Widgets;

use App\Models\TransactionDetail;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class ProductChart extends ChartWidget
{
    protected ?string $heading = 'Top 5 Product Solds';
    protected static ?int $sort = 4;

    protected function getData(): array
    {
        // Ambil 5 produk paling laku berdasarkan total quantity
        $topProducts = TransactionDetail::select('product_id', DB::raw('SUM(qty) as total_sold'))
            ->with('product')
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->take(5)
            ->get();


        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Terjual',
                    'data' => $topProducts->pluck('total_sold'),
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
            'labels' => $topProducts->pluck('product.name'),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
