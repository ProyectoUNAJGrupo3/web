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
$this->title = 'Service Remis';
?>
<div class="site-index">

    <!--<div class="jumbotron">
        <h1>Congratulations!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
    </div>-->

    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDMVbdR-TGis783bW9rB9tZUJXVXsIRzkQ&libraries=places"></script>

    <!--<div class="jumbotron">
        <h1>Congratulations!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
    </div>-->

    <div id="contenedor-home">


        <div id="titulo">
            <div>
                <h1 id="titulo-contenido" size="50px">Bienvenido a RemisYA</h1>
            </div>
        </div>

        <div id="descripcion">
            <strong>
                <p>
                    Por medio de la aplicaci&oacute;n usted podr&aacute; solicitar el servicio de remis prestado por las agencias.
                    Para ello, usted contar&aacute; con la posiblidad de listar las agenias m&aacute;s cercanas y podr&aacute; pedir una prestaci&oacute;n
                    mediante la opci&oacute;n "Solicitar Servicio Remiseria".
                </p>
            </strong>
        </div>

        <div id="bar-buttons">
            <div id="btn-bar">
                <?= Html::button('Solicitar Servicio Remiseria', ['class' => 'btn btn-primary', 'name' => 'contact-button', 'id' => 'btn-solcitar-remis']) ?>
                <?= Html::button('Listar Remiserias', ['class' => 'btn btn-primary', 'name' => 'contact-button', 'id' => 'btn-ver-remiserias']) ?>
                <?= Html::button('Obtener ubicaci&oacute;n en el Mapa', ['class' => 'btn btn-primary', 'name' => 'contact-button', 'id' => 'btn-obtener-ubicacion-en-el-mapa']) ?>
            </div>


            <div id="mapHome"></div>
            <div id="dvMapHome">
                <?php
                $coord = new LatLng(['lat' => 39.720089311812094, 'lng' => 2.91165944519042]);
                $map = new Map([
                    'center' => $coord,
                    'zoom' => 14,
                ]);

                // lets use the directions renderer
                $home = new LatLng(['lat' => 39.720991014764536, 'lng' => 2.911801719665541]);
                $school = new LatLng(['lat' => 39.719456079114956, 'lng' => 2.8979293346405166]);
                $santo_domingo = new LatLng(['lat' => 39.72118906848983, 'lng' => 2.907628202438368]);

                // setup just one waypoint (Google allows a max of 8)
                $waypoints = [
                    new DirectionsWayPoint(['location' => $santo_domingo])
                ];

                $directionsRequest = new DirectionsRequest([
                    'origin' => $home,
                    'destination' => $school,
                    'waypoints' => $waypoints,
                    'travelMode' => TravelMode::DRIVING
                ]);

                // Lets configure the polyline that renders the direction
                $polylineOptions = new PolylineOptions([
                    'strokeColor' => '#FFAA00',
                    'draggable' => true
                ]);

                // Now the renderer
                $directionsRenderer = new DirectionsRenderer([
                    'map' => $map->getName(),
                    'polylineOptions' => $polylineOptions
                ]);

                // Finally the directions service
                $directionsService = new DirectionsService([
                    'directionsRenderer' => $directionsRenderer,
                    'directionsRequest' => $directionsRequest
                ]);

                // Thats it, append the resulting script to the map
                $map->appendScript($directionsService->getJs());

                // Lets add a marker now
                $marker = new Marker([
                    'position' => $coord,
                    'title' => 'My Home Town',
                ]);

                // Provide a shared InfoWindow to the marker
                $marker->attachInfoWindow(
                        new InfoWindow([
                    'content' => '<p>This is my super cool content</p>'
                        ])
                );

                // Add marker to the map
                $map->addOverlay($marker);

                // Now lets write a polygon
                $coords = [
                    new LatLng(['lat' => 25.774252, 'lng' => -80.190262]),
                    new LatLng(['lat' => 18.466465, 'lng' => -66.118292]),
                    new LatLng(['lat' => 32.321384, 'lng' => -64.75737]),
                    new LatLng(['lat' => 25.774252, 'lng' => -80.190262])
                ];

                $polygon = new Polygon([
                    'paths' => $coords
                ]);

                // Add a shared info window
                $polygon->attachInfoWindow(new InfoWindow([
                    'content' => '<p>This is my super cool Polygon</p>'
                ]));

                // Add it now to the map
                $map->addOverlay($polygon);


                // Lets show the BicyclingLayer :)
                $bikeLayer = new BicyclingLayer(['map' => $map->getName()]);

                // Append its resulting script
                $map->appendScript($bikeLayer->getJs());

// Display the map -finally :)
                echo $map->display()
                ?>
            </div>
        </div>
    </div>
</div>