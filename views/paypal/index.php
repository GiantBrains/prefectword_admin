<?php

use app\models\User;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PaypalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Paypal';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="paypal-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="container">
        <div style="margin-top:10px">
            <ul class="nav nav-tabs" style="margin-bottom: 5px">
                <li role="presentation" class="<?= $deposit ?>"><a
                            href="<?= Yii::$app->request->baseUrl ?>/wallet/index"><strong>Deposit</strong></a></li>
                <li role="presentation" class="<?= $withdraw ?>"><a
                            href="<?= Yii::$app->request->baseUrl ?>/wallet/order-withdrawals"><strong>Withdrawals</strong></a>
                </li>
                <li role="presentation" class="<?= $paypal ?>"><a
                            href="<?= Yii::$app->request->baseUrl ?>/paypal/index"><strong>Paypal</strong></a></li>
            </ul>
        </div>
    </div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            // 'id',
            [
                'attribute' => 'user_id',
                'label' => 'Username',
                'format' => 'raw',
                'value' => function ($model, $key, $index, $column) {
                    $user = User::findOne($model->user_id);
                    return $user->username;
                }
            ],
            'narrative',
            'payment_id',
            'order_number',
            'amount_paid',
            //'withdraw',
            //'hash',
            [
                'attribute' => 'complete',
                'label' => 'Status',
                'format' => 'raw',
                'value' => function ($model, $key, $index, $column) {
                    if ($model->complete == 1) {
                        return 'Successful';
                    } else {
                        return 'Pending';
                    }
                }
            ],
            'created_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
