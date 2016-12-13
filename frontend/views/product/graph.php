<?php
    use \yii2mod\c3\chart\Chart;
?>


<?php

echo Chart::widget([
    'options' => [
        'id' => 'views_chart'
    ],
    'clientOptions' => [
        'data' => [
            'x' => 'x',
            'type' => 'spline',
            'columns' => [
                array_keys($stats),
                array_values($stats),
            ],
            'colors' => [
                'Views' => '#4EB269',
            ],
        ],
        'axis' => [
            'x' => [
                'label' => 'Day',
                'type' => 'timeseries',
                'tick' =>[
                    //'count' => 3,
                    'format' => '%d.%m.%Y',
                ],
            ],
            'y' => [
                'label' => [
                    'text' => 'Views',
                    'position' => 'outer-top'
                ],
                'padding' => ['top' => 0, 'bottom' => 0],
            ]
        ]

    ]
]);


?>

