<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Message;

/**
 * MessageSearch represents the model behind the search form of `app\models\Message`.
 */
class MessageSearch extends Message
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'general', 'sender_id', 'receiver_id', 'order_number', 'status'], 'integer'],
            [['message', 'title','context', 'created_at'], 'safe'],
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
        $query = Message::find();

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
            'general' => $this->general,
            'sender_id' => $this->sender_id,
            'receiver_id' => $this->receiver_id,
            'order_number' => $this->order_number,
            'status' => $this->status,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'message', $this->message])
                ->andFilterWhere(['like', 'title', $this->title])
                ->andFilterWhere(['like', 'context', $this->context]);

        return $dataProvider;
    }
}
