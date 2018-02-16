

<tr class="cart_item">
    <td  style="padding-top: 5px; padding-bottom: 5px">
        <?php
        $order_file =  $model->name.'-'.$model->file_date.'.'.$model->file_extension;
        ?>
        <span><a href="<?= Yii::$app->request->baseUrl?>/images/uploads/<?=$order_file ?>"  download><?= $model->name.'.'.$model->file_extension ?></a></span>
    </td>
    <td  style="padding-top: 5px; padding-bottom: 5px">
        <span><a data-method="post" type="button" class="btn btn-md btn-danger" href="<?= \yii\helpers\Url::to(['order/upload-delete','order'=>$model->order_number, 'file'=>$model->name, 'file_date'=>$model->file_date, 'file_extension'=>$model->file_extension])?>">Delete</a></span>
    </td>
</tr>