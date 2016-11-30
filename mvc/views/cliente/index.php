<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAssetWebSite;
use app\assets\AppAssetCliente;
use app\assets\AppAsset;
use yii\widgets\ActiveForm;
use app\assets\BootswatchAsset;
use yii\bootstrap\Dropdown;
use yii\bootstrap\Button;
use yii\bootstrap\Modal;
use yii\helpers\BaseHtml;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

AppAssetCliente::register($this);
raoul2000\bootswatch\BootswatchAsset::$theme = 'superhero';
/*BootswatchAsset::register($this);comente esto porque desaparecia el footer
AppAsset::register($this);
AppAssetWebSite::register($this);
/* @var $this yii\web\View */
$this->title = 'Service Remis';

?>

<!--<div class="site-index">
    <div id="contenedor-home">-->
<div class="panel panel-primary">
<div id="LoadingBlocker">  <div style="background-image:url(img/Loading.gif)" id="LoadingImage"></div></div>

    <div class="panel-heading">
        <h4 class="panel-title">&ensp; &ensp;   BIENVENIDOS A REMIS YA</h4>
    </div>
    <div class="panel-body">
        <div class="row">
            <?php $form = ActiveForm::begin(); ?>
            <div class="col-lg-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>
                            Ingrese una ubicacion para el Origen y el Destino, o haga click sobre el mapa para calcular la distancia y cotizar su viaje.
                        </h4>
                        <div class="panel-body">
                            <fieldset>
                                <div id="btn-bar">
                                    <?= Html::submitButton('Solicitar Servicio Remiseria', ['class' => 'btn btn-primary', 'disabled' => true, 'name' => 'contact-button', 'id' => 'btn-solcitar-remis']) ?>
                                    <?= Html::button('Listar Remiserias', ['class' => 'btn btn-primary disable', 'disabled' => true, 'name' => 'contact-button', 'id' => 'btn-ver-remiserias']) ?>
                                    <?= $this->registerJs('$(document).ready(function () {
                        initMap(true);
                        $("#btn-ver-remiserias").on("click", function() {doTheAjax()});

                        });', \yii\web\View::POS_READY);
                                    ?>

                                    <label id="distancia" class="display:none colorBlack">
                                        <strong>
                                            <p>
                                                <h4>
                                                    <strong>
                                                        Distancia :
                                                    </strong>
                                                </h4>
                                            </p>
                                        </strong>
                                    </label>
                                    <?= $form->field($model, 'Distancia')->hiddenInput(['id' => 'FieldDistance'])->label(false); ?>

                                </div>
                                <div id="mapHome">
                                    <!--class="col-md-12"-->
                                    <div id="map-Index">
                                        <div id="map"></div>
                                    </div>
                                    <input id="pac-input" class="controls colorBlack" type="text" placeholder="Busca tu partido / barrio " />
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>Datos del viaje: </h3>
                    </div>
                    <div class="panel-body">
                        <fieldset>
                            <?= $form->field($model, 'OrigenTexto')->input("text", ['id' => 'origenTexto', 'readonly' => true])->label("Origen"); ?>
                            <?= $form->field($model, 'origen')->hiddenInput(['id' => 'origencoordenada'])->label(false); ?>
                            <?= $form->field($model, 'DestinoTexto')->input("text", ['id' => 'destinoTexto', 'readonly' => true])->label("Destino"); ?>
                            <?= $form->field($model, 'destino')->hiddenInput(['id' => 'destinocoordenada'])->label(false); ?>
                            <?= $form->field($model, 'idAgencia')->hiddenInput(['id' => 'idAgencia'])->label(false); ?>
                            <?= $form->field($model, 'idTarifa')->hiddenInput(['id' => 'idTarifa'])->label(false); ?>
                            <?= $form->field($model, 'importeTotal')->input("text", ['id' => 'importeTotal', 'maxlength' => '50', 'readonly' => true])->label("Importe Aproximado"); ?>

                        </fieldset>
                      </div>
                    </div>
                 </div>


                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
