<?php
/**
 * Created by PhpStorm.
 * User: gits
 * Date: 9/22/18
 * Time: 8:50 PM
 */
?>

<h1>ORDER COMPLETED CONFIRMATION</h1>

<p style="text-transform: capitalize">Dear <?= $client->username ?>,</p>

<p>Order <?= $order->ordernumber ?> "<?= $order->topic?>" has been completed by writer <?= $writer->username ?>.</p>

<p>Please review the order within 3 days.</p>

<p>if the order was done satisfactorily according to instructions, rate your writer and leave a feedback. You may ask for revision anytime if not satisfied</p>

<p>We were glad to help you and hope to see your Next Order. You may also place an order for the same writer on the Order Page.</p>

<p>Best Regards,</p>

<p>Support Team</p>