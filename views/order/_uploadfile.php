

<tr class="cart_item">
    <td  style="padding-top: 5px; padding-bottom: 5px">
        <?php
        $order_file =  $model->name.'-'.$model->file_date.'.'.$model->file_extension;
        ?>
        <span><a href="<?= Yii::$app->request->baseUrl?>/images/uploads/<?=$order_file ?>"  download><?= $model->name.'.'.$model->file_extension ?></a></span>
    </td>
    <?php
    //get the time from the db in UTC and convert it client timezone
    $startTime = new \DateTime(''.$model->created_at.'', new \DateTimeZone('UTC'));
    $startTime->setTimezone(new \DateTimeZone('Africa/Nairobi'));
    $uptime = $startTime->format("M d, Y g:i a");
    ?>
    <td><span><?= $uptime; ?></span></td>

    <?php
    //get the time from the db in UTC and convert it client timezone
    $startTime = new \DateTime(''.$model->dowload_date.'', new \DateTimeZone('UTC'));
    $startTime->setTimezone(new \DateTimeZone('Africa/Nairobi'));
    $dowtime = $startTime->format("M d, Y g:i a");
    ?>
    <td><span><?= $dowtime; ?></span></td>

    <td  style="padding-top: 5px; padding-bottom: 5px">
        <span> <?= \yii\helpers\Html::a('Delete', ['order/upload-delete', 'order'=>$model->order_number, 'file'=>$model->name, 'file_date'=>$model->file_date, 'file_extension'=>$model->file_extension], [
                'class' => 'btn btn-xs btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this file?',
                    'method' => 'post',
                ],
            ]) ?></span>
    </td>
</tr>