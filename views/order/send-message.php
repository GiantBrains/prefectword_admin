<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Message */

$this->title = 'Send Message';
$this->params['breadcrumbs'][] = ['label' => 'Messages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="message-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_message_form', [
        'model' => $model,
    ]) ?>

</div>
