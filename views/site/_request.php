<?php
/**
 * Created by PhpStorm.
 * User: gits
 * Date: 3/1/18
 * Time: 4:43 PM
 */
?>

<tr>
    <td><?=  \dektrium\user\models\User::find()->where(['id'=>$withdraw->user_id])->one()->username ?></td>
    <td><?= '$'.number_format(floatval($withdraw->amount), 2, '.', ',') ?></td>

    <?php
    //get the time from the db in UTC and convert it client timezone
    $startTime = new \DateTime(''.$withdraw->created_at.'', new \DateTimeZone('UTC'));
    $startTime->setTimezone(new \DateTimeZone(Yii::$app->timezone->name));
    $ptime = $startTime->format("M d, Y g:i a");
    ?>
    <td><?= $ptime; ?></td>
    <?php
    if ($withdraw->status == 0){
        echo ' <td><span><a class="btn btn-md btn-primary" href="'.\yii\helpers\Url::to(['site/approve-request', 'user_id'=> $withdraw->user_id, 'amount'=>$withdraw->amount, 'uniqueid'=>$withdraw->uniqueid]).'">Approve</a></span></td>';
    }else{
        echo '<td><span class="text-success">Approved</span></td>';
    }
    ?>
</tr>
