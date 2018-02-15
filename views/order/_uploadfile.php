

<tr class="cart_item">
    <td  style="padding-top: 5px; padding-bottom: 5px">
        <span><a href="<?= Yii::$app->request->baseUrl?>/images/uploads/<?=$model->name ?>"  download><?= $model->name ?></a></span>
    </td>
    <td  style="padding-top: 5px; padding-bottom: 5px">
        <span><a data-method="post" type="button" class="btn btn-md btn-danger" href="<?= \yii\helpers\Url::to(['order/upload-delete','order'=>$model->order_number, 'file'=>$model->name])?>">Delete</a></span>
    </td>
</tr>