<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Order */

$this->title = $model->id;
?>
<div class="order-view">
    <h1><?= Html::encode($this->title) ?></h1>
    <table cellspacing="0">
        <thead>
        <tr>
            <th>Product Code</th>
        </tr>
        </thead>

        <tbody>
        <?php
        foreach($models as $model){
            echo $this->render('_viewfile',[
                'model'=>$model,
            ]);
        }
        ?>
        </tbody>
    </table>
</div>