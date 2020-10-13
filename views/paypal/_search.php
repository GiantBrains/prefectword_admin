<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PaypalSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="paypal-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'narrative') ?>

    <?= $form->field($model, 'payment_id') ?>

    <?= $form->field($model, 'order_number') ?>

    <?php // echo $form->field($model, 'amount_paid') ?>

    <?php // echo $form->field($model, 'withdraw') ?>

    <?php // echo $form->field($model, 'hash') ?>

    <?php // echo $form->field($model, 'complete') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-info']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
