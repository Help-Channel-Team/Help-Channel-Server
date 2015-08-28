<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\bootstrap\Alert;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode(Yii::t('app',$this->title)) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => 'HELPCHANNEL',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            if (!\Yii::$app->user->isGuest) {
            	if(Yii::$app->user->identity->group == 'ADMIN'){
					echo Nav::widget([
			                'options' => ['class' => 'navbar-nav navbar-right'],
			                'items' => [
			                    ['label' => Yii::t('app','Dashboard'), 'url' => ['/site/index']],
			                    ['label' => Yii::t('app','Connections History'), 'url' => ['/connection/history-admin']],
			                   	['label' => Yii::t('app','Users'), 'url' => ['/user']],
			                    ['label' => Yii::t('app','Logout').' (' . Yii::$app->user->identity->username . ')',
			                            'url' => ['/site/logout'],
			                            'linkOptions' => ['data-method' => 'post']],
			                ],
			            ]);
            	}else if(Yii::$app->user->identity->group == 'TECH'){
            		echo Nav::widget([
            				'options' => ['class' => 'navbar-nav navbar-right'],
            				'items' => [
            						['label' => Yii::t('app','Dashboard'), 'url' => ['/site/index']],
            						['label' => Yii::t('app','Connections History'), 'url' => ['/connection/history']],
            						['label' =>  Yii::t('app','Logout').' (' . Yii::$app->user->identity->username . ')',
            								'url' => ['/site/logout'],
            								'linkOptions' => ['data-method' => 'post']],
            				],
            		]);
            	}else if(Yii::$app->user->identity->group == 'USER'){
	            	echo Nav::widget([
	            			'options' => ['class' => 'navbar-nav navbar-right'],
	            			'items' => [
	            					['label' => Yii::t('app','Dashboard'), 'url' => ['/site/index']],
	            					['label' => Yii::t('app','Logout').' (' . Yii::$app->user->identity->username . ')',
	            							'url' => ['/site/logout'],
	            							'linkOptions' => ['data-method' => 'post']],
	            			],
	            	]);
            	}
            }else{
            	echo Nav::widget([
            			'options' => ['class' => 'navbar-nav navbar-right'],
            			'items' => [
            					['label' => Yii::t('app','Login'), 'url' => ['/site/login']]
            			]
            	]);
            }
            NavBar::end();
        ?>

        <div class="container">
        	<?php foreach (Yii::$app->session->getAllFlashes() as $alert => $message){ 
            	echo Alert::widget(['options' => ['class' => 'alert-'.$alert], 'body' => $message]);
        	} ?>
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; HelpChannel <?= date('Y') ?></p>
        </div>
    </footer>

<?php $this->endBody() ?>

<script>

	$(document).ready(function() {
	  $('.summernoteWidget').summernote();
	});
	
	
</script>

</body>
</html>
<?php $this->endPage() ?>
