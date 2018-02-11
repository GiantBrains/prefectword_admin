

<tr class="cart_item">
    <td  style="padding-top: 5px; padding-bottom: 5px">
        <span><a href="<?= Yii::$app->request->baseUrl?>/images/order/<?=$model->attached ?>"  download><?= $model->attached ?></a></span>
    </td>
    <td  style="padding-top: 5px; padding-bottom: 5px">
        <span><a data-method="post" type="button" class="btn btn-md btn-danger" href="<?= \yii\helpers\Url::to(['order/file-delete','order'=>$model->order_id, 'file'=>$model->attached])?>">Delete</a></span>
    </td>
</tr>