<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
?>
<div class="container">
    <div class="site-login">
        <div class="row"><br>
            <br><br><br>
            <br><br><br>
            <div class="col-sm-4 col-sm-offset-4 col-xs-12" style="border: solid; background-color:white; border-color: #ddd; border-width: thin; border-radius: 5px">
                <div class="row" style="background-color:whitesmoke; border-color: #ddd; border-top-left-radius: 5px; border-top-right-radius: 5px">
                    <h3 style="text-align: center"><?= Html::encode($this->title) ?></h3>
                </div>
                <?php $form = ActiveForm::begin([
                    'id' => 'login-form',
                    'fieldConfig' => [
                        'labelOptions' => ['class' => 'col-md-2 control-label'],
                    ],
                ]); ?>
                <div class="row" style="padding-right: 30px; padding-left: 30px;">
                    <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>
                    <?= $form->field($model, 'password')->passwordInput() ?>
                    <?= $form->field($model, 'rememberMe')->checkbox([
                    ]) ?>
                    <div class="form-group">
                        <?= Html::submitButton('Login', ['class' => 'btn btn-block btn-info', 'name' => 'login-button']) ?>
                        <br>
                    </div>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
