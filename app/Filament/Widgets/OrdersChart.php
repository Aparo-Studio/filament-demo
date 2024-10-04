<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class OrdersChart extends ChartWidget
{
    protected static ?int $sort = 1;

    protected function getType(): string
    {
        return 'line';
    }

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => __('dashboard.orders_label'),
                    'data' => [2433, 3454, 4566, 3300, 5545, 5765, 6787, 8767, 7565, 8576, 9686, 8996],
                    'fill' => 'start',
                ],
            ],
            'labels' => [
                __('months.jan'),
                __('months.feb'),
                __('months.mar'),
                __('months.apr'),
                __('months.may'),
                __('months.jun'),
                __('months.jul'),
                __('months.aug'),
                __('months.sep'),
                __('months.oct'),
                __('months.nov'),
                __('months.dec'),
            ],
        ];
    }

    public function getHeading(): ?string
    {
        return __('dashboard.orders_per_month');
    }
}
