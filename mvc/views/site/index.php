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



<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDMVbdR-TGis783bW9rB9tZUJXVXsIRzkQ&libraries=places"></script>
<div class="site-contact">
    <section id="main">
        <article id="imagen-fondo">
            <div style="background-image: url(img/REMISEJECUTIVO5.jpg); background-repeat:no-repeat; " >
                <div>
                    <b>
                        <p id="titulo-contenido"> Bienvenidos a Remis ya!
                        </p>
                        <p id="titulo-contenido-dos">
                            Mejore la manera y el desempe&ntilde;o  de Gestionar su Agencia
                        </p>
                    </b>
                </div>
                <div>
                    <a id="boton-solicitar-remis" class="btn btn-primary" href="#">   SOLICITE SU REMIS</a>
                </div>
                

            </div>

        </article>
        <article id="description">
            <div class="jumbotron">
                <div class="row">
                    <div id="col-lg-4">
                        <div class="col-lg-4">
                            <h2>
                                <img src="img/telefono.jpg" id="telefono.jpg" />   Pedir remises Online
                            </h2>

                            <p>                        
                                Usted puede Elegir la mejor opcion de remiseria, seleccionando la m&aacute;s cercana, o la que ofresca el mejor precio y servicio adaptandose a sus necesidades.                       
                            </p>

                        </div>
                        <div class="col-lg-4">
                            <h2>
                                <img src="img/negocio.jpg" id="negocio.jpg" />  Administre su propia Agencia Online
                            </h2>
                            <p>
                                Ofrecemos un Sistema donde Usted pueda mejorar la gestion de su propia Agencia de remises, pudiendo obtener un seguimiento de las distintas actividades de su empresa de una manera simple y eficiente.
                            </p>

                        </div>
                        <div class="col-lg-4">
                            <h2>
                                <img src="img/pesos.jpg" id="pesos.jpg" /> Optimice los costos de Su Agencia
                            </h2>
                            <p>
                                El servicio del sistema le permite realizar sus actividades, pudiendo obtener gestion eficiente de costos y ganancias obtenidas.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="jumbotron">
                <div class="row">
                    <div id="col-lg-4">
                        <div class="col-lg-4">
                            <h2>
                                <img src="img/persona.jpg" id="persona.jpg" />  Atenci&oacute;n al cliente
                            </h2>
                            <p>
                                Atenci&oacute;n personalizada de operadores telef&oacute;nicos orientados al cliente, Choferes capacitados, reservas on-line, son algunos de los beneficios de utilizar esta Aplicaci&oacute;n.
                            </p>
                        </div>                                 
                        <div class="col-lg-4">
                            <h2>
                                <img src="img/seguridad-logo.png" id="seguridad-logo.png" />Seguridad
                            </h2>
                            <p>
                                Las Agencias pueden hacer un seguimiento de la flota v&iacute;a web. Los clientes pueden obtener datos Chofer y del m&oacute;vil asignado Adem&aacute;s de poder calificar su atenci&oacute;n.
                            </p>
                        </div>
                        <div class="col-lg-4">
                            <h2>
                                <img src="img/24horas2.jpg" id="24horas2.jpg" />  24 Horas
                            </h2>
                            <p>
                                Servicio de durante todo el a&ntilde;o, calidad, confianza.
                            </p>
                        </div>
                    </div>
                </div>
        </article>
    </section>
</div>


