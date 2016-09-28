<?php
use yii\helpers\Html;
use yii\grid\GridView;
use kartik\dynagrid\DynaGrid;
use kartik\export\ExportMenu;
use yii\helpers\BaseUrl;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;

error_reporting ( E_ERROR );

/* @var $this yii\web\View */
$this->title = Yii::t('app','Dashboard');

?>
<div class="site-index">

	<div class="body-content">
		<div class="row">
			<div class="col-xs-12 col-sm-7" id="connections-requested">
				<h3><span class="glyphicon glyphicon-hourglass spin"></span> <?php  echo Yii::t('app','Loading requests for assistance, please wait');?> ...</h3>
			</div>
			<div class="col-xs-12 col-sm-5" id="connections-pending">
			</div>
		</div>
	</div>
</div>