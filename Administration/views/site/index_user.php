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
error_reporting ( E_ERROR );

/* @var $this yii\web\View */
$this->title = Yii::t('app','Dashboard');
$this->params ['breadcrumbs'] [] = Yii::t('app',$this->title);
$model = Connection::find ()->all ();
$user = \Yii::$app->user->identity;

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
				'visible' => true 
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
		
		'user.username' => [ 
				'header' => Yii::t ( 'app', 'User' ),
				'attribute' => 'user.username' 
		],
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
						'placeholder' => 'user_id' 
				],
				'format' => 'raw',
				'visible' => false 
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
						'placeholder' => 'status_id' 
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
				
				'class' => 'kartik\grid\ActionColumn',
				'template' => '{view}{update}{delete}',
				'dropdown' => false,
				'visible' => false,
				'buttons' => [ 
						'view' => function ($url, $model) {
							return Html::button ( '<i class="glyphicon glyphicon-eye-open"></i>', [ 
									'value' => Url::to ( [ 
											$url 
									] ),
									'class' => 'btn btn-default modalButton' 
							] );
						},
						'update' => function ($url, $model) {
							return Html::button ( '<i class="glyphicon glyphicon-pencil"></i>', [ 
									'value' => Url::to ( [ 
											$url 
									] ),
									'class' => 'btn btn-default modalButton' 
							] );
						} 
				],
				'deleteOptions' => [ 
						'title' => Yii::t ( 'app', 'Delete' ),
						'data-toggle' => 'tooltip',
						'class' => 'btn btn-default' 
				],
				'order' => DynaGrid::ORDER_FIX_RIGHT 
		] 
];
$customFilter = Yii::$app->request->queryParams;
unset ( $customFilter ['page'], $customFilter ['per-page'] );
?>
<div class="site-index">

	<div class="body-content">
		<div class="row">
			<div class="col-xs-12">
						 <?php
							$dynagrid = DynaGrid::begin ( [ 
									'columns' => $gridColumns,
									'theme' => 'panel-default',
									'showPersonalize' => true,
									'storage' => 'session',
									'gridOptions' => [ 
											'dataProvider' => $dataProvider,
											'filterModel' => $searchModel,
											'showPageSummary' => true,
											'floatHeader' => true,
											'pjax' => true,
											'panel' => [ 
													'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-stats"></i> '.Yii::t('app','My connections history').'</h3>',
													'before' => '<div style="padding-top: 7px;"><em></em></div>',
													'after' => false 
											] 
									],
									'options' => [ 
											'id' => 'dynagrid-2' 
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
		</div>
	</div>
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