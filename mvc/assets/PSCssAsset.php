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
class PSCssAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/styleContentMap.css',
        'css/styleFooter.css',
        'css/StyleFormularioUsuario.css',
        'css/styleHeader.css',
        'css/styleHome.css',
        'css/styleLoginPopup.css',
        'css/styleNuestrosClientes.css',
        'css/stylePagesHtml.css',
        'css/styleQuienesSomos.css',
        'css/styleFormulariosVehiculo.css',
        'css/styleFormularioEmpleado.css',
        'css/styleAccesoDenegado.css',
        'css/styleHome.css',
        'css/styleHomeAgencia.css',
        'css/styleCargarNuevoViaje.css',
        'css/styleSolictudServicio.css',
        
    ];
    public $js = [
        'js/Maps.js',
        'js/Mapas.js',
        'js/AperturaPopupLogin.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
