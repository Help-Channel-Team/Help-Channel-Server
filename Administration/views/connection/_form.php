<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DateTimePicker;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;
use kartik\select2\Select2; 


/* @var $this yii\web\View */
/* @var $model app\models\Connection */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="connection-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'creation_date')->widget ( DateTimePicker::classname (), [ 'options' => [ 'placeholder' => 'Enter date ...' ],'type' => DateTimePicker::TYPE_COMPONENT_APPEND,'pluginOptions' => [ 'todayBtn' => true, 'format' => 'yyyy-mm-dd hh:ii:ss', 'autoclose' => true ] ] ); ?>

    <?= $form->field($model, 'modification_date')->widget ( DateTimePicker::classname (), [ 'options' => [ 'placeholder' => 'Enter date ...' ],'type' => DateTimePicker::TYPE_COMPONENT_APPEND,'pluginOptions' => [ 'todayBtn' => true, 'format' => 'yyyy-mm-dd hh:ii:ss', 'autoclose' => true ] ] ); ?>

    <?= $form->field($model, 'start_date')->widget ( DateTimePicker::classname (), [ 'options' => [ 'placeholder' => 'Enter date ...' ],'type' => DateTimePicker::TYPE_COMPONENT_APPEND,'pluginOptions' => [ 'todayBtn' => true, 'format' => 'yyyy-mm-dd hh:ii:ss', 'autoclose' => true ] ] ); ?>

    <?= $form->field($model, 'end_date')->widget ( DateTimePicker::classname (), [ 'options' => [ 'placeholder' => 'Enter date ...' ],'type' => DateTimePicker::TYPE_COMPONENT_APPEND,'pluginOptions' => [ 'todayBtn' => true, 'format' => 'yyyy-mm-dd hh:ii:ss', 'autoclose' => true ] ] ); ?>

    <?= $form->field($model, 'connection_code')->textInput(['maxlength' => 255]) ?>

	<div class="form-group">
	    <label>Usuario</label>
	    <?= Select2::widget([
							'model' => $model,
							'attribute' => 'user_id',
							'data' => ArrayHelper::map(\app\models\User::find()->all(), 'id', 'username'),
							'options' => ['placeholder' => 'Select ...'],
							'pluginOptions' => [
							'allowClear' => true
							],
					]); ?>
	</div>
	<div class="form-group">
		<label>T&eacute;cnico</label>
	    <?= Select2::widget([
							'model' => $model,
							'attribute' => 'technician_id',
							'data' => ArrayHelper::map(\app\models\User::find()->all(), 'id', 'username'),
							'options' => ['placeholder' => 'Select ...'],
							'pluginOptions' => [
							'allowClear' => true
							],
					]); ?>
	</div>
	<div class="form-group">
		<label>Estado</label>
	    <?= Select2::widget([
							'model' => $model,
							'attribute' => 'status_id',
							'data' => ArrayHelper::map(\app\models\Status::find()->all(), 'id', 'name'),
							'options' => ['placeholder' => 'Select ...'],
							'pluginOptions' => [
							'allowClear' => true
							],
					]); ?>
	</div>
	<div class="form-group">
		<label>Creador</label>
	    <?= Select2::widget([
							'model' => $model,
							'attribute' => 'creator_id',
							'data' => ArrayHelper::map(\app\models\User::find()->all(), 'id', 'username'),
							'options' => ['placeholder' => 'Select ...'],
							'pluginOptions' => [
							'allowClear' => true
							],
					]); ?>
	</div>

	<div class="row">
	    <div class="form-group text-right">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app','Create') : Yii::t('app','Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
