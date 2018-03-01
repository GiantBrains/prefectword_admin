<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserProfile */

$this->title = 'Update User Profile: '.$model->first_name.'';
$this->params['breadcrumbs'][] = ['label' => 'User Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->first_name, 'url' => ['view', 'user' => $model->user_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-profile-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <hr>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
