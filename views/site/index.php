<?php

/* @var $this yii\web\View */

$this->title = Yii::$app->name;
?>
<div class="site-index">
    <div class="row bg-title">
        <h2 style="color: black" class="page-title">Dashboard</h2> 
    </div>

    <div class="row">
        <div class="col-md-3 col-md-3 col-sm-6 col-xs-12">
        <div class="col-sm-6 col-xs-12" style="background-color: #ABD7DE; border-radius: 10px 0px 0px 10px; color:black; height: 110px;padding: 10px">
        <div class="white-box analytics-info">
                <div class="row">
                    <div class="col-md-3"><i class="fa fa-free-code-camp fa-3x" aria-hidden="true"></i></div><br>
                    <div class="col-md-9"><h4 class="box-title">Available Orders</h4></div>
                </div>
        </div>
        </div>
        <div class="col-sm-6 col-xs-12" style="background-color: #ABD7DE; border-radius: 0px 10px 10px 0px; color:black; height: 110px; padding: 10px">
            <div><h1 style="text-align: center"><?= $available_count?></h1></div>
        </div>
        </div>

        <div class="col-md-3 col-md-3 col-sm-6 col-xs-12">
        <div class="col-sm-6 col-xs-12" style="background-color: #ABD7DE; border-radius: 10px 0px 0px 10px; color:black; height: 110px; padding: 10px">
        <div class="white-box analytics-info">
                <div class="row">
                    <div class="col-md-3"><i class="fa fa-users fa-3x" aria-hidden="true"></i></div><br>
                    <div class="col-md-9"><h4 class="box-title">Registered Clients</h4></div>
                </div>
        </div>
        </div>
        <div class="col-sm-6 col-xs-12" style="background-color: #ABD7DE; border-radius: 0px 10px 10px 0px; color:black; height: 110px; padding: 10px">
            <div><h1 style="text-align: center"><?= $users_count ?></h1></div>
        </div>
        </div>

        <div class="col-md-3 col-md-3 col-sm-6 col-xs-12">
        <div class="col-sm-6 col-xs-12" style="background-color: #ABD7DE; border-radius: 10px 0px 0px 10px; color:black; height: 110px; padding: 10px">
        <div class="white-box analytics-info">
                <div class="row">
                    <div class="col-md-3"><i class="fa fa-money fa-3x" aria-hidden="true"></i></div><br>
                    <div class="col-md-9"><h4 class="box-title">Total Amount</h4></div>
                </div>
        </div>
        </div>
        <div class="col-sm-6 col-xs-12" style="background-color: #ABD7DE; border-radius: 0px 10px 10px 0px; color:black; height: 110px; padding: 10px">
            <div><h1 style="text-align: center"><?= ceil(abs($balance)) ?></h1></div>
        </div>
        </div>

        <div class="col-md-3 col-md-3 col-sm-6 col-xs-12">
        <div class="col-sm-6 col-xs-12" style="background-color: #ABD7DE ;border-radius: 10px 0px 0px 10px; color:black; height: 110px; padding: 10px">
        <div class="white-box analytics-info">
                <div class="row">
                    <div class="col-md-3"><i class="fa fa-check fa-3x" aria-hidden="true"></i></div><br>
                    <div class="col-md-9"><h4 class="box-title">Approved Orders</h4></div>
                </div>
        </div>
        </div>
        <div class="col-sm-6 col-xs-12" style="background-color: #ABD7DE; border-radius: 0px 10px 10px 0px; color:black; height: 110px; padding: 10px">
            <div><h1 style="text-align: center"><?= $approved_count ?></h1></div>
        </div>
        </div>
</div>
</div>
