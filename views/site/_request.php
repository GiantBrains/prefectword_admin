<?php
/**
 * Created by PhpStorm.
 * User: gits
 * Date: 3/1/18
 * Time: 4:43 PM
 */
?>

<tr>
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
        echo ' <td><span class="text-warning">Pending</span></td>';
    }else{
        echo '<td><span class="text-success">Approved</span></td>';
    }
    ?>
</tr>
