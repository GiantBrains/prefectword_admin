<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Html::img('@web/images/logo.png', ['style'=>'display:inline-block; height:32px;', 'alt'=>Yii::$app->name]). ' <strong style="color: #71D8EC; font-size: 20px;">Verified</strong><strong style="color: #3D715B; font-size: 20px;">Professors</strong>',
        'brandUrl' => Yii::$app->request->baseUrl.'/',
        'options' => [
            'class' => 'navbar navbar-default navbar-fixed-top',
        ],
    ]);

    $menuItem []= ['label' => 'Admin', 'url' => ['/'],
        'active' => $this->context->route == 'site/index',
    ];

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left'],
        'items' => $menuItem,
    ]);

    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Log In ' , 'url' => Yii::$app->request->baseUrl.'/site/login',
            'active' => $this->context->route == 'site/login',
        ];
    } else {
        $menuItems[] = [
            'label' => 'Dashboard',
            'url' => Yii::$app->request->baseUrl.'/site/index',
            'active' => $this->context->route == 'site/index'
        ];

        $menuItems[] = '<a data-method="post" href="'.Yii::$app->request->baseUrl.'/site/logout">
                        <button type="button" class="btn btn-danger navbar-btn essay-font">Logout ('.Yii::$app->user->identity->username.')</button></a>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>
    <div style="margin-top: 60px">
        <?= Alert::widget() ?>
    </div>
    <div style="margin-top: -10px">
        <?= $content ?>
    </div>
</div>

<footer class="footer" style="background-color: #242a35; height: auto">
    <div class="container" style="height: auto">
        <div id="navigation" style=" height: 40px; margin-bottom: 30px">
            <ul class="pull-left footer-link essay-font" style="font-size: 13px; color: #a1a9b3">
                <li><a href="#">&nbsp; Become a Writer &nbsp;</a></li>
                <li><a href="#">&nbsp; Affiliate Program &nbsp;</a></li>
                <li><a href="#">&nbsp; Blog &nbsp;</a></li>
                <li><a href="#">&nbsp; FAQ &nbsp;</a></li>
                <li><a href="#">&nbsp; Reviews &nbsp;</a></li>
                <li><a href="#">&nbsp; Contact Us &nbsp;</a></li>
            </ul>

            <ul class="pull-right">
                <li><img src="<?= Yii::$app->request->baseUrl?>/images/payment/visa.png"  width="40px" height="13px"  data-rjs="<?= Yii::$app->request->baseUrl?>/images/payment/visa.png" alt="Visa" class="pm visa"></li>
                <li><img src="<?= Yii::$app->request->baseUrl?>/images/payment/amex.png" width="57px" height="19px" data-rjs="<?= Yii::$app->request->baseUrl?>/images/payment/amex.png" alt="American Express" class="pm ae"></li>
                <li><img src="<?= Yii::$app->request->baseUrl?>/images/payment/mastercard.png" width="45px" height="27px" data-rjs="<?= Yii::$app->request->baseUrl?>/images/payment/mastercard.png" alt="MasterCard" class="pm mc"></li>
                <li><img src="<?= Yii::$app->request->baseUrl?>/images/payment/paypal.png" width="60px" height="17px" data-rjs="<?= Yii::$app->request->baseUrl?>/images/payment/paypal.png" alt="PayPal" class="pm paypal"></li>
                <li><a class="f-link essay-font" style="font-size: 13px;" href="#">Terms and Conditions</a></li>
                <li><a class="f-link essay-font" style="font-size: 13px;"  href="#">Privacy Policy</a></li>
            </ul>
        </div><!-- navigation -->

        <div style="margin-top: 30px">
            <p  class="essay-font" style="text-align: center; font-size: 13px; color: #a1a9b3"><?= Yii::$app->name?> &copy; <?= date('Y') ?>  All Rights Reserved</p>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
