<?php

use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\services\DirectionsWayPoint;
use dosamigos\google\maps\services\TravelMode;
use dosamigos\google\maps\overlays\PolylineOptions;
use dosamigos\google\maps\services\DirectionsRenderer;
use dosamigos\google\maps\services\DirectionsService;
use dosamigos\google\maps\overlays\InfoWindow;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\services\DirectionsRequest;
use dosamigos\google\maps\overlays\Polygon;
use dosamigos\google\maps\layers\BicyclingLayer;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this yii\web\View */
$this->title = 'Service Remis';
?>
<div class="site-index">

    <!--<div class="jumbotron">
        <h1>Congratulations!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
    </div>-->

    <div class="body-content">


        <div id="titulo">
            <div><h1 id="titulo-contenido" size="50px">Bienvenido a Service Remis</h1></div>
        </div>

        <div id="descripcion">
            <strong><p>
                    Por medio de la aplicaci&oacute;n usted podr&aacute; solicitar el servicio de remis prestado por las agencias.
                    Para ello, usted contar&aacute; con la posiblidad de listar las agenias m&aacute;s cercanas y mediante la
                    opci&oacute;n "solicitar servicio remiseria", usted podr&aacute; pedir una prestaci&oacute;n.
                </p></strong>
        </div>

        <div id="bar-buttons">
            <div id="btn-bar">
                <?= Html::button('Solicitar Servicio Remiseria', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                <?= Html::button('Listar Remiserias', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
            </div>


            <div id="mapHome">
            </div>
            <div id="dvMapHome">
            </div>
        </div>
    </div>
</div>