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
                    <div style="background-image:url(REMISEJECUTIVO5.jpg);
                             background-repeat:no-repeat; background-position:-50px 50px">
                        <h1>
                            <br />
                            <br>
                            <b>
                                <font id="titulo-contenido" size=+2>BIENVENIDOS A REMIS YA! </font>
                                <b>
                                    <br />
                                    <br />
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
        <div class="row">
            <div id="col-lg-4">
                <div class="col-lg-4">
                   <h2>
                        <img src="img/telefono.jpg" id="telefono.jpg" />   Pedir remises Online
                    </h2>

                    <p>  
                      
                        Usted puede Eliegir la mejor opcion de remiseria, pudiendo seleccionar la mas cercana, o la que ofresca el mejor precio y servicio adaptandose a sus necesidades.
                        
                     </p>




                </div>
                <div class="col-lg-4">
                   <h2>
                       <img src="img/negocio.jpg" id="negocio.jpg" />  Administre su propia Agencia Online
                    </h2>
                    <p>
                        Ofrecemos un Sistema donde Usted pueda mejorar la gestion de su propia Agencia Online de remises, pudiendo obtener un seguimiento de las distintas actividades de su empresa de una manera simple y eficiente.
                    </p>

                </div>
                <div class="col-lg-4">
                    <h2>
                     <img src="img/pesos.jpg" id="pesos.jpg" />  Optimice los costos de Su Agencia
                    </h2>
                    <p>
                        El Sistema le brinda el servicio donde usted realice sus actividades pudiendo obtener gestion eficiente de costos y ganancias obtenidas.
                    </p>

                </div>
            </div>

        </div>
    </div>

</div>
<div id="jumbotron">
    <div class="jumbotron">
        <div class="row">
            <div id="col-lg-4">

                <div class="col-lg-4">
                    <h2>
                        <img src="img/persona.jpg" id="persona.jpg" />Atenci&oacute;n al cliente
                    </h2>

                    <p>
                        Atenci&oacute;n personalizada de operadores telef&oacute;nicos las 24 HS orientados al cliente. Choferes capacitados. Pr&oacute;ximamente, reservas on-line desde nuestra pagina
                    </p>

                </div>
                <br />
                <br />
                <br />



                <div class="col-lg-4">
                    <h2>
                        <img src="img/seguridad-logo.png" id="seguridad-logo.png" />Seguridad
                    </h2>
                    <p>
                        Las Agencias pueden hacer un seguimiento de la flota v&iacute;a web. Los clientes pueden obtener datos Chofer y del m&oacute;vil asignado.
                    </p>

                </div>
                <div class="col-lg-4">
                    <h2>
                        <img src="img/24horas2.jpg" id="24horas2.jpg" />24 Horas
                    </h2>
                    <p>
                        Las Remiserias con las que se puede conectar cuentan con central de reservas que se encuentra a su entera disposici&oacute;n durante las 24 horas.
                    </p>

                </div>
            </div>

        </div>
    </div>
