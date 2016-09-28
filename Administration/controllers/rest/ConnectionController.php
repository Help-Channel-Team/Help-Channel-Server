<?php

namespace app\controllers\rest;

use Yii;

use app\models\Connection;
use yii\rest\ActiveController;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;

/**
 * ConnectionController implements the CRUD actions for Connection model.
 */
class ConnectionController extends ActiveController
{
	/** MODEL REST CLIENT **/
	public $modelClass = 'app\models\Connection';
	
	/**
	 * Authenticacion REST (3 metodos posibles)
	 * @return unknown
	 */
	public function behaviors()
	{
		$behaviors = parent::behaviors();
		$behaviors['authenticator'] = [
				'class' => CompositeAuth::className(),
				'authMethods' => [
						HttpBasicAuth::className(),
						HttpBearerAuth::className(),
						QueryParamAuth::className(),
				],
		];
		return $behaviors;
	}
	
	/**
	 * Comprueba si un técnico quiere asistir a una conexión pendiente
	 * @param unknown $connection_code
	 * @return multitype:string
	 */
	public function actionFetch($connection_code){
		$model = $this->findModel($connection_code);		
		return array('tech_name' => (isset($model->technician))? $model->technician->username : '', 'has_tech' => (isset($model->technician))? '1' : '0');
	}
	
	/**
	 * El usuario finaliza la conexión (cerrando ventana)
	 * @param unknown $connection_code
	 * @return multitype:string
	 */
	public function actionClose($connection_code){
		$model = $this->findModel($connection_code);

		$model->end_date = date('Y-m-d H:i:s');
		$model->status_id = 2;
		if($model->save()) return array('status' => 'success');
		else return array('status' => 'error');
	}
	
	/**
	 * El usuario finaliza la conexión (pulsando el botón)
	 * @param unknown $connection_code
	 * @return multitype:string
	 */
	public function actionFinish($connection_code, $finisher){
		$model = $this->findModel($connection_code);
	
		$model->end_date = date('Y-m-d H:i:s');
		($finisher == 'user')? $model->status_id = 6 : $model->status_id = 9;
		if($model->save()) return array('status' => 'success');
		else return array('status' => 'error');
	}
	
	/**
	 * El usuario rechaza la conexión de asistencia del técnico
	 * @param unknown $connection_code
	 * @return multitype:string
	 */
	public function actionReject($connection_code){
		$model = $this->findModel($connection_code);
	
		//Guardamos estado rechazado el técnico para el tracking
		$model->status_id = 7;
		if($model->save()){
		
			//Volvemos a poner en pendiente la conexión
			$model->technician_id = null;
			$model->status_id = 1;
			if($model->save()) return array('status' => 'success');
			else return array('status' => 'error');
		}else return array('status' => 'error');
	}
	
	/**
	 * El usuario ha aceptado la conexión del técnico
	 * @param unknown $connection_code
	 * @return multitype:string
	 */
	public function actionAccept($connection_code){
		$model = $this->findModel($connection_code);

		$model->status_id = 5;
		if($model->save()) return array('status' => 'success');
		else return array('status' => 'error');
	}
	
	/**
	 * Indica si la conexión esta activa (Estado Stablished)
	 * @param unknown $connection_code
	 * @return string
	 */
	public function actionAlive($connection_code){
		$model = $this->findModel($connection_code);

		return ($model->status_id != 4)? '0':'1';
	}
	
	/**
	 * Finds the Connection model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Connection the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($connection_code)
	{
		if (($model = Connection::findOne(array('connection_code' => $connection_code))) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

}
