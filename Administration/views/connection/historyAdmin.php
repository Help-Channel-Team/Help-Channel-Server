<?php
use yii\helpers\Html;
use yii\grid\GridView;
use kartik\dynagrid\DynaGrid;
use kartik\export\ExportMenu;
use yii\helpers\BaseUrl;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use yii\jui\Accordion;
use yii\widgets\Pjax;
use app\models\Connection;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ConnectionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app','Connections history');
$this->params ['breadcrumbs'] [] = Yii::t('app',$this->title);
$model = Connection::find ()->all ();
$user = \Yii::$app->user->identity;

?>
<div class="connection-history-admin">

	<h1><?= Html::encode(Yii::t('app',$this->title)) ?></h1>
  
    <?php
				
				$gridColumns = [ 
				[ 
				
				'value' => function ($model, $key, $index, $widget) {
					return Html::a ( '', '#', [ 
							'id' => 'activity-index-link',
							'class' => 'glyphicon glyphicon-list-alt',
							'data-toggle' => 'modal',
							'data-target' => '#modal',
							'data-url' => Url::to ( [ 
									'connection/tracking',
									'id' => $model->id 
							] ),
							'data-pjax' => '0' 
					] );
				},
				
				'vAlign' => 'middle',
				'format' => 'raw',
				'noWrap' => true 
		],
	
		
						[ 
								'attribute' => 'creation_date',
								'filterType' => \kartik\grid\GridView::FILTER_DATE,
								'format' => 'raw',
								'width' => '170px',
								'filterWidgetOptions' => [ 
										'pluginOptions' => [ 
												'format' => 'yyyy-mm-dd' 
										] 
								],
								'visible' => true 
						],
						[ 
								'attribute' => 'modification_date',
								'filterType' => \kartik\grid\GridView::FILTER_DATE,
								'format' => 'raw',
								'width' => '170px',
								'filterWidgetOptions' => [ 
										'pluginOptions' => [ 
												'format' => 'yyyy-mm-dd' 
										] 
								],
								'visible' => false 
						],
						[ 
								'attribute' => 'start_date',
								'filterType' => \kartik\grid\GridView::FILTER_DATE,
								'format' => 'raw',
								'width' => '170px',
								'filterWidgetOptions' => [ 
										'pluginOptions' => [ 
												'format' => 'yyyy-mm-dd' 
										] 
								],
								'visible' => true 
						],
						[ 
								'attribute' => 'end_date',
								'filterType' => \kartik\grid\GridView::FILTER_DATE,
								'format' => 'raw',
								'width' => '170px',
								'filterWidgetOptions' => [ 
										'pluginOptions' => [ 
												'format' => 'yyyy-mm-dd' 
										] 
								],
								'visible' => true 
						],
						'connection_code',
						[ 
								'attribute' => 'user_id',
								'vAlign' => 'middle',
								'value' => 'user.username',
								'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
								'filter' => ArrayHelper::map ( \app\models\User::find ()->orderBy ( 'username' )->asArray ()->all (), 'id', 'username' ),
								'filterWidgetOptions' => [ 
										'pluginOptions' => [ 
												'allowClear' => true 
										] 
								],
								'filterInputOptions' => [ 
										'placeholder' => Yii::t('app','user')
								],
								'format' => 'raw' 
						],
						[ 
				'attribute' => 'technician_id',
				'vAlign' => 'middle',
				'value' => 'technician.username',
				'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
				'filter' => ArrayHelper::map ( \app\models\User::find ()->where ( 'profile_id=\'2\'' )->orderBy ( 'username' )->asArray ()->all (), 'id', 'username' ),
				'filterWidgetOptions' => [ 
						'pluginOptions' => [ 
								'allowClear' => true 
						] 
				],
				'filterInputOptions' => [ 
						'placeholder' => 'technician_id' 
				],
				'format' => 'raw' 
		],
						[ 
								'attribute' => 'status_id',
								'vAlign' => 'middle',
								'value' => 'status.name',
								'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
								'filter' => ArrayHelper::map ( \app\models\Status::find ()->orderBy ( 'name' )->asArray ()->all (), 'id', 'name' ),
								'filterWidgetOptions' => [ 
										'pluginOptions' => [ 
												'allowClear' => true 
										] 
								],
								'filterInputOptions' => [ 
										'placeholder' => Yii::t('app','status')
								],
								'format' => 'raw' 
						],
						[ 
								'attribute' => 'creator_id',
								'vAlign' => 'middle',
								'value' => 'creator.username',
								'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
								'filter' => ArrayHelper::map ( \app\models\User::find ()->orderBy ( 'username' )->asArray ()->all (), 'id', 'username' ),
								'filterWidgetOptions' => [ 
										'pluginOptions' => [ 
												'allowClear' => true 
										] 
								],
								'filterInputOptions' => [ 
										'placeholder' => Yii::t('app','creator') 
								],
								'format' => 'raw' 
						]
				];
				$customFilter = Yii::$app->request->queryParams;
				unset ( $customFilter ['page'], $customFilter ['per-page'] );
				$dynagrid = DynaGrid::begin ( [ 
						'columns' => $gridColumns,
						'theme' => 'panel-info',
						'showPersonalize' => true,
						'toggleButtonGrid' => ['data-pjax' => true],
						'storage' => 'session',
						'gridOptions' => [ 
								'dataProvider' => $dataProvider,
								'filterModel' => $searchModel,
								'showPageSummary' => true,
								'floatHeader' => true,
								'pjax' => true,
								'panel' => [ 
										'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-user"></i> ' . $this->title . '</h3>',
										'before' => '<div style="padding-top: 7px;"><em></em></div>',
										'after' => false 
								],
								'toolbar' => [ 
										[ 
												'content' => Html::a ( '<i class="glyphicon glyphicon-repeat"></i>', [ 
															'/connection/history-admin' 
												], [ 
														'data-pjax' => 1,
														'class' => 'btn btn-default',
														'title' => Yii::t('app','Reset Grid')
												] ) 
										],
										[ 
												'content' => '{dynagridFilter}{dynagridSort}{dynagrid}' 
										] 
								] 
						],
						'options' => [ 
								'id' => 'dynagrid-historial-admin' 
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

</div>

<?php
$this->registerJs ( "$(document).on('click', '#activity-index-link', (function() {
        $.get(
            $(this).data('url'),
            function (data) {
                $('.modal-body').html(data);
                $('#modal').modal();
            }
        );
    }));" );
?>

	<?php
	
	Modal::begin ( [ 
			'header' => '<h1>'.Yii::t('app','Trackings').'</h1>',
			'id' => 'modal',
			'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">Cerrar</a>' 
	] );
	echo "<div id='modalContent'></div>";
	
	Modal::end ();
	
	?> 
	