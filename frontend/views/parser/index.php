<?php

use yii\widgets\ActiveForm;

$this->title = 'Parser';
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
<?php
    if (Yii::$app->session->hasFlash('upl-status')){
        echo Yii::$app->session->getFlash('upl-status');
    }
?>

<?= $form->field($model, 'xmlFile')->fileInput() ?>

<button>Submit</button>

<?php ActiveForm::end() ?>
