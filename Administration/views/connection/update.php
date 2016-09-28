<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;


/* @var $this yii\web\View */
/* @var $model app\models\Connection */

$this->title = Yii::t('app','Update Connection: ') . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Connections'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['app', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app','Update');
?>
<div class="connection-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
