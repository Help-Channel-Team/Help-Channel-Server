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
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app','Users');
$this->params ['breadcrumbs'] [] = $this->title;
?>
<div class="user-index">

	<h1><?= Html::encode($this->title) ?></h1>
 

    <?php
				
				$gridColumns = [ 
						'id',
						'username',
						'password',
						'ldap_username',
						'access_token',
						'auth_key',
						[ 
								'attribute' => 'profile_id',
								'vAlign' => 'middle',
								'value' => 'profile.name',
								'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
								'filter' => ArrayHelper::map ( \app\models\Profile::find ()->orderBy ( 'name' )->asArray ()->all (), 'id', 'name' ),
								'filterWidgetOptions' => [ 
										'pluginOptions' => [ 
												'allowClear' => true 
										] 
								],
								'filterInputOptions' => [ 
										'placeholder' => Yii::t('app','profile_id')
								],
								'format' => 'raw' 
						],
				
				];
				$customFilter = Yii::$app->request->queryParams;
				unset ( $customFilter ['page'], $customFilter ['per-page'] );
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
										'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-user"></i> ' . $this->title . '</h3>',
										'before' => '<div style="padding-top: 7px;"><em></em></div>',
										'after' => false 
								],
						
						],
						'options' => [ 
								'id' => 'dynagrid-1' 
						] 
				] );
				if (substr ( $dynagrid->theme, 0, 6 ) == 'simple') {
					$dynagrid->gridOptions ['panel'] = false;
				}
				$exportColumns = $dynagrid->gridOptions ['columns'];
				array_pop ( $exportColumns );
				echo ExportMenu::widget ( [ 
						'dataProvider' => $searchModel->search ( $customFilter ),
						'filterModel' => $searchModel,
						'columns' => $exportColumns,
						'showColumnSelector' => false,
						'dropdownOptions' => [ 
								'id' => 'exportButton' 
						] 
				] );
				DynaGrid::end ();
				?>




	<?php
	
Modal::begin ( [ 
			'header' => '<h1>' . $this->title . '</h1>',
			'id' => 'modal' 
	] );
	echo "<div id='modalContent'></div>";
	
	Modal::end ();
	?> 


</div>
