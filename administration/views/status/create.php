<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;



/* @var $this yii\web\View */
/* @var $model app\models\Status */

$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Status'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app','$this->title');
?>
<div class="status-create">

    <h1><?= Html::encode(Yii::t('app','$this->title')) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
