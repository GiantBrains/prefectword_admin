<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Paypal */

$this->title = 'Create Paypal';
$this->params['breadcrumbs'][] = ['label' => 'Paypals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="paypal-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
