<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();
$nameAttribute = $generator->getNameAttribute();

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\grid\GridView;
use <?= $generator->indexWidgetType === 'grid' ? "kartik\\dynagrid\\DynaGrid" : "yii\\widgets\\ListView" ?>;
use <?= $generator->indexWidgetType === 'grid' ? "kartik\\export\\ExportMenu" : "yii\\widgets\\ListView" ?>;
use yii\helpers\BaseUrl;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
<?= !empty($generator->searchModelClass) ? "/* @var \$searchModel " . ltrim($generator->searchModelClass, '\\') . " */\n" : '' ?>
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = <?= $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-index">

    <h1><?= "<?= " ?>Html::encode($this->title) ?></h1>
<?php if(!empty($generator->searchModelClass)): ?>
<?= "    <?php " . ($generator->indexWidgetType === 'grid' ? "// " : "") ?>echo $this->render('_search', ['model' => $searchModel]); ?>
<?php endif; ?>

<?php
$viewName = str_replace('_','-',$generator->getTableSchema()->name);
?>


<?php if ($generator->indexWidgetType === 'grid'): ?>
    <?= "<?php " ?>


		$gridColumns = [
<?php
$count = 0;

if (($tableSchema = $generator->getTableSchema()) === false) {
    foreach ($generator->getColumnNames() as $name) {
            echo "            '" . $name . "',\n";
    }
} else {
					
    foreach ($tableSchema->columns as $column) {
    	
		switch ($column->type) {
			
			case 'text':
				 echo " [
        				'attribute'=>'". $column->name."',
				        'format'=>'raw',
				 ],\n";
				 
				break;
				
			case 'date':
	
			case 'datetime':
				
				  echo " [
        				'attribute'=>'". $column->name."',
				        'filterType'=>\kartik\grid\GridView::FILTER_DATE,
				        'format'=>'raw',
				        'width'=>'170px',
				        'filterWidgetOptions'=>[
				            'pluginOptions'=>['format'=>'yyyy-mm-dd']
				        ],
				        'visible'=>false,
				 ],\n";
				
				break;
				
			case 'integer':
				
				$bool = false;
				foreach ($tableSchema->foreignKeys as $key) {
					if(array_key_exists($column->name, $key)){
						$bool = true;
						break;
					}
					
				}

					if($bool){
						$nameModel = getNameModel($key[0]);
						$resultado = substr($column->name, 0, 1);
						$texto = strtolower($resultado);
						$cadenaFinal = $texto.substr($column->name, 1);
						echo "  [
							        'attribute'=>'".$column->name."', 
							        'vAlign'=>'middle',
							        'value'=>function (\$model, \$key, \$index, \$widget) { 
							            return Html::a(\$model->".$cadenaFinal."->name, '\'".$column->name."\'', [
							                'title'=>'View ".$column->name." detail', 
							                'onclick'=>'alert(\'This will open the ".$column->name." page.\n\')'
							            ]);
							        },
							        'filterType'=>\kartik\grid\GridView::FILTER_SELECT2,
							        'filter'=>ArrayHelper::map(\\app\\models\\".$nameModel."::find()->orderBy('name')->asArray()->all(), 'id', 'name'), 
							        'filterWidgetOptions'=>[
							            'pluginOptions'=>['allowClear'=>true],
							        ],
							        'filterInputOptions'=>['placeholder'=>'".$column->name."'],
							        'format'=>'raw'
							    ],";
					}else{
						echo "            '" . $column->name. "',\n";
						
					}
				
				
				break;
			default:
				echo "            '" . $column->name. "',\n";
				break;
		}

			
		}		
    }

?>
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
																'<?=$viewName?>/create' 
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
<?php else: ?>
    <?= "<?= " ?>ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
            return Html::a(Html::encode($model-><?= $nameAttribute ?>), ['view', <?= $urlParams ?>]);
        },
    ]) ?>
<?php endif; ?>




	<?= "<?php " ?>
    Modal::begin([
    		'header'=>'<h1>'.$this->title.'</h1>',
            'id' => 'modal'
        ]);
    echo "<div id='modalContent'></div>";
 
    Modal::end();
	<?= "?> " ?>



<?php
function getNameModel($key){
	$cadena_cambiada = str_replace("_"," ",$key);
	$cadena_cambiada2 = ucwords($cadena_cambiada);
	$cadena_cambiada3 = str_replace(" ","",$cadena_cambiada2);
	
	return $cadena_cambiada3;
}
 ?>
</div>
