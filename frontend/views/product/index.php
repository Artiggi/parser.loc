<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\StringHelper;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'product_id',

            [
                'attribute'=>'title',
                'format' => 'html',
                'label' => 'Наименование',
                'value'=>function($model){
                    return Html::a($model->title, ['product/view', 'id' => $model->id]);
                },
            ],

            [
                'attribute'=>'description',
                'label' => 'Описание',
                'value'=>function($model){
                    return StringHelper::truncate($model->description, 50);
                },
            ],
            'price',
            [
                'attribute' => 'image',
                'format' => 'html',
                'label' => 'Изображение',
                'value'=>function($model){
                    return Html::a(Html::img($model->image,[
                        'alt'=>'yii2 - картинка в gridview',
                        'style' => 'width:100px;'
                    ]),
                        ['product/view', 'id' => $model->id]);
                },
            ],

            [
                'attribute'=>'rating',
                'label' => 'Рейтинг',
                'value'=>function($model){
                    switch (true){
                        case $model->rating <= 3:
                            return 'плохо';
                        case $model->rating <= 4:
                            return 'хорошо';
                        case $model->rating <=5:
                            return 'отлично';
                    }
                },
            ],

            [
                'label' => 'График',
                'format' => 'html',
                'value' => function($model){
                    return Html::a('>>', ['product/graph', 'id' => $model->id]);
                },
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>
</div>
