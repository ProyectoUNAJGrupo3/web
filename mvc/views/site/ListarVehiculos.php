<?php

use yii\helpers\BaseHtml;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\PSCssAsset;
use yii\jui\DatePicker;

PSCssAsset::register($this);
?>
<div class="container">
    <section id="main">
        <article>
            <div id="page-single-main">
                <br />
                <h1 id="title-form">
                    <strong>Listar Vehiculos</strong>
                </h1>
                <div class="container-form" id="contenedor-formulario">
                    <h1>
                        <?= Html::encode($this->title) ?>
                    </h1>
                    <!--   crear tabla>-->
                    <?php
                    
/*
marca, modelo,patente , anio, numeroseguro,estado, conductor

FechaAltaDesde 
FechaAltaHasta */
                    ?>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary">Actualizar</button>
                        <button type="button" class="btn btn-primary">Eliminar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </article>
    </section>
</div>
                    