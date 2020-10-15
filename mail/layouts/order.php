<?php
use yii\helpers\Html;

/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\MessageInterface the message being composed */
/* @var $content string main view render result */
$logolink = \yii\helpers\Url::to('/images/logo.png', true);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?= Yii::$app->charset ?>" />
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<header>
    <?= Html::img($logolink, ['style'=>'display:inline-block; height:50px;', 'alt'=>Yii::$app->name]). ' <strong style="color: #5bc0de; font-size: 30px; border-color: #46b8da;">Verified</strong><strong style="color: midnightblue; font-size: 30px;">Professors</strong>'?>
</header>
<?= $content ?>
<footer> <?= Yii::$app->name ?> &copy; <?= date(' Y') ?></footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
