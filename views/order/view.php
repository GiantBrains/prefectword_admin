<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Order */
$tabactive = 'active';
$tab2active = 'not';
$tab3active = 'not';
$this->title = 'Order #'.$model->ordernumber;

$datetime = <<< JS
//var displayMoment = document.getElementById('deadline-date');
/*var theMoment = moment("<?php echo  ?>", "YYYY-MM-DD HH-mm-ss").fromNow();*/
//
//var now = moment();
/*const exp = moment("<?php echo ?>", "YYYY-MM-DD HH-mm-ss");*/
//days = exp.diff(now, 'days');
//hours = exp.subtract(days, 'days').diff(now, 'hours');
//minutes = exp.subtract(hours, 'hours').diff(now, 'minutes');
//displayMoment.innerHTML = days+' days, '+hours+' hours, '+minutes+' minutes';
JS;
$this->registerJs($datetime);
?>
<div class="order-view" style="margin-left: -10px">
    <?php
    $epoch = time();
    $dt = new DateTime("@$epoch");  // convert UNIX timestamp to PHP DateTime
    $myzone = new DateTimeZone(Yii::$app->timezone->name);
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

    $rejected = \app\models\Reject::find()->where(['order_number'=>$model->ordernumber])->one();
    if ($rejected){
        $reject_msg = '<div><p><strong>Reason: <span style="color: red">'.$rejected->reason->name.'</span></strong></p>
                        <p><strong>Description:</strong> '.$rejected->description.'</p>
                        </div>';
    }else{
        $reject_msg = null;
    }

    $cancelled = \app\models\Cancel::find()->where(['order_number'=>$model->ordernumber])->one();
    if ($cancelled){
        $cancel_msg = '<div><p><strong>Reason: <span style="color: red">'.$cancelled->title0->name.'</span></strong></p>
                        <p><strong>Description:</strong> '.$cancelled->description.'</p>
                        </div>';
    }else{
        $cancel_msg = null;
    }
    ?>
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
        <?php
        if ($model->paid == 1){
            echo '<li role="presentation" ><a href="'. \yii\helpers\Url::to(['order/uploaded-files', 'oid'=>$model->ordernumber]).'"><strong>Submit Order</strong></a></li>';
        }

        $order_revisions = \app\models\Revision::find()->where(['order_number'=>$model->ordernumber])->all();
        if ($order_revisions){
            echo '<li role="presentation" ><a href="'.\yii\helpers\Url::to(['order/revision-view', 'oid'=>$model->ordernumber]).'"><strong>Revision Instructions</strong></a></li>';
        }else{
            echo '';
        }
        ?>
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
            $reject_msg != null ?
                [
                    'label'=>'Rejected',
                    'value'=>$reject_msg,
                    'format' => 'raw',
                ] :
                [
                    'label'=>'',
                    'value'=>'',
                    'format' => 'raw',
                ],

            $cancel_msg != null ?
                [
                    'label'=>'Cancelled',
                    'value'=>$cancel_msg,
                    'format' => 'raw',
                ] :
                [
                    'attribute'=>'',
                    'value'=>'',
                ]
        ],
    ]) ?>
    <p>

        <?php
        $cancancel= $model->active == 1 || $model->available == 1;
        $cancelled = $model->paid == 0 && $model->cancelled == 0;
        if ($cancelled){
            echo ' <!-- Button trigger modal -->
            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#cancelModal">
               Cancel
            </button>';
        }else{
            echo '';
        }
        ?>
        <?php
        if ($model->available == 1 && $model->paid == 1){
            echo ' <!-- Button trigger modal -->
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#takeModal">
              Take Order
            </button>';
        }else{
            echo '';
        }
        ?>
    </p>
</div>

<!-- Modal -->
<div class="modal fade" id="takeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" style="text-align: center" id="myModalLabel">Take Order</h4>
            </div>
            <div class="modal-body">
                <div class="row" style="padding: 10px">
                    <p>Please read and agree to our terms and conditions before taking the order.<br>
                        Ensure that all the instructions are followed and submit final product in time.</p>
                    <form action="<?= Yii::$app->request->baseUrl?>/site/take">
                        <input name="oid"  type="hidden" value="<?=$model->ordernumber ?>">
                        <p><input required type="checkbox" name="agree" value="true"> Agree to <a href="#">Terms and Conditions</a>.</p> <br>
                        <input name="submit" type="submit" class="btn btn-primary" value="Take Order">
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" style="text-align: center" id="myModalLabel">Cancel Order</h4>
            </div>
            <div class="modal-body">
                <div class="row" style="padding: 10px">
                    Cancel Order
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
