<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/font-awesome.min.css',
        '//fonts.googleapis.com/css?family=Mukta+Malar:200,300,400,500,600,700,800
        |Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i',
    ];
    public $cssOptions = [
        'type' => 'text/css',
    ];
    public $js = [
        'js/moment.js',
        'js/moment-timezone.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
