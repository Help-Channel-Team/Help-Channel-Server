<?php

namespace app\controllers\rest;

use Yii;

use yii\rest\ActiveController;

/**
 * ProfileController implements the CRUD actions for Profile model.
 */
class ProfileController extends ActiveController
{
	/** MODEL REST CLIENT **/
	public $modelClass = 'app\models\Profile';
	
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

}
