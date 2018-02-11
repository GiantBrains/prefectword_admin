<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Spacing */

$this->title = 'Create Spacing';
$this->params['breadcrumbs'][] = ['label' => 'Spacings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="spacing-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
