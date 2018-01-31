<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use app\assets\AppAsset;
use kartik\sidenav\SideNav;

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
        'brandLabel' => Html::img('@web/images/logo.png', ['style'=>'display:inline-block; height:32px;', 'alt'=>Yii::$app->name]). ' <strong style="color: #5bc0de; font-size: 20px; border-color: #46b8da;">Doctorate</strong><strong style="color: midnightblue; font-size: 20px;">Essays</strong>',
        'brandUrl' => Yii::$app->request->baseUrl.'/',
        'options' => [
            'class' => 'navbar navbar-default1 navbar-fixed-top',
        ],
    ]);

    $menuItem []= ['label' => 'Writers', 'url' => ['/'],
        'active' => $this->context->route == 'site/index',
    ];
    $menuItem []= ['label' => 'How it Works', 'url' => ['/about'],
        'active' => $this->context->route == 'site/about'
    ];
    $menuItem []=  ['label' => 'Services', 'url' => ['/contact'],
        'active' => $this->context->route == 'site/contact'
    ];
    $menuItem []=  ['label' => 'About Us', 'url' => ['/contact'],
        'active' => $this->context->route == 'site/about'
    ];

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left'],
        'items' => $menuItem,
    ]);

    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Log In ' , 'url' => Yii::$app->request->baseUrl.'/user/security/login',
            'active' => $this->context->route == 'user/security/login',
        ];
    } else {
        $menuItems[] = [
            'label' => 'Dashboard',
            'url' => Yii::$app->request->baseUrl.'/site/index',
            'active' => $this->context->route == 'site/index'
        ];

        $menuItems[] = '<a data-method="post" href="'.Yii::$app->request->baseUrl.'/user/security/logout">
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
    <div class="mycontent">
        <div class="row" style="margin-right: 0; margin-left: 0;">
            <div class="col-md-3">
                <div>
                    <?php
                    $type = 'primary';
                    $item = 'home';
                    echo SideNav::widget([
                        'type' => $type,
                        'encodeLabels' => false,
                        'heading' => '<i class="glyphicon glyphicon-cog"></i> Operations',
                        'items' => [
                            //
                            //
                            // Important: you need to specify url as 'controller/action',
                            // not just as 'controller' even if default action is used.
                            //
                            // NOTE: The variable `$item` is specific to this demo page that determines
                            // which menu item will be activated. You need to accordingly define and pass
                            // such variables to your view object to handle such logic in your application
                            // (to determine the active status).
                            //
                            //
                            ['label' => '<i class="fa fa-dashboard" aria-hidden="true"></i> Dashboard', 'url' => Yii::$app->request->baseUrl.'/order/index'],
                            ['label' => '<i class="fa fa-plus " aria-hidden="true"></i> <span class="pull-right badge">10</span> Place Order', 'url' => Yii::$app->request->baseUrl.'/order/create'],
                            ['label' => '<i class="fa fa-list " aria-hidden="true"></i> <span class="pull-right badge">5</span> Pending Orders', 'url' => Yii::$app->request->baseUrl.'/order/pending'],
                            ['label' => '<i class="fa fa-check " aria-hidden="true"></i> <span class="pull-right badge">5</span> In Progress', 'url' => Yii::$app->request->baseUrl.'/order/progress'],
                            ['label' => '<i class="fa fa-recycle" aria-hidden="true"></i> <span class="pull-right badge">5</span> Revision', 'url' => Yii::$app->request->baseUrl.'/order/revision'],
                            ['label' => '<i class="fa fa-edit " aria-hidden="true"></i> <span class="pull-right badge">5</span> Editing', 'url' => Yii::$app->request->baseUrl.'/order/editing'],
                            ['label' => '<i class="fa fa-trophy " aria-hidden="true"></i> <span class="pull-right badge">5</span> Completed', 'url' => Yii::$app->request->baseUrl.'/order/completed'],
                            ['label' => '<i class="fa fa-thumbs-up" aria-hidden="true"></i> <span class="pull-right badge">5</span> Approved Orders', 'url' => Yii::$app->request->baseUrl.'/order/approved'],
                            ['label' => '<i class="fa fa-thumbs-down " aria-hidden="true"></i> <span class="pull-right badge">5</span> Rejected Orders', 'url' => Yii::$app->request->baseUrl.'/order/rejected'],
                            ['label' => '<i class="fa fa-legal" aria-hidden="true"></i> <span class="pull-right badge"> 5</span> Disputed Orders', 'url' => Yii::$app->request->baseUrl.'/order/disputed'],
                            ['label' => '<span class="pull-right badge">2</span> Messages', 'icon' => 'bullhorn', 'items' => [
                                ['label' => 'Unread Messages', 'url' => Yii::$app->request->baseUrl.'/message/unread?type='.$type.''],
                                ['label' => 'sent items', 'url' => Yii::$app->request->baseUrl.'/message/sent?type='.$type.''],
                                ['label' => 'Inbox', 'url' => Yii::$app->request->baseUrl.'/message/inbox?type='.$type.''],
                            ],
                            ],
                            ['label' => '<img src="'.Yii::$app->request->baseUrl.'/images/rating/settings.png" style="height: 24px; " > Settings', 'items' => [
                                ['label' => 'Profile', 'url' => Yii::$app->request->baseUrl.'/user/settings/profile'],
                                ['label' => 'Account', 'url' => Yii::$app->request->baseUrl.'/user/settings/account'],
                                ['label' => 'Networks', 'url' => Yii::$app->request->baseUrl.'/user/settings/networks'],
                            ],
                            ],
                        ],
                    ]);
                    ?>
                </div>
            </div>
            <div class="col-md-9" style="padding-left: 10px; padding-right: 0">
                <?= $content ?>
            </div>
        </div>
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
