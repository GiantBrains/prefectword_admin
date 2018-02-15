<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Uploaded */

$this->title = 'Create Uploaded';
$this->params['breadcrumbs'][] = ['label' => 'Uploadeds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="uploaded-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
