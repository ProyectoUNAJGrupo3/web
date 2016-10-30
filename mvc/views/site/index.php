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
use app\assets\PSCssAsset;
PSCssAsset::register($this);
/* @var $this yii\web\View */
?>
<div class="site-index">
    <div id="contenedor-home">
        <table width="1500" height="552" border="0" background="img/REMISEJECUTIVO2.jpg">
            <tr>
                <td>
                    <div style="background-image:url(REMISEJECUTIVO2.jpg);
                             background-repeat:no-repeat; background-position:-50px 50px">
                        <h1>
                            <b>

                                <font id="titulo-contenido" size=+1>BIENVENIDOS A REMIS YA! </font>

                            </b>
                        </h1>
                        <p>
                            <a id="boton" class="btn btn-primary" href="http://www.yiiframework.com">SOLICITE SU REMIS</a>
                        </p>;


                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>




<div id="jumbotron">
    <div class="jumbotron">




        <div id="btn-bar">
            <?= Html::button('Solicitar Servicio Remiseria', ['class' => 'btn btn-primary', 'name' => 'contact-button', 'id' => 'btn-solcitar-remis']) ?>
            <?= Html::button('Listar Remiserias', ['class' => 'btn btn-primary', 'name' => 'contact-button', 'id' => 'btn-ver-remiserias']) ?>
            <?= Html::button('Obtener ubicaci&oacute;n en el Mapa', ['class' => 'btn btn-primary', 'name' => 'contact-button', 'id' => 'btn-obtener-ubicacion-en-el-mapa']) ?>
        </div>







    </div>
</div>

