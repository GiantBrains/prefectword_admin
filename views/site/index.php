<?php

/* @var $this yii\web\View */

$this->title = Yii::$app->name;
?>
<div class="site-index" style="margin-top: 30px">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <h4 class="page-title">Dashboard</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <a href="<?= Yii::$app->request->baseUrl?>/site/sales" class="btn btn-danger pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Go to Sales</a>
            <ol class="breadcrumb">
                <li><a href="<?= Yii::$app->request->baseUrl?>/">Dashboard</a></li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3 col-md-3 col-sm-6 col-xs-12" style="height: auto">
            <div class="white-box analytics-info" style="background-color: #00c0ef; color: white; height: 150px; padding: 10px">
                <div class="row"><div class="col-md-3"><i class="fa fa-list fa-3x" aria-hidden="true"></i></div>
                <div class="col-md-9"><h4 class="box-title">Available Orders</h4></div></div>
                <div><h1 style="text-align: center"><?= $available_count?></h1></div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="height: auto">
            <div class="white-box analytics-info" style="background-color: #dd4b39; color: white; height: 150px; padding: 10px">
               <div class="row"><div class="col-md-3">
                       <i class="fa fa-users fa-3x" aria-hidden="true"></i>
                   </div>
                   <div class="col-md-9">
                       <h4 class="box-title">Registered Clients</h4>
                   </div>
               </div>
                <div><h1 style="text-align: center"><?= $users_count ?></h1></div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="height: auto">
            <div class="white-box analytics-info" style="background-color: #00a65a; color: white; height: 150px; padding: 10px">
                <div class="row">
                    <div class="col-md-3">
                        <i class="fa fa-money fa-3x" aria-hidden="true"></i>
                    </div>
                    <div class="col-md-9">
                        <h4>Total Amount (USD)</h4>
                    </div>
                </div>
                <div><h1 style="text-align: center"><?= abs($balance) ?></h1></div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="height: auto">
            <div class="white-box analytics-info" style="background-color: #f39c12; color: white; height: 150px; padding: 10px">
                <div class="row">
                    <div class="col-md-3">
                        <span class="glyphicon glyphicon-check check-icon" aria-hidden="true"></span>
                    </div>
                    <div class="col-md-9">
                        <h4 class="box-title">Approved Orders</h4>
                    </div>
                </div>
                <div><h1 style="text-align: center"><?= $approved_count ?></h1></div>
            </div>
        </div>
    </div>
</div>
