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
            'type' => 'bar',
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
                'type' => 'category'
            ],
            'y' => [
                'label' => [
                    'text' => 'Views',
                    'position' => 'outer-top'
                ],
                'min' => 0,
                'max' => 40,
                'padding' => ['top' => 0, 'bottom' => 0]
            ]
        ]
    ]
]);


?>

