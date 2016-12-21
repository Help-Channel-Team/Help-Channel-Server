<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use kartik\widgets\DateTimePicker;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;
use kartik\select2\Select2; 


/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'ldap_username')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'access_token')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'auth_key')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'profile_id')->widget(Select2::classname() , [
							'data' => ArrayHelper::map(\app\models\Profile::find()->all(), 'id', 'name'),
							'options' => ['placeholder' => 'Select ...'],
							'pluginOptions' => [
							'allowClear' => true
						],
				]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app','Create') : Yii::t('app','Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
