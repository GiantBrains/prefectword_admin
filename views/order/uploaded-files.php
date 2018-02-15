<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\File */
$tab2active = 'active';
$tabactive = 'not';
$tab3active = 'not';
$this->title = 'Additional Files';
?>
<div class="file-create" style="margin-left: -10px">
    <h1><?= Html::encode('Order #'.$model->ordernumber) ?></h1>
    <hr>
    <?php
    $msgcount = \app\models\Notification::find()->where(['key'=>'new_message'])->andWhere(['user_id'=>Yii::$app->user->id])->andWhere(['seen'=> 0])->andFilterWhere([ 'order_number'=>$model->ordernumber])->count();
    ?>
    <ul class="nav nav-tabs" style="margin-bottom: 5px">
        <li role="presentation"><a href="<?= \yii\helpers\Url::to(['order/view', 'oid'=>$model->ordernumber])?>"><strong>Order details</strong></a></li>
        <li role="presentation" ><a href="<?= \yii\helpers\Url::to(['order/attached', 'oid'=>$model->ordernumber])?>"><strong>Order Files</strong></a></li>
        <li role="presentation" ><a href="<?= \yii\helpers\Url::to(['order/messages', 'oid'=>$model->ordernumber])?>"><strong>Messages</strong>
                <?php
                if ($msgcount != 0){
                    echo '<span class="badge">'.$msgcount.'</span>';
                }else{
                    echo '';
                }
                ?>
            </a></li>
        <li role="presentation" class="active"><a href="<?= \yii\helpers\Url::to(['order/uploaded-files', 'oid'=>$model->ordernumber])?>"><strong>Upload Files</strong></a></li>
    </ul>
    <div class="row">
        <div class="col-md-11">
            <table id="files" cellspacing="0">
                <tr>
                    <th class="col-md-4" style="padding-left:15px">File Name</th>
                    <th class="col-md-2" style="padding-left:15px">Action</th>
                </tr>
                <?php
                foreach($models as $model){
                    echo $this->render('_uploadfile',[
                        'model'=>$model,
                    ]);
                }
                ?>
            </table>
            <div style="margin-top: 20px">
                <?= $this->render('_upload', [
                    'upload' => $upload,
                    'id'=>$id
                ]) ?>
            </div>
        </div>
    </div>
</div>
