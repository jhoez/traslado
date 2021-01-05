<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Hospedaje;

/**
 * HospedajeSearch represents the model behind the search form of `frontend\models\Hospedaje`.
 */
class HospedajeSearch extends Hospedaje
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idhosp'], 'integer'],
            [['alojamiento'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Hospedaje::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'idhosp' => $this->idhosp,
        ]);

        $query->andFilterWhere(['ilike', 'alojamiento', $this->alojamiento]);

        return $dataProvider;
    }
}
