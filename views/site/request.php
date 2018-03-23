<?php
/**
 * Created by PhpStorm.
 * User: gits
 * Date: 3/1/18
 * Time: 4:33 PM
 */
$this->title = 'Withdrawal Requests';
?>

<h1><?= \yii\helpers\Html::encode($this->title) ?></h1>
<hr>

<div class="col-md-8" style="margin-top: 20px;">
    <table id="transactions">
        <tr>
            <th>Client</th>
            <th>Amount</th>
            <th>Date</th>
            <th>Verify</th>
        </tr>
        <?php
        foreach($withdraws as $withdraw){
            echo $this->render('_request',[
                'withdraw'=>$withdraw,
            ]);
        }
        ?>
    </table>
</div><!-- /.row -->
