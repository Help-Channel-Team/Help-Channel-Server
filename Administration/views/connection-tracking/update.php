<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;


/* @var $this yii\web\View */
/* @var $model app\models\ConnectionTracking */

$this->title = Yii::t('app','Update Connection Tracking: ') . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' =>  Yii::t('app','Connection Trackings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app','Update');
?>
<div class="connection-tracking-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
