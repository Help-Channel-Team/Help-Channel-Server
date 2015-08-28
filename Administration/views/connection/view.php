<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Connection */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Connections'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="connection-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'creation_date',
            'modification_date',
            'start_date',
            'end_date',
            'connection_code',
            'user_id',
            'technician_id',
            'status_id',
            'creator_id',
        ],
    ]) ?>

</div>
