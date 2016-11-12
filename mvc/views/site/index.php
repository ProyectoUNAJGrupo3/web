<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\BootswatchAsset;



raoul2000\bootswatch\BootswatchAsset::$theme = 'superhero';
BootswatchAsset::register($this);
?>

<div class="splash">
    <div class="jumbotron">
        <h1>Bienvenidos a RemisYa!</h1>
        <p>La primera aplicacion web en el mercado pensada para su Agencia y sus clientes..</p>
        <p>Administre de manera mas eficaz la gestion, minimice costos y errores humanos, aproveche un nuevo canal de ventas.</p>
        <p>
            <a class="btn btn-primary btn-lg">Solicitar Remis</a>
        </p>
    </div>
</div>
<div class="section-tout" style="background-color:#eaf1f1">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-sm-6">
                <h3>
                    <i class="fa fa-file-o"></i>Caracteristica 1
                </h3>
                <p>Detalle de la caracteristica 1</p>
            </div>
            <div class="col-lg-4 col-sm-6">
                <h3>
                    <i class="fa fa-github"></i>Caracteristica 2
                </h3>
                <p>
                    Detalle de la caracteristica 2
                </p>
            </div>
            <div class="col-lg-4 col-sm-6">
                <h3>
                    <i class="fa fa-wrench"></i>Caracteristica 3
                </h3>
                <p>
                   Detalle de la caracteristica 3
                </p>
            </div>
            <div class="col-lg-4 col-sm-6">
                <h3>
                    <i class="fa fa-cogs"></i>Caracteristica 4
                </h3>
                <p>Detalle de la caracteristica 5</p>
            </div>
            <div class="col-lg-4 col-sm-6">
                <h3>
                    <i class="fa fa-cloud"></i>Caracteristica 5
                </h3>
                <p>
                    Detalle de la caracterisitca 5
                </p>
            </div>
            <div class="col-lg-4 col-sm-6">
                <h3>
                    <i class="fa fa-bullhorn"></i>Caracterisitca 6
                </h3>
                <p>
                  Detalle de la caracteristica 6
                </p>
            </div>
        </div>
    </div>
</div>