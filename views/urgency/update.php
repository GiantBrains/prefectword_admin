<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Urgency */

$this->title = 'Update Urgency: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Urgencies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="urgency-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
