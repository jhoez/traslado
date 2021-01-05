<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Persexterno;

/**
 * PersexternoSearch represents the model behind the search form of `frontend\models\Persexterno`.
 */
class PersexternoSearch extends Persexterno
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idinv', 'fkhosp', 'fkuser'], 'integer'],
            [['ci', 'nombcompleto', 'ente', 'actividad', 'fcarga', 'fsalida', 'fretorno', 'tippers', 'sexo'], 'safe'],
            [['status'], 'boolean'],
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
        $query = Persexterno::find();

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
            'idinv' => $this->idinv,
            'fcarga' => $this->fcarga,
            'fsalida' => $this->fsalida,
            'fretorno' => $this->fretorno,
            'status' => $this->status,
            'fkhosp' => $this->fkhosp,
            'fkuser' => $this->fkuser,
        ]);

        $query->andFilterWhere(['ilike', 'ci', $this->ci])
            ->andFilterWhere(['ilike', 'nombcompleto', $this->nombcompleto])
            ->andFilterWhere(['ilike', 'ente', $this->ente])
            ->andFilterWhere(['ilike', 'actividad', $this->actividad])
            ->andFilterWhere(['ilike', 'tippers', $this->tippers])
            ->andFilterWhere(['ilike', 'sexo', $this->sexo]);

        return $dataProvider;
    }
}
