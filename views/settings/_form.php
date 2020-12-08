<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Settings */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="settings-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'coupon1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'coupon2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'coupon3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'coupon_value1')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'coupon_value2')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'coupon_value3')->textInput(['type' => 'number']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
