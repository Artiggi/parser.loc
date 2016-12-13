<?php

$this->title = 'Parser';
?>
<?php
if (Yii::$app->session->hasFlash('pars-status')){
    echo Yii::$app->session->getFlash('pars-status');
}

?>
