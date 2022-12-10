<?php

namespace App\Charts;
<<<<<<< HEAD
// t2/beta
//
=======
// t2
>>>>>>> bff89ff6d6757f7918a4614a5faaf99339ddbf27
use App\Helpers\CharttHelper;
use ConsoleTVs\Charts\Classes\Highcharts\Chart;

class LatestSales extends Chart
{    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct($period = 15)
    {
        parent::__construct();

        $dates = CharttHelper::Days($period);

        $dates[$period - 1] = trans('app.today');
        $dates[$period - 2] = trans('app.yesterday');

        $this->displayLegend(false)
            ->height(200)->width(0)
            ->labels($dates)
            ->options([
                'yAxis' => [
                    'title' => [
                        'text' => null,
                    ],
                    'labels' => [
                        'align'    => 'right',
                        'format' => config('system_settings.currency.symbol') . '{value}',
                    ],
                ],
                'tooltip' => [
                    'useHTML' => true,
                    'pointFormat' => '<small>{series.name}: <b>' . config('system_settings.currency.symbol') . '{point.y}</b></small>',
                ],
                'credits' => [
                    'enabled' => false,
                ],
            ]);
    }
}
