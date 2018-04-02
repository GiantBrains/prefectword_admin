<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\UserProfile */

$this->title = 'My Profile';
$this->params['breadcrumbs'][] = ['label' => 'User Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-profile-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <hr>
    <?php
    //get the time from the db in UTC and convert it client timezone
    $startTime = new \DateTime(''.$model->created_at.'', new \DateTimeZone('UTC'));
    $startTime->setTimezone(new \DateTimeZone(Yii::$app->timezone->name));
    $createtime = $startTime->format("M d, Y g:i a");
    ?>
    <div class="row">
        <div class="col-md-6">
            <?= \kartik\detail\DetailView::widget([
                'model' => $model,
                'bootstrap'=>true,
                'vAlign'=>'bottom',
                'condensed'=>false,
                'responsive'=>true,
                'hideIfEmpty'=>true,
                'hAlign'=>'left',
                'enableEditMode'=>false,
                'hover'=>true,
                'mode'=>'view',
                'panel'=>[
                    'heading'=>''.$model->first_name.' '.$model->last_name.'' ,
                    'type'=>'info',
                ],
                'attributes' => [
                    'city',
                    'timezone',
                    'phone',
                    [
                         'attribute'=>'country',
                        'value'=>$model->country0->name
                    ],
                    [
                          'attribute'=>'gender',
                        'value'=> $model->gender == 0 ? 'Male': 'Female',
                    ],
                    [
                        'attribute'=>'created_at',
                        'format'=>'raw',
                        'label'=>'Time created',
                        'value'=>$createtime,
                         'valueColOptions'=>['style'=>'width:30%']
                    ],
                ],
            ]) ?>
        </div>
    </div>

    <p>
        <?= Html::a('Update', ['update', 'user' => $model->user_id], ['class' => 'btn btn-primary']) ?>
    </p>
</div>
