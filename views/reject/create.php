<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Reject */

$this->title = 'Create Reject';
$this->params['breadcrumbs'][] = ['label' => 'Rejects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reject-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
