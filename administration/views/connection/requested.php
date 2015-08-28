<?php
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\dynagrid\DynaGrid;

$dynagrid = DynaGrid::begin ( [ 
		'columns' => [ 
				'creation_date',
				[ 
						'label' => 'Usuario',
						'value' => 'user.username' 
				],
				[ 
						'format' => 'html',
						'value' => function ($data) {
							if (Yii::$app->user->identity->group == 'ADMIN')
								return '<a href="/connection/cancel-admin?id=' . $data->id . '" class="btn btn-danger" >Eliminar <span class="glyphicon glyphicon-close"></span></a>';
							else
								return '<a href="/connection/accept-tech?id=' . $data->id . '" class="btn btn-success" >Aceptar <span class="glyphicon glyphicon-play-circle"></span></a>';
						} 
				] 
		],
		'theme' => 'panel-danger',
		'gridOptions' => [ 
				'dataProvider' => $dataProvider,
				'pjax' => true,
				'panel' => [ 
						'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-user"></i> Conexiones pendiente (el usuario necesita asistencia)</h3>',
						'before' => '<div style="padding-top: 7px;"><em></em></div>',
						'after' => false 
				],
				'toolbar' => [ 
						[ 
								'content' => Html::a ( '<i class="glyphicon glyphicon-repeat"></i>', [ 
										'/connection/requested' 
								], [ 
										'data-pjax' => 1,
										'class' => 'btn btn-default',
										'id' => 'reload-requested',
										'title' => Yii::t ( 'app', 'Reset Grid' ) 
								] )
						],
						'{export}' 
				] 
		],
		'options' => [ 
				'id' => 'dynagrid-requested' 
		] 
] );
DynaGrid::end ();
?>
