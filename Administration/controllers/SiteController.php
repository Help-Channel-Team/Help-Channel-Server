<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

use app\models\Connection;
use app\models\ConnectionSearch;

use app\models\LoginForm;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['login','index','logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                	[
                		'actions' => ['login'],
                		'allow' => true,
                	],
                	[
                		'actions' => ['index'],
                		'allow' => true,
                		'roles' => ['TECH','USER'],
                	],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Dashboard Action
     */
    public function actionIndex()
    {
    	$user = \Yii::$app->user->identity;
    	$model = array();
    	$view = 'index';
    	
    	switch ($user->group){
    		case 'ADMIN':
    			$model = $this->getModelAdmin($user);
    			break;
    		case 'TECH':
    			$model = $this->getModelTech($user);
    			$view = 'dashboard_tech';  			
    			break;
    		case 'USER':
				$model = $this->getModelUser($user);
				$view = 'index_user';
    			//TODO
    			break;
    	}
    	
    	return $this->render($view, $model);
    }
	
	public function actionMail() {
		$today = date('d-m-Y');
		
		Yii::$app->mailer->compose('customer/publish-job', array('username' => 'Fernando'))
		->setTo(array('dfernandez@ingenieriacreativa.es'))
		->setFrom(array('no-reply@myfixpert.com' => 'Myfixpert'))
		->setReplyTo('help@myfixpert.com')
		->setSubject('Bienvenido a Myfixpert')
		->send();
	}
	
	public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
        	return $this->goHome();
        }

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    
    private function getModelAdmin($user){
    	$model = array();
    	 
    	$model['allConnections'] = new ActiveDataProvider(['query' => Connection::find()->orderBy('creation_date','DESC')]);
    	$model['searchModel'] = new ConnectionSearch();
    	 
    	$model['requestedConnections'] = new ActiveDataProvider(['query' => Connection::find()->where('status_id = 1')->orderBy('creation_date','ASC')]);
    	$model['pendingConnections'] = new ActiveDataProvider(['query' => Connection::find()->where('status_id = 3 or status_id = 5')->orderBy('creation_date','DESC')]);
    	 
    	 
    	return $model;
    }
    
    private function getModelTech($user){
    	$model = array();
    	
    	$model['myConnections'] = new ActiveDataProvider(['query' => Connection::find()->where('technician_id = \''.$user->id.'\'')->orderBy('creation_date','DESC')]);
    	$model['searchModel'] = new ConnectionSearch();
    	
    	$model['requestedConnections'] = new ActiveDataProvider(['query' => Connection::find()->where('status_id = 1')->orderBy('creation_date','ASC')]);
    	$model['pendingConnections'] = new ActiveDataProvider(['query' => Connection::find()->where('(status_id = 3 or status_id = 5) and technician_id = '.$user->id)->orderBy('creation_date','DESC')]);
    	
    	
    	return $model;
    }

	private function getModelUser($user){
    	$model = array();
    	
    	$model['myConnections'] = new ActiveDataProvider(['query' => Connection::find()->where('user_id = \''.$user->id.'\'')->orderBy('creation_date','DESC')]);
    	$model['searchModel'] = new ConnectionSearch();
    	
    	   	
    	return $model;
    }
}
