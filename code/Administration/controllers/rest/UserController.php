<?php

namespace app\controllers\rest;

use Yii;

use yii\rest\ActiveController;
use app\models\LoginForm;
use app\models\Connection;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends ActiveController
{
	/** MODEL REST CLIENT **/
	public $modelClass = 'app\models\User';
	
	/**
	 * Lists all User models.
	 * @return mixed
	 */
	public function actionLogin($username, $password, $machine_name,$machine_token,$machine_data)
	{
		$model = new LoginForm();
		$model->username = $username;
		$model->password = $password;
		
		if ($model->login()) {
			//Generamos un hash para el usuario
			$user = Yii::$app->user->identity;
			$hash = $user->generateAccessToken();
			$user->save();
			
			//Creamos una peticion de conexion por el usuario
			$connection = new Connection();
			$connection->user_id = $user->id;
			$connection->creator_id = $user->id;
			$connection->creation_date = date('Y-m-d H:i:s');
			$connection->connection_code = sha1(uniqid());
			$connection->status_id = 1;
			$connection->machine_name = $machine_name;
			$connection->machine_token = $machine_token;
			$connection->machine_data = $machine_data;
			
			$connection->save();
			
			return array('status' => 'success', 'access_token' => $hash, 'connection_code' => $connection->connection_code);
		} else {
			return array('status' => 'error', 'access_token' => '' , 'connection_code' => '');
		}
	}

}
