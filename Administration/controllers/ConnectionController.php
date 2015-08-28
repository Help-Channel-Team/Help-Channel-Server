<?php

namespace app\controllers;

use Yii;
use app\models\Connection;
use app\models\ConnectionSearch;
use app\models\ConnectionTracking;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\data\ActiveDataProvider;

/**
 * ConnectionController implements the CRUD actions for Connection model.
 */
class ConnectionController extends Controller
{
	
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Connection models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ConnectionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    /**
     * Lists all Connection models.
     * @return mixed
     */
    public function actionHistory()
    {
    	$searchModel = new ConnectionSearch();
    	$searchModel->technician_id = Yii::$app->user->identity->id;
    	$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    
    	return $this->render('history', [
    			'searchModel' => $searchModel,
    			'dataProvider' => $dataProvider,
    	]);
    }
	/**
     * Lists all Connection models Admin.
     * @return mixed
     */
    public function actionHistoryAdmin()
    {
    	$searchModel = new ConnectionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('historyAdmin', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Displays a single Connection model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Connection model.
     * If creation is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Connection();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        	Yii::$app->getSession()->setFlash('success', '<button type="button" class="btn btn-default modalButton" value="/connection/view?id='.$model->id.'"><i class="glyphicon glyphicon-eye-open"></i></button> Creado correctamente!');
            return $this->redirect(['index']);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ], false, true);
        }
    }

    /**
     * Updates an existing Connection model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        	Yii::$app->getSession()->setFlash('success', '<button type="button" class="btn btn-default modalButton" value="/connection/view?id='.$model->id.'"><i class="glyphicon glyphicon-eye-open"></i></button> Modificado correctamente!');
            return $this->redirect(['index']);
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
            ], false, true);
        }
    }

    /**
     * Deletes an existing Connection model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    
    /**
     * Deletes an existing Connection model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionAcceptTech($id)
    {
    	$model = $this->findModel($id);
    	$tech = Yii::$app->user->identity;
    	
    	//Reglas de negocio
    	//RN1: El estado de la conexion es requested.
    	if($model->status->id != 1){
    		Yii::$app->getSession()->setFlash('warning', 'No puedes aceptar una conexion que no esta peticion de asistencia');
    		return $this->redirect(['/site/index']);
    	}
    	//RN2: El tecnico no esta realizando asistencia o ha solicitado asistencia a otro usuario.
    	if(Connection::find()->where('(status_id = 3 or status_id= 5) and technician_id = '.$tech->id)->one()){
    		Yii::$app->getSession()->setFlash('warning', 'Ya tienes una conexion esperando respuesta o iniciada, por favor cancela o finaliza la conexion antes de aceptar otra. Gracias.');
    		return $this->redirect(['/site/index']);
    	}
    	
    	//Cambiamos el estado y asignamos un tecnico
    	$model->status_id = 3;
    	$model->technician_id = Yii::$app->user->identity->id;
    	
    	if($model->save()){
    		Yii::$app->getSession()->setFlash('success', 'Has aceptado la petición de asistencia, espere por favor a que el usuario la acepte.');
    		return $this->redirect(['/site/index']);
    	}else{
    		Yii::$app->getSession()->setFlash('warning', $model->getErrors());
    		return $this->redirect(['/site/index']);
    	}
    }
    
    /**
     * Reject Connection
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionRejectTech($id)
    {
    	$model = $this->findModel($id);
    	 
    	//Reglas de negocio
    	//RN1: El estado de la conexion es pending o acceptada
    	if($model->status->id != 3){
    		Yii::$app->getSession()->setFlash('warning', 'No puedes aceptar una conexion que no esta pendiente.');
    		return $this->redirect(['/site/index']);
    	}
    	//RN2: El tecnico asociado a la conexion es el que lo solicita
    	if($model->technician->id != Yii::$app->user->identity->id){
    		Yii::$app->getSession()->setFlash('warning', 'No tienes permiso para rechazar esta conexión.');
    		return $this->redirect(['/site/index']);
    	}
    	 
    	//Cambiamos el estado y eliminamos al tecnico
    	$model->status_id = 1;
    	$model->technician_id = null;
    	 
    	if($model->save()){
    		Yii::$app->getSession()->setFlash('success', 'Has rechazado la peticion de conexcion correctamente.');
    		return $this->redirect(['/site/index']);
    	}else{
    		Yii::$app->getSession()->setFlash('warning', $model->getErrors());
    		return $this->redirect(['/site/index']);
    	}
    }
    
    /**
     * Reject Connection
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionRejectAdmin($id)
    {
    	$model = $this->findModel($id);
    
    	//Reglas de negocio
		//TODO Controlar estados
    
    	//Cambiamos el estado y eliminamos al tecnico
    	$model->status_id = 1;
    	$model->technician_id = null;
    
    	if($model->save()){
    		Yii::$app->getSession()->setFlash('success', 'Se ha rechazado la peticion de conexión correctamente.');
    		return $this->redirect(['/site/index']);
    	}else{
    		Yii::$app->getSession()->setFlash('warning', $model->getErrors());
    		return $this->redirect(['/site/index']);
    	}
    }
    
    /**
     * Reject Connection
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionCancelAdmin($id)
    {
    	$model = $this->findModel($id);
    
    	if($model->delete()){
    		Yii::$app->getSession()->setFlash('success', 'Se ha eliminado la peticion de conexión correctamente.');
    		return $this->redirect(['/site/index']);
    	}else{
    		Yii::$app->getSession()->setFlash('warning', $model->getErrors());
    		return $this->redirect(['/site/index']);
    	}
    }

    /**
     * Finds the Connection model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Connection the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Connection::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	
	 public function actionTracking($id)
    {
    	$model = ConnectionTracking::find()->where(['connection_id' => $id])->orderBy('id desc')->all();
    
    	return $this->renderAjax('tracking', [
            'model' => $model,
        ]);
    }
    
    public function actionPending(){
    	$user = \Yii::$app->user->identity;
    
    	$dataProvider = new ActiveDataProvider(['query' => Connection::find()->where('(status_id = 3 or status_id = 5) and technician_id = '.$user->id)->orderBy('creation_date','DESC')]);
    	 
    	return $this->renderAjax('pending', [
            'dataProvider' => $dataProvider,
        ]);
    }
    

    public function actionRequested(){
    	if(isset(Yii::$app->request->queryParams['page'])){
    		Yii::$app->session['page-requested'] = Yii::$app->request->queryParams['page'] - 1;
    	}else if(isset(Yii::$app->session['page-requested'])){
    		Yii::$app->request->setQueryParams(array('page' => (Yii::$app->session['page-requested']) - 1));
    	}
    	
    	$dataProvider = new ActiveDataProvider(['query' => Connection::find()->where('status_id = 1')->orderBy('creation_date','ASC'), 'pagination' => [
        	'pageSize' => 10, 'page' => (isset(Yii::$app->session['page-requested']))? Yii::$app->session['page-requested'] : 0
    	]]);
    
    	return $this->renderAjax('requested', [
    		'dataProvider' => $dataProvider,
    	]);
    }
}
