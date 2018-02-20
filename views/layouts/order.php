<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use app\assets\AppAsset;
use kartik\sidenav\SideNav;
use \machour\yii2\notifications\widgets\NotificationsWidget;

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
            'class' => 'navbar navbar-default2 navbar-fixed-top',
        ],
    ]);

    $menuItem []= ['label' => 'Orders', 'url' => Yii::$app->request->baseUrl.'/order/index',
        'active' => $this->context->route == 'order/index',
    ];
    $menuItem []= ['label' => 'Create Order', 'url' => Yii::$app->request->baseUrl.'/order/create',
        'active' => $this->context->route == 'order/create'
    ];
    $menuItem []=  ['label' => 'Account Settings',
        'items' => [
            [
                'label' => '<i class="fa fa-user" aria-hidden="true"></i> &nbsp; <span>Profile</span>',
                'url' => Yii::$app->request->baseUrl.'/user/settings/profile',
                'active' => $this->context->route == 'user/settings/profile'
            ],
            '<li role="separator" class="divider"></li>',
            [
                'label' => '<img src="'.Yii::$app->request->baseUrl.'/images/rating/profile1.png" style="height: 16px; " > &nbsp;<span>Account</span>',
                'url' => Yii::$app->request->baseUrl.'/user/settings/account',
                'active' => $this->context->route == 'user/settings/account'
            ],
            '<li role="separator" class="divider"></li>',
            [
                'label' => '<i class="fa fa-share-square" aria-hidden="true"></i> &nbsp; <span>Networks</span>',
                'url' => Yii::$app->request->baseUrl.'/user/settings/networks',
                'active' => $this->context->route == 'user/settings/networks'
            ],
        ],
    ];

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left'],
        'encodeLabels' => false,
        'items' => $menuItem,
    ]);

    if (Yii::$app->user->isGuest) {
        $menuItems[] = [
            'label' => 'Log In ' , 'url' => Yii::$app->request->baseUrl.'/user/security/login',
            'active' => $this->context->route == 'user/security/login',
        ];
        $menuItems[] = '<a href="'.Yii::$app->request->baseUrl.'/user/register"><button type="button" class="btn btn-primary navbar-btn essay-font">Sign Up</button></a>';
    } else {
//        $menuItems[] = [
//            'label' => $this->params['balance']?
//                '<a style="height: 55px; margin-top: -35px;" href="'.Yii::$app->request->baseUrl.'/wallet/index"> <img style="height: 35px;"
//            src="'.Yii::$app->request->baseUrl.'/images/rating/wallet.png" >'.'<span style="color: black; font-size: 18px; margin-top: 10px"> $'.number_format(floatval($this->params['balance']),
//                    2, '.', ',').'</span>':'<a style="height: 55px; margin-top: -35px;" href="'.Yii::$app->request->baseUrl.'/wallet/index"> <img style="height: 35px;"
//            src="'.Yii::$app->request->baseUrl.'/images/rating/wallet.png"> <span style="color: black; font-size: 18px">$0.00</span>'.'</a>',
//            'active' => $this->context->route == 'wallet/index'
//        ];
        $menuItems[] =
            ''.NotificationsWidget::widget([
                    'theme' => NotificationsWidget::THEME_GROWL,
                    'clientOptions' => [
                        'location' => 'br',
                    ],
                    'counters' => [
                        '.notifications-header-count',
                        '.notifications-icon-count'
                    ],
                    'markAllSeenSelector' => '#notification-seen-all',
                    'listSelector' => '#notifications',
                ]).'
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning notifications-icon-count">0</span>
                    </a>
                    <ul class="dropdown-menu" style="width: auto; min-width: 250px; max-width: 320px">
                        <li class="header">You have <span class="notifications-header-count">0</span> notifications</li>
                        <li>
                            <ul class="menu">
                                <div id="notifications"></div>
                            </ul>
                        </li>
                        <li class="footer"><a href="#">View all</a></li>
                    </ul>
                </li>';
        $menuItems[] = [
            'label' => '<img src="'.Yii::$app->request->baseUrl.'/images/rating/profile1.png" style="height: 35px; margin-top: -5px; margin-bottom: -10px" >',
            'items' => [
                [
                    'label' => '<i class="fa fa-user fa-2x" aria-hidden="true"></i> &nbsp; <span style="font-size: 20px">Profile</span>',
                    'url' => Yii::$app->request->baseUrl.'/user/settings/profile',
                    'active' => $this->context->route == 'user/settings/profile'
                ],
                '<li role="separator" class="divider"></li>',
                [
                    'label' => '<img src="'.Yii::$app->request->baseUrl.'/images/rating/wallet3.png" style="height: 32px; " > &nbsp; <span style="font-size: 20px">Finances</span>',
                    'url' => Yii::$app->request->baseUrl.'/wallet/index',
                    'active' => $this->context->route == 'wallet/index'
                ],
                '<li role="separator" class="divider"></li>',
                [
                    'label' => '<i class="fa fa-sign-out fa-2x" aria-hidden="true"></i> &nbsp; <span style="font-size: 20px"> Logout ('.Yii::$app->user->identity->username.')</span>',
                    'url' => Yii::$app->request->baseUrl.'/user/security/logout',
                    'linkOptions' => ['data-method' => 'post']
                ],
            ],
        ];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'encodeLabels' => false,
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
                <div class="sidebar">
                    <?php
                    $type = 'primary';
                    $item = 'home';
                    echo SideNav::widget([
                        'type' => $type,
                        'indMenuClose'=>'&nbsp;<i class="fa fa-plus" aria-hidden="true"></i>',
                        'indMenuOpen'=>' &nbsp;<i class="fa fa-minus" aria-hidden="true"></i>',
                        'encodeLabels' => false,
                        'heading' => '<i class="fa fa-cog fa-spin" aria-hidden="true"></i> Admin Portal',
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
                            ['label' => '<i class="fa fa-dashboard" aria-hidden="true"></i> Dashboard',  'active' => $this->context->route == 'order/index','url' => Yii::$app->request->baseUrl.'/order/index'],

                            ['label' => '<i class="fa fa-plus " aria-hidden="true"></i> Place Order', 'active' => $this->context->route == 'order/create', 'url' => Yii::$app->request->baseUrl.'/order/create'],
                            ['label' => $this->params['pending_count'] ? '<i class="fa fa-list " aria-hidden="true"></i> <span class="pull-right badge">'.$this->params['pending_count'].'</span> Pending':
                                '<i class="fa fa-list " aria-hidden="true"></i> Pending Orders', 'active' => $this->context->route == 'order/pending','url' => Yii::$app->request->baseUrl.'/order/pending'],
                            ['label' => $this->params['available_count'] ? '<i class="fa fa-clock-o" aria-hidden="true"></i> <span class="pull-right badge">'.$this->params['available_count'].'</span> Available Orders':
                                '<i class="fa fa-clock-o" aria-hidden="true"></i> Available Orders', 'active' => $this->context->route == 'order/available', 'url' => Yii::$app->request->baseUrl.'/order/available'],
                            ['label' =>  $this->params['bids_count'] ? '<i class="fa fa-question-circle-o" aria-hidden="true"></i> <span class="pull-right badge">'.$this->params['bids_count'].'</span> Bids':
                                '<i class="fa fa-question-circle-o" aria-hidden="true"></i> Bids',  'options'=>['class'=>'nav-link disabled'], 'active' => $this->context->route == 'order/bids', 'url' => Yii::$app->request->baseUrl.'/#'],
                            ['label' => $this->params['unconfirmed_count'] ? '<i class="fa fa-tasks" aria-hidden="true"></i> <span class="pull-right badge">'.$this->params['unconfirmed_count'].'</span> Unconfirmed Orders':
                                '<i class="fa fa-tasks" aria-hidden="true"></i> Unconfirmed Orders', 'active' => $this->context->route == 'order/unconfirmed','url' => Yii::$app->request->baseUrl.'/order/unconfirmed'],
                            ['label' => $this->params['confirmed_count'] ? '<span class="glyphicon glyphicon-check" aria-hidden="true"></span> <span class="pull-right badge">'.$this->params['confirmed_count'].'</span> Confirmed Orders':
                                '<span class="glyphicon glyphicon-check" aria-hidden="true"></span> Confirmed Orders', 'active' => $this->context->route == 'order/confirmed', 'url' => Yii::$app->request->baseUrl.'/order/confirmed'],
                            ['label' => $this->params['editing_count'] ? '<span class="glyphicon glyphicon-edit" aria-hidden="true"></span> <span class="pull-right badge">'.$this->params['editing_count'].'</span> Editing':
                                '<span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Editing Orders', 'active' => $this->context->route == 'order/editing', 'url' => Yii::$app->request->baseUrl.'/order/editing'],
                            ['label' => $this->params['active_count'] ? '<i class="fa fa-spinner fa-spin" aria-hidden="true"></i> <span class="pull-right badge">'.$this->params['active_count'].'</span> In Progress':
                                '<i class="fa fa-spinner fa-spin" aria-hidden="true"></i> In Progress', 'active' => $this->context->route == 'order/active', 'url' => Yii::$app->request->baseUrl.'/order/active'],
                            ['label' => $this->params['completed_count'] ? '<i class="fa fa-thumbs-up " aria-hidden="true"></i> <span class="pull-right badge">'.$this->params['completed_count'].'</span> Completed Orders':
                                '<i class="fa fa-thumbs-up " aria-hidden="true"></i> Completed Orders', 'active' => $this->context->route == 'order/completed', 'url' => Yii::$app->request->baseUrl.'/order/completed'],
                            ['label' => $this->params['revision_count'] ? '<span class="glyphicon glyphicon-repeat" aria-hidden="true"></span> <span class="pull-right badge">'.$this->params['revision_count'].'</span> Revision Orders':
                                '<span class="glyphicon glyphicon-repeat" aria-hidden="true"></span> Revision Orders', 'active' => $this->context->route == 'order/revision', 'url' => Yii::$app->request->baseUrl.'/order/revision'],
                            ['label' => $this->params['rejected_count'] ? '<i class="fa fa-thumbs-down" aria-hidden="true"></i> <span class="pull-right badge">'.$this->params['Rejected_count'].'</span> Rejected Orders':
                                '<i class="fa fa-thumbs-down" aria-hidden="true"></i> Rejected Orders', 'active' => $this->context->route == 'order/rejected', 'url' => Yii::$app->request->baseUrl.'/order/rejected'],
                            ['label' => $this->params['disputed_count'] ? '<i class="fa fa-legal" aria-hidden="true"></i> <span class="pull-right badge">'.$this->params['disputed_count'].'</span> Disputed Orders':
                                '<i class="fa fa-legal" aria-hidden="true"></i> Disputed Orders', 'active' => $this->context->route == 'order/disputed', 'url' => Yii::$app->request->baseUrl.'/order/disputed'],
                            ['label' => $this->params['approved_count'] ? '<i class="fa fa-check" aria-hidden="true"></i> <span class="pull-right badge">'.$this->params['approved_count'].'</span> Approved Orders':
                                '<i class="fa fa-check " aria-hidden="true"></i> Approved Orders', 'active' => $this->context->route == 'order/approved', 'url' => Yii::$app->request->baseUrl.'/order/approved'],
                            ['label' => '<i class="fa fa-cogs" aria-hidden="true"></i> Settings', 'items' => [
                                ['label' => 'Academic Levels', 'active' => $this->context->route == 'level/index', 'url' => Yii::$app->request->baseUrl.'/level/index'],
                                ['label' => 'Styles', 'active' => $this->context->route == 'style/index','url' => Yii::$app->request->baseUrl.'/style/index'],
                                ['label' => 'Languages','active' => $this->context->route == 'language/index', 'url' => Yii::$app->request->baseUrl.'/language/index'],
                                ['label' => 'Urgency', 'active' => $this->context->route == 'urgency/index','url' => Yii::$app->request->baseUrl.'/urgency/index'],
                                ['label' => 'Spacing', 'active' => $this->context->route == 'spacing/index','url' => Yii::$app->request->baseUrl.'/spacing/index'],
                                ['label' => 'subjects', 'active' => $this->context->route == 'subject/index','url' => Yii::$app->request->baseUrl.'/subject/index'],
                                ['label' => 'pages', 'active' => $this->context->route == 'pages/index', 'url' => Yii::$app->request->baseUrl.'/page/index'],
                                ['label' => 'Types', 'active' => $this->context->route == 'type/index', 'url' => Yii::$app->request->baseUrl.'/Type/index'],
                                ['label' => 'Services',  'active' => $this->context->route == 'service/index', 'url' => Yii::$app->request->baseUrl.'/service/index'],
                                ['label' => 'Sources', 'active' => $this->context->route == 'source/index','url' => Yii::$app->request->baseUrl.'/source/index'],
                            ]],
                            ['label' => '<img src="'.Yii::$app->request->baseUrl.'/images/rating/settings.png" style="height: 24px; " > Account Settings', 'items' => [
                                ['label' => 'Profile', 'active' => $this->context->route == 'user/settings/profile', 'url' => Yii::$app->request->baseUrl.'/user/settings/profile'],
                                ['label' => 'Account', 'active' => $this->context->route == 'user/settings/account','url' => Yii::$app->request->baseUrl.'/user/settings/account'],
                                ['label' => 'Networks', 'active' => $this->context->route == 'user/settings/networks','url' => Yii::$app->request->baseUrl.'/user/settings/networks'],
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

<footer class="footer" style="background-color: white; border-top-color: #0f0f0f;">
    <div class="container">
        <diV class="row" style="margin-top: -5px">
            <div class="col-md-1"></div>
            <div class="col-md-5 navigation" style="margin-top: 5px">
                <ul class="pull-left">
                    <li><p  class="essay-font" style="font-size: 13px; color: #666666;"><?= Yii::$app->name?> &copy; <?= date('Y') ?>  All Rights Reserved &nbsp; </p></li>
                    <li><a href="<?= \yii\helpers\Url::to(['site/termss'])?>"> &nbsp; Terms and Conditions</a></li>
                </ul>
            </div>
            <div class="col-md-5">
                <ul class="pull-right pay-cards">
                    <li><img style="margin-left: 26px" src="<?= Yii::$app->request->baseUrl?>/images/rating/visapro.jpg"  alt="Visa" class="pm visa"></li>
                    <li><img style="margin-left: 26px" src="<?= Yii::$app->request->baseUrl?>/images/rating/amexpro.jpg" alt="American Express" class="pm ae"></li>
                    <li><img style="margin-left: 26px" src="<?= Yii::$app->request->baseUrl?>/images/rating/mcard.jpg" alt="MasterCard" class="pm mc"></li>
                    <li><img style="margin-left: 26px" src="<?= Yii::$app->request->baseUrl?>/images/rating/paypalpro.jpg" alt="PayPal" class="pm paypal"></li>
                </ul>
            </div>
            <div class="col-md-1">

            </div>
        </diV>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
