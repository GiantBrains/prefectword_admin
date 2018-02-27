<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\MessageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$tabactive = 'not';
$tab2active = 'not';
$tab3active = 'active';
$this->title = 'Messages';
$this->params['breadcrumbs'][] = $this->title;
$messages = <<<JS
$(document).ready(function(){
    var iScrollHeight = $("#supasupa").prop("scrollHeight");
$('.scroll-table').scrollTop(iScrollHeight);
});

// var xmlhttp;
// if (window.XMLHttpRequest) {
//      xmlhttp = new XMLHttpRequest();
// } else {
//      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
// }
// xmlhttp.open("post", "http://localhost/doctorateessays/web/order/message-count", true);
// xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
// xmlhttp.send();
// xmlhttp.onreadystatechange = function() {
//      if (xmlhttp.readyState==4 && xmlhttp.status==200) {
//          var myObj = JSON.parse(this.responseText);
//             document.getElementById("mycontent").innerHTML = myObj[0];
//           // txt="hello";
//           // x=responseXml.getElementById("#mycontent").innerHTML;
//          
//           // for (i=0;i<x.length;i++) {
//           //      txt = txt + x[i].childNodes[0].nodeValue;
//           // }
//           console(myObj[0]);
//      }
// }
//                 $.ajax({
//                         type: 'post',
//                         url: 'message-count',
//                         data: $(this).serialize(),
//                         success:function(data) {
//                                $("#mycontent").html(data);
//                                console.log(data);
//                         },
//                         error: function(data) { // if error occured
//                                 console.log("Error occured.please try again");
//                                  console.log(data);
//                         },
//                         dataType:'html'
//                 });
                                
  // using GET method
// $.get({
//   url: url,
//   data: data,
//   success: success,
//   dataType: dataType
// });
JS;
$this->registerJs($messages);
?>
<div class="message-index" style="margin-left: -10px">
    <h1><?= Html::encode('Order #'.$model->ordernumber) ?></h1>
    <hr>
    <?php
    $msgcount = \app\models\Notification::find()->where(['key'=>'new_message'])->andWhere(['user_id'=>Yii::$app->user->id])->andWhere(['seen'=> 0])->andFilterWhere([ 'order_number'=>$model->ordernumber])->count();
    ?>
    <ul class="nav nav-tabs" style="margin-bottom: 5px">
        <li role="presentation" ><a href="<?= \yii\helpers\Url::to(['order/view', 'oid'=>$model->ordernumber])?>"><strong>Order details</strong></a></li>
        <li role="presentation"><a href="<?= \yii\helpers\Url::to(['order/attached', 'oid'=>$model->ordernumber])?>"><strong>Order Files</strong></a></li>
        <li role="presentation"  class="active"><a href="<?= \yii\helpers\Url::to(['order/messages', 'oid'=>$model->ordernumber])?>"><strong>Messages</strong>
                <?php
                if ($msgcount != 0){
                    echo '<span class="badge">'.$msgcount.'</span>';
                }else{
                    echo '';
                }
                ?>
            </a></li>
        <?php
        if ($model->paid == 1 && $model->available != 1){
            echo '<li role="presentation"><a href="'. \yii\helpers\Url::to(['order/uploaded-files', 'oid'=>$model->ordernumber]).'"><strong>Submit Order</strong></a></li>';
        }
        $order_revisions = \app\models\Revision::find()->where(['order_number'=>$model->ordernumber])->all();
        if ($order_revisions){
            echo '<li role="presentation" ><a href="'.\yii\helpers\Url::to(['order/revision-view', 'oid'=>$model->ordernumber]).'"><strong>Revision Instructions</strong></a></li>';
        }else{
            echo '';
        }
        ?>
    </ul>
    <div class="row" style="padding: 0 10px 0 10px">
        <!--            <button style="margin-left: 15px; margin-bottom: 15px" type="button" class="btn btn-primary" data-toggle="modal" data-target="#messageModal">-->
        <!--                <i class="icon fa fa-plus"></i> New Message-->
        <!--            </button>-->
        <diV class="row" style="margin-left: 15px">
            <div id="supasupa" class="col-lg-10 scroll-table" style="border: solid; border-color: #8c8c8c; padding: 10px; max-height: 400px;  overflow-x: hidden; overflow-y: scroll; border-width: thin; border-radius: 10px; height: auto">
                <?php
                foreach ($order_messages as $order_message) {
                    //get the time from the db in UTC and convert it client timezone
                    $startTime = new \DateTime(''.$order_message->created_at.'', new \DateTimeZone('UTC'));
                    $startTime->setTimezone(new \DateTimeZone(Yii::$app->timezone->name));
                    $ptime = $startTime->format("M d, Y H:i");
                    echo '<div class="mymessage row" style="height: auto; padding: 5px 10px 5px 10px">';
                    if ($order_message->sender_id != Yii::$app->user->id){
                        echo '<div  class="col-md-7" style="text-align: left; border-radius: 5px; background-color: #ECEFF4">';
                        echo '<div>'.$order_message->message.'</div>';
                        echo '<div style="text-decoration: underline"><span style="font-style: italic; font-size: small">'.$ptime.'</span></div>';
                        echo '</div>';
                    }else{
                        echo '<div  class="col-md-7 col-md-push-5" style="border-radius: 5px; background-color: #e2e9e4">';
                        echo '<div style="text-align: left">'.$order_message->message.'</div>';
                        echo '<div style="text-decoration: underline; text-align: left"><span style="font-style: italic; font-size: small">'.$ptime.'</span></div>';
                        echo '</div>';
                    }
                    echo '</div>';
                }
                ?>
                <hr>
                <div class="message-form">
                    <?php $form = \kartik\form\ActiveForm::begin([
                        'action'=> \yii\helpers\Url::to(['order/messages','oid'=>$model->ordernumber])
                    ]); ?>
                    <div class="row">
                        <div class="col-md-10 col-sm-10 col-xs-12">
                            <?= $form->field($message, 'message')->textarea(['rows' => 2])->label(false) ?>
                        </div>
                        <div class="col-md-2 col-sm-10 col-xs-4" style="margin-top: 5px" >
                            <?= Html::submitButton('Send', ['class' => 'btn btn-primary btn-lg']) ?>
                        </div>
                    </div>
                    <?php \kartik\form\ActiveForm::end(); ?>
                </div>
            </div>
        </diV>
    </div>
  </div>
<div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="text-align: center" class="modal-title" id="exampleModalLabel"><strong>New Message</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="message-form">
                    <?php $form = \kartik\form\ActiveForm::begin([
                        'action'=> \yii\helpers\Url::to(['order/messages','oid'=>$model->ordernumber])
                    ]); ?>
                    <div class="row">
                        <div class="col-md-6">
                   <?= $form->field($message, 'receiver_id')->textInput()->label('Send To:')->dropDownList([3=>'Client']) ?>
                        </div>
                    </div>
                    <?= $form->field($message, 'message')->textarea(['rows' => 6]) ?>
                    <div class="form-group">
                        <?= Html::submitButton('Send', ['class' => 'btn btn-primary']) ?>
                    </div>
                    <?php \kartik\form\ActiveForm::end(); ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>