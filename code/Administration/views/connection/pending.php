<?php
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\dynagrid\DynaGrid;
use yii\widgets\Pjax;

Pjax::begin ();
$dynagrid = DynaGrid::begin ( [ 
		'columns' => [ 
				'creation_date',
				'user.username',
				[ 
						'label' => 'Estado',
						'format' => 'html',
						'value' => function ($data) {
							if ($data->status_id != 5)
								return '<a href="/connection/accept-tech?id=' . $data->id . '" class="btn btn-info" >Esperando respuesta <span class="glyphicon glyphicon-time"></span></a>';
							if (Yii::$app->user->identity->group == 'ADMIN')
								return '<span class="btn btn-warning" >Recibiendo asistencia <span class="glyphicon glyphicon-expand"></span></span>';
							else
								return '<a href="/tecnico?repeaterID=ID:' . $data->connection_code . '" target="_blank" class="btn btn-warning" >Conectar <span class="glyphicon glyphicon-expand"></span></a>';
						} 
				],
				[ 
						'format' => 'html',
						'value' => function ($data) {
							if ($data->status_id == 3 || Yii::$app->user->identity->group == 'ADMIN')
								return '<a href="/connection/reject-tech?id=' . $data->id . '" class="btn"><span class="glyphicon glyphicon-remove text-danger"></span></a>';
							else
								return '';
						} 
				] 
		],
		'theme' => 'panel-success',
		'gridOptions' => [ 
				'dataProvider' => $dataProvider,
				'pjax' => true,
				'panel' => [ 
						'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-time"></i> Conexiones aceptadas</h3>',
						'before' => '<div style="padding-top: 7px;"><em></em></div>',
						'after' => false 
				],
				'toolbar' => ['{export}'] 
		],
		'options' => [ 
				'id' => 'dynagrid-pending' 
		] 
] );
DynaGrid::end ();
Pjax::end ();
?>
