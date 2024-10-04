<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class CustomersChart extends ChartWidget
{
    protected static ?int $sort = 2;

    protected function getType(): string
    {
        return 'line';
    }

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => __('dashboard.customers_label'),
                    'data' => [4344, 5676, 6798, 7890, 8987, 9388, 10343, 10524, 13664, 14345, 15753, 17332],
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
        return __('dashboard.total_customers');
    }
}
