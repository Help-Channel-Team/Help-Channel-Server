<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;



/* @var $this yii\web\View */
/* @var $model app\models\ConnectionTracking */

$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Connection Trackings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app',$this->title);
?>
<div class="connection-tracking-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
