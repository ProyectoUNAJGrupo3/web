<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAssetWebSite;
use app\assets\AppAsset;
use yii\widgets\ActiveForm;
AppAsset::register($this);
AppAssetWebSite::register($this);
/* @var $this yii\web\View */
$this->title = 'Service Remis';
?>
<div class="site-index">

    <!--<div class="jumbotron">
        <h1>Congratulations!</h1>
        <p class="lead">You have successfully created your Yii-powered application.</p>
        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
    </div>-->
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
                    Para seleccionar una ubicacion escriban la direccion en el buscador con el texto "Busca tu partido"
                    O hagan click secundario sobre el mapa, tanto para la primer ubicacion como para la segunda
                    <br />
                    para modificar la eleccion arrastren el marcador A o B y se recalcula la distancia y el importe.

                </p>
            </strong>
        </div>
        <?php $form = ActiveForm::begin(); ?>

        <div id="bar-buttons">
            <div id="btn-bar">
                <?= Html::submitButton('Solicitar Servicio Remiseria', ['class' => 'btn btn-primary','disabled' => true, 'name' => 'contact-button', 'id' => 'btn-solcitar-remis']) ?>
                <?= Html::button('Listar Remiserias', ['class' => 'btn btn-primary disable','disabled' => true, 'name' => 'contact-button', 'id' => 'btn-ver-remiserias']) ?>
                <?=
                $this->registerJs('$(document).ready(function () {
            initMap(true);
            $("#btn-ver-remiserias").on("click", function() {doTheAjax()});
            });', \yii\web\View::POS_READY);
                ?>
                <label id="distancia" class="display:none colorBlack">
                    <strong>
                        <p>
                            Distancia :
                        </p>

                    </strong>
                </label>
                <?= $form->field($model, 'Distancia')->hiddenInput(['id' => 'FieldDistance'])->label(false); ?>

            </div>



            <div id="mapHome" class="col-md-8">
                <div id="map-Index">
                    <div id="map"></div>
                </div>
                <input id="pac-input" class="controls colorBlack" type="text" placeholder="Busca tu partido / barrio " />
            </div>
            <div class="col-md-4 colorBlack  panel panel-primary">

                <div class="panel-heading ">
                    <b>
                        <h3>
                            Datos del viaje:
                        </h3>
                    </b>
                </div>
                <div class="panel-body">


                    <?= $form->field($model, 'OrigenTexto')->input("text", ['id'=>'origenTexto','readonly' => true])->label("Origen"); ?>
                    <?= $form->field($model, 'origen')->hiddenInput(['id' => 'origencoordenada'])->label(false); ?>
                    <?= $form->field($model, 'DestinoTexto')->input("text", ['id' => 'destinoTexto','readonly' => true])->label("Destino"); ?>
                    <?=
                    $form->field($model, 'destino')->hiddenInput(['id' => 'destinocoordenada'])->label(false);
                    ?>
                    <?= $form->field($model, 'idAgencia')->hiddenInput(['id' => 'idAgencia'])->label(false); ?>
                    <?= $form->field($model, 'idTarifa')->hiddenInput(['id' => 'idTarifa'])->label(false); ?>

                    <?= $form->field($model, 'importeTotal')->input("text", ['id' => 'importeTotal','maxlength' => '50','readonly' => true])->label("Importe Aproximado"); ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
