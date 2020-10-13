<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\User;
/* @var $this yii\web\View */
/* @var $searchModel app\models\WalletSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Wallets';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
<div style="margin-top:10px">
    <ul class="nav nav-tabs" style="margin-bottom: 5px">
        <li role="presentation" class="<?=$deposit?>"><a href="<?= Yii::$app->request->baseUrl?>/wallet/index"><strong>Deposit</strong></a></li>
        <li role="presentation" class="<?=$withdraw?>"><a href="<?=  Yii::$app->request->baseUrl?>/wallet/order-withdrawals"><strong>Order Payments</strong></a></li>
    </ul>
</div>
</div>
<div class="wallet-index">
    <div class="container">
    <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                [
                    'attribute'=>'customer_id',
                    'label' => 'Username',
                    'format' => 'raw',
                    'value'=> function ($model, $key, $index, $column) {
                        $user = User::findOne($model->customer_id);
                        return  $user->username;
                    }
                ],
                [
                    'attribute'=>'narrative',
                    'format' => 'raw',
                    'value'=> function ($model, $key, $index, $column) {
                        return  $model->narrative;
                    }
                ],

            [
                'attribute'=>'deposit',
                'visible' => $deposit == 'active',
                'label' => 'Amount',
                'format' => 'raw',
                'value'=> function ($model, $key, $index, $column) {
                   return $model->deposit;
                }
            ],
            [
                'attribute'=>'withdraw',
                'visible' => $withdraw == 'active',
                'label' => 'Amount',
                'format' => 'raw',
                'value'=> function ($model, $key, $index, $column) {
                    return $model->withdraw;
                }
            ],
            
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
</div>
