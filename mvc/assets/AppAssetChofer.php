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
class AppAssetChofer extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        /*         * ******************************************************************* */
        /*         * **********************Agencia************************************** */
        'css/site.css',
        /*         * ******************************************************************* */
        /*         * **********************Recepcionista******************************** */
        'css/styleContentMap.css',
        /*         * ******************************************************************* */
        /*         * **********************Chofer******************************** */
        'css/styleFooter.css',
        /*         * ******************************************************************* */
        /*         * **********************Usuario******************************** */
        'css/StyleFormularioUsuario.css',
        'css/styleHeader.css',
        'css/styleHome.css',
        'css/styleLoginPopup.css',
        'css/styleNuestrosClientes.css',
        'css/stylePagesHtml.css',
        'css/styleQuienesSomos.css',
        'css/recepcionista/styleFormulariosVehiculo.css',
        'css/recepcionista/styleFormularioEmpleado.css',
        'css/styleAccesoDenegado.css',
        'css/styleHome.css',
        'css/styleHomeAgencia.css',
        'css/styleCargarNuevoViajeManual',
        'css/styleSolictudRemisManual.css',
        'css/styleAltaChofer.css',
        'css/styleSolictudServicioRemis.css',
        'css/styleSolicitudServcioRemisCliente.css',
        'css/styleSolicitudRegistrarAgencia.css',
        'css/styleListarSolicitudesDesdeRecepcionista.css',
        'css/styleVerDatosSolictudServicioDesdeRecepcionista.css',
    ];
    public $js = [
        'js/Maps.js',
        'js/Mapas.js',
        'js/AperturaPopupLogin.js',
        'js/choferModal.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
