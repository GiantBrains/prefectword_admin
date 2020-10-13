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
<div style="margin-top:100px">
    <ul class="nav nav-tabs" style="margin-bottom: 5px">
        <li role="presentation" ><a href="<?= Yii::$app->request->baseUrl?>/wallet/index"><strong>Deposit</strong></a></li>
        <li role="presentation" ><a href="<?=  Yii::$app->request->baseUrl?>/wallet/withdraw"><strong>Withdraw Requests</strong></a></li>
        <li role="presentation" ><a href="<?=Yii::$app->request->baseUrl ?>/wallet/transactions"><strong>Transactions</strong></a></li>
    </ul>
</div>
</div>
<div class="wallet-index">
    <div class="container">
    <div class="wallet-index">

        <h1><?= Html::encode($this->title) ?></h1>
        <?php Pjax::begin(); ?>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <p>
            <?= Html::a('Create Wallet', ['create'], ['class' => 'btn btn-info']) ?>
        </p>

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
                'attribute'=>'order_id',
                'label' => 'Amount',
                'format' => 'raw',
                'value'=> function ($model, $key, $index, $column) {
                    return $model->deposit;
                }
            ],
            
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
        <?php Pjax::end(); ?>
    </div>

</div>
</div>
