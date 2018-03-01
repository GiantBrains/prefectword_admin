<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserProfile */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-profile-form">


    <?php $form = ActiveForm::begin(); ?>
    <div class="col-md-10">
        <div class="col-md-6">
            <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'country')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Countries::find()->all(),
                'id', 'name'), ['prompt'=>'--Select Country--']) ?>

            <?= $form->field($model, 'gender')->dropDownList([0 => 'Male',1 => 'Female'], ['prompt'=>'--select--']) ?>
        </div>
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
