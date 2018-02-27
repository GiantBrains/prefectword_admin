<?php
/**
 * Created by PhpStorm.
 * User: gits
 * Date: 2/27/18
 * Time: 2:42 PM
 */
?>

<div class="file-create" style="margin-left: -10px">
    <h1><?= \yii\helpers\Html::encode('Order #'.$model->ordernumber) ?></h1>
    <hr>
    <?php
    $submittedfile = \app\models\Uploaded::find()->where(['order_number'=> $model->id])->all();
    $msgcount = \app\models\Notification::find()->where(['key'=>'new_message'])->andWhere(['user_id'=>Yii::$app->user->id])->andWhere(['seen'=> 0])->andFilterWhere([ 'order_number'=>$model->ordernumber])->count();
    ?>
    <ul class="nav nav-tabs" style="margin-bottom: 5px">
        <li role="presentation"><a href="<?= \yii\helpers\Url::to(['order/view', 'oid'=>$model->ordernumber])?>"><strong>Order details</strong></a></li>
        <li role="presentation"><a href="<?= \yii\helpers\Url::to(['order/attached', 'oid'=>$model->ordernumber])?>"><strong>Order Files</strong></a></li>
        <li role="presentation"><a href="<?= \yii\helpers\Url::to(['order/messages', 'oid'=>$model->ordernumber])?>"><strong>Messages</strong>
                <?php
                if ($msgcount != 0){
                    echo '<span class="badge">'.$msgcount.'</span>';
                }else{
                    echo '';
                }
                ?> </a></li>
        <?php
        if ($submittedfile){
            echo '<li role="presentation" ><a href="'.\yii\helpers\Url::to(['order/uploaded-files', 'oid'=>$model->ordernumber]).'"><strong>Download & Review</strong></a></li>';
        }else{
            echo '';
        }
        $order_revisions = \app\models\Revision::find()->where(['order_number'=>$model->ordernumber])->all();
        if ($order_revisions){
            echo '<li role="presentation" class="active" ><a href="'.\yii\helpers\Url::to(['order/revision-view', 'oid'=>$model->ordernumber]).'"><strong>Revision Instructions</strong></a></li>';
        }else{
            echo '';
        }
        ?>
    </ul>
    <div class="row">
        <div class="col-md-10">
            <table id="revisions">
                <tr>
                    <th class="col-md-2">Index #</th>
                    <th class="col-md-7">Instructions</th>
                    <th class="col-md-3">Date</th>
                </tr>
                <?php
                $order_revisions = \app\models\Revision::find()->where(['order_number'=>$model->ordernumber])->orderBy('id DESC')->all();
                foreach ($order_revisions as $order_revision) {
                    echo $this->render('_viewrevision',[
                        'order_revision'=>$order_revision
                    ]);
                }
                ?>
            </table>
        </div>
    </div>
</div>
