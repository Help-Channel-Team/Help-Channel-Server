<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;



/* @var $this yii\web\View */
/* @var $model app\models\Profile */
$this->title = Yii::t('app','Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Profiles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
