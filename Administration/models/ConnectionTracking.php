<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gecos_connection_tracking".
 *
 * @property integer $id
 * @property string $creation_date
 * @property string $modification_date
 * @property string $description
 * @property integer $connection_id
 * @property integer $creator_id
 *
 * @property Connection $connection0
 * @property User $creator0
 */
class ConnectionTracking extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'helpchannel_connection_tracking';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['creation_date', 'connection_id', 'creator_id'], 'required'],
            [['connection_id', 'creator_id'], 'integer'],
            [['creation_date', 'modification_date', 'description'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'creation_date' => Yii::t('app', 'Creation Date'),
            'modification_date' => Yii::t('app', 'Modification Date'),
            'description' => Yii::t('app', 'Description'),
            'connection_id' => Yii::t('app', 'Connection'),
            'creator_id' => Yii::t('app', 'Creator'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConnection()
    {
        return $this->hasOne(Connection::className(), ['id' => 'connection_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreator()
    {
        return $this->hasOne(User::className(), ['id' => 'creator_id']);
    }
}
