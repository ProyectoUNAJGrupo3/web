<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class BootswatchAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'cssMainPage/styleHome.css',
    ];
    public $js = [
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'raoul2000\bootswatch\BootswatchAsset',
    ];

}
