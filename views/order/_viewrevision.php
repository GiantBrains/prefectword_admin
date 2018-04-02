<?php
/**
 * Created by PhpStorm.
 * User: gits
 * Date: 2/27/18
 * Time: 3:05 PM
 */
?>
<tr>
    <td></td>
    <td><span><?= $order_revision->instructions ?></span></td>
    <?php
    $startTime = new \DateTime(''.$order_revision->created_at.'', new \DateTimeZone('UTC'));
    $startTime->setTimezone(new \DateTimeZone(Yii::$app->timezone->name));
    $revtime = $startTime->format("M d, Y g:i a");
    ?>
    <td><span><?= $revtime ?></span></td>
</tr>
