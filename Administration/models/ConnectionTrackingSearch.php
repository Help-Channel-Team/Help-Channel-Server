<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ConnectionTracking;

/**
 * ConnectionTrackingSearch represents the model behind the search form about `app\models\ConnectionTracking`.
 */
class ConnectionTrackingSearch extends ConnectionTracking
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'connection_id', 'creator_id'], 'integer'],
            [['creation_date', 'modification_date', 'description'], 'safe'],
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
        $query = ConnectionTracking::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
          
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'connection_id' => $this->connection_id,
            'creator_id' => $this->creator_id,
        ]);

        $query->andFilterWhere(['like', 'creation_date', $this->creation_date])
            ->andFilterWhere(['like', 'modification_date', $this->modification_date])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
