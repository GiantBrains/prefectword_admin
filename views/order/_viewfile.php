

<tr class="cart_item">
    <td  style="padding-top: 5px; padding-bottom: 5px">
        <?php
        $order_file =  $model->attached.'-'.$model->file_date.'.'.$model->file_extension;
        ?>
        <span><?= $model->attached.'.'.$model->file_extension ?></span>
    </td>
    <td  style="padding-top: 5px; padding-bottom: 5px">
        <span><a type="button" class="btn btn-md btn-danger" href="https://doctorateessays.com/images/order/<?=$order_file?>"><i class="fa fa-download fa-2x" aria-hidden="true"></i></a></span>
    </td>
</tr>