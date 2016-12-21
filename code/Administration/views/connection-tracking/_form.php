<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use kartik\widgets\DateTimePicker;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;
use kartik\select2\Select2; 


/* @var $this yii\web\View */
/* @var $model app\models\ConnectionTracking */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="connection-tracking-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'creation_date')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'modification_date')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'connection_id')->widget(Select2::classname() , [
							'data' => ArrayHelper::map(\app\models\Connection::find()->all(), 'id', 'id'),
							'options' => ['placeholder' => 'Select ...'],
							'pluginOptions' => [
							'allowClear' => true
						],
				]); ?>

    <?= $form->field($model, 'creator_id')->widget(Select2::classname() , [
							'data' => ArrayHelper::map(\app\models\User::find()->all(), 'id', 'username'),
							'options' => ['placeholder' => 'Select ...'],
							'pluginOptions' => [
							'allowClear' => true
						],
				]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
