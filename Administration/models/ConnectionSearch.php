<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Connection;

/**
 * ConnectionSearch represents the model behind the search form about `app\models\Connection`.
 */
class ConnectionSearch extends Connection
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'technician_id', 'status_id', 'creator_id'], 'integer'],
            [['creation_date', 'modification_date', 'start_date', 'end_date', 'connection_code'], 'safe'],
           
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Connection::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
             return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
       
            'modification_date' => $this->modification_date,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'user_id' => $this->user_id,
            'technician_id' => $this->technician_id,
            'status_id' => $this->status_id,
            'creator_id' => $this->creator_id,
        ]);

        $query->andFilterWhere(['like', 'connection_code', $this->connection_code]);
		$query->andFilterWhere(['like', 'creation_date', $this->creation_date]);

        return $dataProvider;
    }
}
