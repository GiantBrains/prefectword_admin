<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Order */
$tabactive = 'active';
$tab2active = 'not';
$tab3active = 'not';
$this->title = 'Order #'.$model->ordernumber;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$epoch = time();
$dt = new DateTime("@$epoch");  // convert UNIX timestamp to PHP DateTime
$myzone = new DateTimeZone('Africa/Nairobi');
$dt->setTimezone($myzone);
$dt->format('Y-m-d H:i:s');
$interval = date_diff( date_create( $dt->format('Y-m-d H:i:s')), date_create($model->deadline));

$date_days = $interval->format('%a');
$date_hours = $interval->format('%r%H');
$date_minutes = $interval->format('%r%I');
if($date_days == 0) {
    if ($interval->format('%r%I') < 0 && $interval->format('%H') == 0) {
        $deadline = '<p style="color: red">' . $interval->format('%r%I minutes') . ' </p>';
    }else if ($interval->format('%r%I') > 0 && $interval->format('%H') == 0) {
        $deadline = '<p style="color: green">' . $interval->format('%r%I minutes') . ' </p>';
    }else if($interval->format('%r%H') < 0){
        $deadline =  '<p style="color: red">'.$interval->format('%r%H hours %I minutes' ).' </p>';
    }else if($interval->format('%r%H') > 0){
        $deadline = '<p style="color: green">'.$interval->format('%r%H hours %I minutes' ).' </p>';
    }else{
        $deadline = '<p style="color: green">'.$interval->format('%r%H hours %I minutes' ).' </p>';
    }

}else  if($date_hours == 0) {
    if ($interval->format('%r%I') < 0 && $interval->format('%a') == 0) {
        $deadline = '<p style="color: red">' . $interval->format('%r%I minutes') . ' </p>';
    }else if ($interval->format('%r%I') > 0 && $interval->format('%a') == 0) {
        $deadline ='<p style="color: green">' . $interval->format('%r%I minutes') . ' </p>';
    }else if ($interval->format('%r%a') < 0) {
        $deadline = '<p style="color: red">' . $interval->format('%r%a days %I minutes') . ' </p>';
    }else if ($interval->format('%r%a') > 0) {
        $deadline = '<p style="color: green">' . $interval->format('%r%a days %I minutes') . ' </p>';
    }else{
        $deadline = '<p style="color: green">'.$interval->format('%r%a days %H hours %I minutes' ).' </p>';
    }

}
else if ($interval->format('%r%a') < 0){
    $deadline =  '<p style="color: red">'.$interval->format('%r%a days %H hours %I minutes' ).' </p>';

}else{
    $deadline =  '<p  style="color: green">'.$interval->format('%a days %H hours %I minutes' ).' </p>';
}

$datetime = <<< JS
var displayMoment = document.getElementById('deadline-date');
var theMoment = moment("<?php echo $model->deadline; ?>", "YYYY-MM-DD HH-mm-ss").fromNow();

var now = moment();
const exp = moment("<?php echo $model->deadline; ?>", "YYYY-MM-DD HH-mm-ss");
days = exp.diff(now, 'days');
hours = exp.subtract(days, 'days').diff(now, 'hours');
minutes = exp.subtract(hours, 'hours').diff(now, 'minutes');
displayMoment.innerHTML = days+' days, '+hours+' hours, '+minutes+' minutes';
JS;
$this->registerJs($datetime);
?>
<div class="order-view" style="margin-left: -10px">
    <h1><?= Html::encode($this->title) ?></h1>
    <hr>
    <?php
    $msgcount = \app\models\Notification::find()->where(['key'=>'new_message'])->andWhere(['user_id'=>Yii::$app->user->id])->andWhere(['seen'=> 0])->andFilterWhere([ 'order_number'=>$model->ordernumber])->count();
    ?>
    <ul class="nav nav-tabs" style="margin-bottom: 5px">
        <li role="presentation"  class="active"><a href="<?= \yii\helpers\Url::to(['order/view', 'oid'=>$model->ordernumber])?>"><strong>Order details</strong></a></li>
        <li role="presentation"><a href="<?= \yii\helpers\Url::to(['order/attached', 'oid'=>$model->ordernumber])?>"><strong>Order Files</strong></a></li>
        <li role="presentation" ><a href="<?= \yii\helpers\Url::to(['order/messages', 'oid'=>$model->ordernumber])?>"><strong>Messages</strong>
                <?php
                if ($msgcount != 0){
                    echo '<span class="badge">'.$msgcount.'</span>';
                }else{
                    echo '';
                }
                ?>
            </a></li>
    </ul>
    <?= \kartik\detail\DetailView::widget([
        'model' => $model,
        'bootstrap'=>true,
        'vAlign'=>'top',
        'condensed'=>false,
        'responsive'=>true,
        'hideIfEmpty'=>false,
        'hAlign'=>'right',
        'enableEditMode'=>false,
        'hover'=>true,
        'mode'=>'view',
        'panel'=>[
            'heading'=>'Order #' . $model->ordernumber,
            'type'=>'info',
        ],
        'attributes'=>[
            [
                'columns' =>[
                    [
                        'attribute'=>'ordernumber',
                        'value'=>$model->ordernumber,
                        'valueColOptions'=>['style'=>'width:30%']
                    ],
                    [
                        'attribute'=>'created_by',
                        'value'=>$model->created_by == null ? $model->created_by : $model->createdBy->username,
                        'valueColOptions'=>['style'=>'width:30%']
                    ],
                ]
            ],
            [
                'columns' =>[
                    [
                        'attribute'=>'service_id',
                        'value'=>$model->service_id == null ? $model->service_id: $model->service->name,
                        'valueColOptions'=>['style'=>'width:30%']
                    ],
                    [
                        'attribute'=>'type_id',
                        'value'=>$model->type_id == null ? $model->type_id: $model->type->name,
                        'valueColOptions'=>['style'=>'width:30%']
                    ],
                ]],
            [
                'columns' =>[
                    [
                        'attribute'=>'urgency_id',
                        'value'=>$model->urgency_id == null ? $model->urgency_id: $model->urgency->name,
                        'valueColOptions'=>['style'=>'width:30%']
                    ],
                    [
                        'attribute'=>'spacing_id',
                        'value'=>$model->spacing_id == null ? $model->spacing_id : $model->spacing->name,
                        'valueColOptions'=>['style'=>'width:30%']
                    ],]],
            [
                'columns' =>[
                    [
                        'attribute'=>'pages_id',
                        'value'=>$model->pages_id == null ? $model->pages_id : $model->pages->name,
                        'valueColOptions'=>['style'=>'width:30%']
                    ],
                    [
                        'attribute'=>'level_id',
                        'value'=>$model->level_id == null ? $model->level_id : $model->level->name,
                        'valueColOptions'=>['style'=>'width:30%']
                    ],
                ]],
            [
                'columns' =>[

                    [
                        'attribute'=>'subject_id',
                        'value'=>$model->subject_id == null ? $model->subject_id : $model->subject->name,
                        'valueColOptions'=>['style'=>'width:30%']
                    ],
                    [
                        'attribute'=>'style_id',
                        'value'=>$model->style_id == null ? $model->style_id : $model->style->name,
                        'valueColOptions'=>['style'=>'width:30%']
                    ],
                ]],
            [
                'columns' =>[
                    [
                        'attribute'=>'sources_id',
                        'value'=>$model->sources_id == null ? $model->sources_id : $model->sources->name,
                        'valueColOptions'=>['style'=>'width:30%']
                    ],
                    [
                        'attribute'=>'language_id',
                        'value'=>$model->language_id == null ? $model->language : $model->language->name,
                        'valueColOptions'=>['style'=>'width:30%']
                    ],

                ],
            ],
            [
                'attribute'=> 'phone',
                'format'=>'raw',
                'label'=>'Phone Number',
                'value'=>$model->phone
            ],
            [
                'attribute'=>'deadline',
                'label'=>'Deadline',
                'format'=>'raw',
                'value'=> $deadline,


//        date_format(date_create($model->deadline), 'Y-m-d H:i:s'). ' &nbsp; <span id="deadline-date"> </span> '
//                        $interval->format('%d Day %h Hours %i Minute' )
            ],
            [
                'attribute' => 'topic',
                'format'=>'raw',
                'value'=>'<strong>'.$model->topic.'</strong>',
            ],
            [
                'attribute'=>'instructions' ,
                'label'=>'Instructions',
                'value'=>$model->instructions,
                'format' => 'raw',
            ],
            [
                'attribute'=> 'amount',
                'format'=>'raw',
                'value'=> '<p>$'.$model->amount.'</p>'
            ],
        ],
    ]) ?>
    <p>
        <?= Html::a('Update', ['update', 'oid' => $model->ordernumber], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Cancel', ['cancel', 'oid' => $model->ordernumber], [
            'class' => 'btn btn-warning',
            'data' => [
                'confirm' => 'Are you sure you want to cancel this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
</div>
