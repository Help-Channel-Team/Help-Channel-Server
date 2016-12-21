<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\dynagrid\DynaGrid;
use kartik\export\ExportMenu;
use yii\helpers\BaseUrl;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ConnectionTrackingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title =  Yii::t('app','Connection Trackings');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="connection-tracking-index">

    <h1><?= Html::encode($this->title) ?></h1>
  



    <?php 

		$gridColumns = [
            'id',
            'creation_date',
            'modification_date',
            'description:html', 
            			[ 
						
						'class' => 'kartik\grid\ActionColumn',
								'template' => '{view}{update}{delete}',
								'dropdown' => false,
								'buttons' => [
										'view' => function ($url, $model) {
											return Html::button ( '<i class="glyphicon glyphicon-eye-open"></i>', [
													'value' => Url::to ( [$url] ),
													'class' => 'btn btn-default modalButton'
											] );
										},
										'update' => function ($url, $model) {
										return Html::button ( '<i class="glyphicon glyphicon-pencil"></i>', [
												'value' => Url::to ( [$url] ),
												'class' => 'btn btn-default modalButton'
										] );
										}
								],
								'deleteOptions' => [ 
										'title' => 'Delete',
										'data-toggle' => 'tooltip',
										'class' => 'btn btn-default'
								],
 								'order' => DynaGrid::ORDER_FIX_RIGHT 
						] 
				];
				$customFilter = Yii::$app->request->queryParams;
				unset($customFilter['page'],$customFilter['per-page']);
				$dynagrid = DynaGrid::begin ( [ 
						'columns' => $gridColumns,
						'theme' => 'panel-info',
						'showPersonalize' => true,
						'storage' => 'session',
						'gridOptions' => [ 
								'dataProvider' => $dataProvider,
								'filterModel' => $searchModel,
								'showPageSummary' => true,
								'floatHeader' => true,
								'pjax' => false,
								'panel' => [ 
										'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-user"></i> '.$this->title.'</h3>',
										'before' => '<div style="padding-top: 7px;"><em></em></div>',
										'after' => false 
								],
								'toolbar' => [ 
										[ 
												'content' => Html::button ( '<i class="glyphicon glyphicon-plus"></i>', [ 
														'value' => Url::to ( [ 
																'connection-tracking/create' 
														] ),
														'class' => 'btn btn-success pull-left modalButton' 
												] ) . ' ' . Html::a ( '<i class="glyphicon glyphicon-repeat"></i>', [ 
														'dynagrid-demo' 
												], [ 
														'data-pjax' => 0,
														'class' => 'btn btn-default',
														'title' => 'Reset Grid' 
												] ) 
										],
										[ 
												'content' => '{dynagridFilter}{dynagridSort}{dynagrid}' 
										],
								] 
						],
						'options' => [ 
								'id' => 'dynagrid-1' 
						] 
				] );
				if (substr ( $dynagrid->theme, 0, 6 ) == 'simple') {
					$dynagrid->gridOptions ['panel'] = false;
				}
				$exportColumns=$dynagrid->gridOptions['columns'];
				array_pop($exportColumns);
				echo ExportMenu::widget ( [
						'dataProvider' => $searchModel->search ( $customFilter ),
						'filterModel' => $searchModel,
						'columns' => $exportColumns,
						'showColumnSelector'=>false,
						'dropdownOptions'=>[
								'id' => 'exportButton',
						],
				] );
				DynaGrid::end ();
				?>




	<?php     Modal::begin([
    		'header'=>'<h1>'.$this->title.'</h1>',
            'id' => 'modal'
        ]);
    echo "<div id='modalContent'></div>";
 
    Modal::end();
	?> 


</div>
