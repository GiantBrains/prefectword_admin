<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OrderSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'ordernumber') ?>

    <?= $form->field($model, 'created_by') ?>

    <?= $form->field($model, 'written_by') ?>

    <?= $form->field($model, 'edited_by') ?>

    <?php // echo $form->field($model, 'service_id') ?>

    <?php // echo $form->field($model, 'type_id') ?>

    <?php // echo $form->field($model, 'urgency_id') ?>

    <?php // echo $form->field($model, 'deadline') ?>

    <?php // echo $form->field($model, 'spacing_id') ?>

    <?php // echo $form->field($model, 'pages_id') ?>

    <?php // echo $form->field($model, 'level_id') ?>

    <?php // echo $form->field($model, 'subject_id') ?>

    <?php // echo $form->field($model, 'style_id') ?>

    <?php // echo $form->field($model, 'sources_id') ?>

    <?php // echo $form->field($model, 'language_id') ?>

    <?php // echo $form->field($model, 'pagesummary') ?>

    <?php // echo $form->field($model, 'plagreport') ?>

    <?php // echo $form->field($model, 'initialdraft') ?>

    <?php // echo $form->field($model, 'topic') ?>

    <?php // echo $form->field($model, 'instructions') ?>

    <?php // echo $form->field($model, 'qualitycheck') ?>

    <?php // echo $form->field($model, 'topwriter') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'promocode') ?>

    <?php // echo $form->field($model, 'amount') ?>

    <?php // echo $form->field($model, 'cancelled') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
