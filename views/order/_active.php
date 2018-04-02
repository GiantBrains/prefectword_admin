<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OrderSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-search">

    <?php $form = \kartik\form\ActiveForm::begin([
        'action' => ['active'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>



    <?= $form->field($model, 'global', [
        'addon' => [
            'append' => [
                'content' => Html::submitButton('Search', ['class'=>'btn btn-primary']),
                'asButton' => true
            ]
        ]
    ])->label(false);?>
    <?php //echo $form->field($model, 'ordernumber') ?>
    <?php //echo $form->field($model, 'created_by') ?>
    <?php //echo $form->field($model, 'service_id') ?>
    <?php //echo $form->field($model, 'written_by') ?>
    <?php //echo $form->field($model, 'edited_by') ?>
    <?php //echo $form->field($model, 'type_id') ?>

    <?php //echo $form->field($model, 'urgency_id') ?>

    <?php  // echo $form->field($model, 'spacing_id') ?>

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

    <?php // echo $form->field($model, 'files') ?>

    <?php // echo $form->field($model, 'created_at') ?>
    <?php // echo $form->field($model, 'amount') ?>

    <?php \kartik\form\ActiveForm::end(); ?>

</div>
