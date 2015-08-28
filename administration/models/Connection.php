<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

//use app\behavior\MyBehavior;

/**
 * This is the model class for table "helpchannel_connection".
 *
 * @property integer $id
 * @property string $creation_date
 * @property string $modification_date
 * @property string $start_date
 * @property string $end_date
 * @property string $connection_code
 * @property integer $user_id
 * @property integer $technician_id
 * @property integer $status_id
 * @property integer $creator_id
 * @property string $machine_name
 * @property HelpchannelUser $creator0
 * @property HelpchannelStatus $status0
 * @property HelpchannelUser $technician0
 * @property HelpchannelUser $user0
 * @property HelpchannelConnectionTracking[] $helpchannelConnectionTrackings0
 */
class Connection extends \yii\db\ActiveRecord
{
	
	public $invisibles = array("creation_date");
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'helpchannel_connection';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['creation_date', 'connection_code', 'user_id', 'status_id', 'creator_id'], 'required'],
            [['creation_date', 'modification_date', 'start_date', 'end_date'], 'safe'],
            [['user_id', 'technician_id', 'status_id', 'creator_id'], 'integer'],
            [['connection_code','machine_name'], 'string', 'max' => 255],
            [['connection_code'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'creation_date' =>  Yii::t('app','Creation Date'),
            'modification_date' => Yii::t('app','Modification Date'),
            'start_date' => Yii::t('app','Start Date'),
            'end_date' => Yii::t('app','End Date'),
            'connection_code' =>  Yii::t('app','Connection Code'),
            'user_id' => Yii::t('app','User'),
            'technician_id' => Yii::t('app','Technician'),
            'status_id' => Yii::t('app','Status'),
            'creator_id' =>  Yii::t('app','Creator'),
            'machine_name' => Yii::t('app','Machine Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreator()
    {
        return $this->hasOne(User::className(), ['id' => 'creator_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['id' => 'status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTechnician()
    {
        return $this->hasOne(User::className(), ['id' => 'technician_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConnectionTrackings0()
    {
        return $this->hasMany(ConnectionTracking::className(), ['connection_id' => 'id']);
    }

	 public function setModificationDate()
    {
    	$this->modification_date = date('Y-m-d H:i:s');
    }  
	
	
public function beforeSave($insert) {
	
 		
    	if (parent::beforeSave($insert)) {
    		
			$cadenaseguimiento = "";
			$modo = "";
    		
    		
			
			if ($this->getIsNewRecord()){
			 	
				
			 }else{
			 	$modo = "ACTUALIZACIÓN CONEXIÓN ";
				$this->modification_date = date('Y-m-d H:i:s');
			 }
			
			
    		$oldattributes = $this->getOldAttributes();
			$newattributes = $this->getAttributes();
			
		
			 // compara el atributo por atributo el objeto a guardar con el objeto guardado
            foreach ($newattributes as $name => $value) 
            {
            	if(!in_array($name,$this->invisibles))
				{
					 if (!$this->getIsNewRecord()){	
		                if ($oldattributes[$name] != "") 
		                {
		                	// Estoy en modo actualizar, hay valores anteriores
						    $old = $oldattributes[$name];	
							
							// Si los valores antiguo y nuevo son diferentes, añado a cadena para seguimiento.
			                if ($value != $old) 
						    {
						    	$value = $newattributes[$name];		
						 		$old   = $oldattributes[$name];	
							
								if($name == "status_id"){
									$estadoOld = Status::findOne(array('id'=>$old));
									
									if($estadoOld != null){
										$old = $estadoOld->name;
									}
									
									$estadovalue = Status::findOne(array('id'=>$value));
									
									if($estadovalue != null){
										$value = $estadovalue->name;
									}
								}	
								
								if($name == "technician_id" || $name == "user_id" || $name == "creator_id"){
									$userOld = User::findOne(array('id'=>$old));
									
									if($userOld != null){
										$old = $userOld->username;
									}
									
									$uservalue = User::findOne(array('id'=>$value));
									
									if($uservalue != null){
										$value = $uservalue->username;
									}
								}
								
			                    $cadenaseguimiento .= "<br/>".$this->getAttributeLabel($name).": ".$old." ---> ".$value;
							}
						}
						
					}
				}
			}
			 
			 
			 if($cadenaseguimiento!= ""){
				$trackinConnection = new ConnectionTracking();
				$trackinConnection->connection_id = $this->id;
				$trackinConnection->description = $modo.$cadenaseguimiento;
				$trackinConnection->creator_id = Yii::$app->user->identity->id;
				$trackinConnection->creation_date = date('Y-m-d H:i:s');
		
				if(!$trackinConnection->save()){
					print_r($trackinConnection->getErrors());
					exit;
				} 	
			 }
    		
    		return true;
    	}else{
    		return false;
    	}
	}

}
