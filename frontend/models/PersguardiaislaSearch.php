<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Persguardiaisla;

/**
 * PersguardiaislaSearch represents the model behind the search form of `frontend\models\Persguardiaisla`.
 */
class PersguardiaislaSearch extends Persguardiaisla
{
    //public $ci;
    public $nombdepart;
    //public $nombcompleto;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idpersgi', 'fkpers', 'fkuser', 'fkdepart', 'fkhosp'], 'integer'],
            [['actividad', 'fcarga', 'fsalida', 'fretorno', 'tippers','nombdepart'], 'safe'],
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
        $query = Persguardiaisla::find()->joinWith(['guarddepart']);//->joinWith(['guardpers']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder'=>['idpersgi'=>SORT_DESC]
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'idpersgi' => $this->idpersgi,
            'fkpers' => $this->fkpers,
            'fkuser' => $this->fkuser,
            'fkdepart' => $this->fkdepart,
            'fcarga' => $this->fcarga,
            'fsalida' => $this->fsalida,
            'fretorno' => $this->fretorno,
            'status' => $this->status,
            'fkhosp' => $this->fkhosp,
        ]);

        $query->andFilterWhere(['ilike', 'actividad', $this->actividad])
            ->andFilterWhere(['ilike', 'tippers', $this->tippers])
            ->andFilterWhere(['ilike', 'nombdepart', $this->nombdepart]);
            //->andFilterWhere(['ilike', 'ci', $this->ci])
            //->andFilterWhere(['ilike', 'nombcompleto', $this->nombcompleto]);

        return $dataProvider;
    }
}
