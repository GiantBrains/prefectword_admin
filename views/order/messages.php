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
    <ul class="nav nav-tabs" style="margin-bottom: 5px">
        <li role="presentation" ><a href="<?= \yii\helpers\Url::to(['order/view', 'oid'=>$model->ordernumber])?>"><strong>Order details</strong></a></li>
        <li role="presentation"><a href="<?= \yii\helpers\Url::to(['order/attached', 'oid'=>$model->ordernumber])?>"><strong>Order Files</strong></a></li>
        <li role="presentation"  class="active"><a href="<?= \yii\helpers\Url::to(['order/messages', 'oid'=>$model->ordernumber])?>"><strong>Messages</strong></a></li>
    </ul>
        <div class="row" style="padding: 10px">
            <button style="margin-left: 15px; margin-bottom: 15px" type="button" class="btn btn-primary" data-toggle="modal" data-target="#messageModal">
                <i class="icon fa fa-plus"></i> New Message
            </button>
            <diV class="row" style="margin-left: 15px">
                <div class="col-lg-10" style="border: solid; border-color: #8c8c8c; padding: 10px; border-width: thin; border-radius: 10px; height: auto">
                    <?php
                    foreach ($order_messages as $order_message) {
                        //get the time from the db in UTC and convert it client timezone
                        $startTime = new \DateTime(''.$order_message->created_at.'', new \DateTimeZone('UTC'));
                        $startTime->setTimezone(new \DateTimeZone('Africa/Nairobi'));
                        $ptime = $startTime->format("M d, Y H:i");

                        if ($order_message->sender_id == Yii::$app->user->id){
                            echo '<div class="mymessage" style="height: auto; padding: 10px; background-color: lightcyan">';
                            echo '<div>You on &nbsp;&nbsp;&nbsp;<span>'.$ptime.'</span></div>';
                            echo '<div>'.$order_message->message.'</div>';
                            echo '</div>';
                            echo '<br>';
                        }else{
                            echo '<div class="mymessage" style="height: auto; padding: 10px; text-align: right; background-color: #d0e9c6">';
                            echo '<div>'.$order_message->sender->username.' on  &nbsp;&nbsp;&nbsp;<span>'.$ptime.'</span></div>';
                            echo '<div>'.$order_message->message.'</div>';
                            echo '</div>';
                            echo '<br>';
                        }
                    }
                    echo \yii\widgets\LinkPager::widget([
                        'pagination' => $pagination,
                    ]);
                    ?>
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