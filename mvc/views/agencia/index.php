<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\assets\AppAssetAgencia;

AppAssetAgencia::register($this);
AppAsset::register($this);
/* @var $this yii\web\View */             //modifique el div class ="site-index" por el "agencia-index"
$this->title = 'Service Remis';
?>
<div class="agencia-index">             

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
                    blalblalblalblabla.
                </p>
            </strong>
        </div>

        <div id="bar-buttons">
            <div id="btn-bar">
                <?= Html::button('Solicitar Servicio Remiseria', ['class' => 'btn btn-primary', 'name' => 'contact-button', 'id' => 'btn-solcitar-remis']) ?>
                <?= Html::button('Listar Remiserias', ['class' => 'btn btn-primary', 'name' => 'contact-button', 'id' => 'btn-ver-remiserias']) ?>
                <?= Html::button('Obtener ubicaci&oacute;n en el Mapa', ['class' => 'btn btn-primary', 'name' => 'contact-button', 'id' => 'btn-obtener-ubicacion-en-el-mapa']) ?>
            </div>

        </div>
    </div>
</div>