<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\assets\AppAssetAgencia;
use app\assets\BootswatchAsset;

raoul2000\bootswatch\BootswatchAsset::$theme = 'superhero';
BootswatchAsset::register($this);
AppAssetAgencia::register($this);
/*AppAsset::register($this);*/
/* @var $this yii\web\View */             //modifique el div class ="site-index" por el "agencia-index"
$this->title = 'Service Remis';
?>
<div class="container">
    <div class="jumbotron">
        <h1><b>Bienvenido <?php echo Yii::$app->user->identity->Nombre?></b></h1>
        <div class="row">
            <blockquote>
                <div>
                    <p style="text-align: justify">
                        Mediante la aplicaci&oacute;n usted podr&aacute; gestionar su remiser&iacute;a de manera m&aacute;s eficiente y efectiva.
                        Para ello usted cuenta con las posibilidad de agregar, actualizar y eliminar un empleado sea, un chofer o un/a telefonista.
                        Adem&aacute;, usted podr&aacute; lsitar el historial de calificaciones y viajes de su agencia.
                    </p>
                </div>
            </blockquote>
        </div>
    </div>
</div>