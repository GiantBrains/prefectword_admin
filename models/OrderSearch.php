<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Order;

/**
 * OrderSearch represents the model behind the search form of `app\models\Order`.
 */
class OrderSearch extends Order
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'ordernumber', 'created_by', 'written_by', 'edited_by', 'pagesummary', 'plagreport', 'initialdraft', 'qualitycheck', 'topwriter'], 'integer'],
            [['topic',  'service_id', 'type_id', 'urgency_id', 'deadline', 'spacing_id', 'pages_id', 'level_id', 'subject_id', 'style_id', 'sources_id', 'language_id', 'instructions', 'phone', 'promocode', 'created_at'], 'safe'],
            [['amount'], 'number'],
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
        $query = Order::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id' => SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $query->joinWith('service');
        $query->joinWith('type');
        $query->joinWith('urgency');
        $query->joinWith('spacing');
        $query->joinWith('pages');
        $query->joinWith('level');
        $query->joinWith('subject');
        $query->joinWith('style');
        $query->joinWith('sources');
        $query->joinWith('language');

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'ordernumber' => $this->ordernumber,
            'created_by' => $this->created_by,
            'written_by' => $this->written_by,
            'edited_by' => $this->edited_by,
            'pagesummary' => $this->pagesummary,
            'plagreport' => $this->plagreport,
            'initialdraft' => $this->initialdraft,
            'qualitycheck' => $this->qualitycheck,
            'topwriter' => $this->topwriter,
            'deadline' => $this->deadline,
            'amount' => $this->amount,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'order.topic', $this->topic])
            ->andFilterWhere(['like', 'order.instructions', $this->instructions])
            ->andFilterWhere(['like', 'order.phone', $this->phone])
            ->andFilterWhere(['like', 'order.promocode', $this->promocode])

            ->andFilterWhere(['like', 'service.name', $this->service_id])
            ->andFilterWhere(['like', 'type.name', $this->type_id])
            ->andFilterWhere(['like', 'urgency.name', $this->urgency_id])

            ->andFilterWhere(['like', 'subject.name', $this->subject_id])
            ->andFilterWhere(['like', 'style.name', $this->style_id])
            ->andFilterWhere(['like', 'sources.name', $this->sources_id])

            ->andFilterWhere(['like', 'spacing.name', $this->spacing_id])
            ->andFilterWhere(['like', 'pages.name', $this->pages_id])
            ->andFilterWhere(['like', 'level.name', $this->level_id])

            ->andFilterWhere(['like', 'language.name', $this->language_id]);

        return $dataProvider;
    }
}
