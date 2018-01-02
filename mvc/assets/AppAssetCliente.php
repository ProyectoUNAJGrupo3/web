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
class AppAssetCliente extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'cssCliente/styleContentMap.css',
        'cssCliente/styleSolicitudServcioRemisCliente.css',
        'cssCliente/styleSolicitudRegistrarAgencia.css',
    ];
    public $js = [
        'js/Mapas.js',
        'js/PopupCliente.js',
        'js/notify.min.js',
        'https://maps.googleapis.com/maps/api/js?key=AIzaSyDMVbdR-TGis783bW9rB9tZUJXVXsIRzkQ&libraries=places,geometry',
        'https://js.pusher.com/3.2/pusher.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
