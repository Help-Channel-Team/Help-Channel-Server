<?php
namespace app\rbac;

use Yii;
use yii\rbac\Rule;

/**
 * Checks if user group matches
 */
class UserGroupRule extends Rule
{
    public $name = 'userGroup';

    public function execute($user, $item, $params)
    {
        if (!Yii::$app->user->isGuest) {
            $group = Yii::$app->user->identity->group;
            if ($item->name === 'ADMIN') {
                return $group == 'ADMIN';
            } elseif ($item->name === 'TECH') {
                return $group == 'ADMIN' || $group == 'TECH';
            } elseif ($item->name === 'USER') {
                return $group == 'ADMIN' || $group == 'USER';
			}
        }
        return false;
    }
}
