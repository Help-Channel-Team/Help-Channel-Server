<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;


/* @var $this yii\web\View */
/* @var $model app\models\Profile */

$this->title = Yii::t('app','Update Profile: ') . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Profiles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app','Update');
?>
<div class="profile-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
