<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $file app\models\File */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="file-form">
    <?php $form = ActiveForm::begin([
        'options'=>['enctype'=>'multipart/form-data'],
        'action'=>\yii\helpers\Url::to(['/order/order-upload','id'=>$id]),
    ]);?>

    <?= $form->field($upload, 'name[]')->widget(\kartik\file\FileInput::classname(), [
        'options' => ['multiple' => true],
        'name' => 'file[]',
        'pluginOptions' => ['previewFileType' => 'any',
            'showPreview' => false,
//            'theme'=> "explorer",
            'showCaption' => true,
            'showRemove' => true,
            'showUpload' => true,
//            'hideThumbnailContent'=>'true',
            'browseLabel' => 'Browse Files',
            'browseClass' => 'btn btn-success',
            'uploadClass' => 'btn btn-info',
            'removeClass' => 'btn btn-danger',
            'removeIcon' => '<i class="glyphicon glyphicon-trash"></i> ',
            'maxFileCount' => 10]
    ])->label(false);?>
    <?php ActiveForm::end(); ?>
</div>