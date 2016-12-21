<?php

namespace app\controllers\rest;

use Yii;

use yii\rest\ActiveController;

/**
 * StatusController implements the CRUD actions for Status model.
 */
class StatusController extends ActiveController
{
	/** MODEL REST CLIENT **/
	public $modelClass = 'app\models\Status';

}
