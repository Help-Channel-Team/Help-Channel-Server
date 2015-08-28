<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;



/* @var $this yii\web\View */
/* @var $model app\models\Connection */

$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Connections'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app',$this->title);
?>
<div class="connection-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
