<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Reason */

$this->title = 'Create Reason';
$this->params['breadcrumbs'][] = ['label' => 'Reasons', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reason-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
