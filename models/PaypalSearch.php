<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Paypal;

/**
 * PaypalSearch represents the model behind the search form of `app\models\Paypal`.
 */
class PaypalSearch extends Paypal
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'order_number', 'complete'], 'integer'],
            [['narrative', 'payment_id', 'hash', 'created_at'], 'safe'],
            [['amount_paid', 'withdraw'], 'number'],
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
        $query = Paypal::find();

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
            'id' => $this->id,
            'user_id' => $this->user_id,
            'order_number' => $this->order_number,
            'amount_paid' => $this->amount_paid,
            'withdraw' => $this->withdraw,
            'complete' => $this->complete,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'narrative', $this->narrative])
            ->andFilterWhere(['like', 'payment_id', $this->payment_id])
            ->andFilterWhere(['like', 'hash', $this->hash]);

        return $dataProvider;
    }
}
