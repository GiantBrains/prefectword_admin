<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Reason */

$this->title = 'Update Reason: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Reasons', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="reason-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
