<?php

use yii\helpers\BaseHtml;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\AppAsset;
use app\assets\PSCssAsset;

AppAsset::register($this);
PSCssAsset::register($this);
?>

<!--
CARGAR UN NUEVO VIAJE MANUAL

USADO POR LA RECEPCIONISTA
-->


<div class="site-contact">
    <section id="main">
        <article>
            <div id="page-single-main-solicitud-servicio">
                <br />
                <h1 id="title-form-solicitud-servicio">
                    <strong>Solicitar Servicio</strong>
                </h1>
                <div class="container-form" id="contenedor-formulario-solicitud-servicio">
                    <h1>
                        <?= Html::encode($this->title) ?>
                    </h1>

                    <?php if (Yii::$app->session->hasFlash('Carga exitosa')): ?>
                        <div class="alert alert-success">
                            La carga del nuevo viajes ha sido exitosa
                        </div>
                    <?php else: ?>

                        <?php $form = ActiveForm::begin(); ?>
                        <b>
                            <h3>
                                <u>Datos</u>
                                <u>Del</u>
                                <u>Pasajero</u>
                            </h3>
                        </b>
                        <?= $form->field($model, 'nombreAgencia')->input("text", ['readonly' => true, 'id' => 'nombreAgecia'])->label("Nombre Agencia"); ?>
                        <?= $form->field($model, 'nombre')->input("text", ['readonly' => true, 'id' => 'nombrePasajero'])->label("Nombre"); ?>
                        <?= $form->field($model, 'apellido')->input("text", ['readonly' => true, 'id' => 'apellidoPasajero'])->label("Apellido"); ?>
                        <br>
                        <b>
                            <h3>
                                <u>Datos</u>
                                <u>Del</u>
                                <u>Viaje</u>
                            </h3>
                        </b>
                        <br>
                        <?= $form->field($model, 'origen')->input('text', ['readonly' => true, 'id' => 'origen'])->label("Origen <b id='asterisco'>*</b>"); ?>
                        <?= $form->field($model, 'destino')->textInput(['readonly' => true, 'id' => 'destino', 'readonly' => true])->label("Destino <b id='asterisco'>*</b>"); ?>
                        <b>Campos con</b> <b id="asterisco-solicitud-servicio">*</b> <b>son obligatorios</b>
                        <br>
                        <div id='botones-group-solicitud-servicio'>
                            <?= Html::submitButton('Solicitar Servicio', ['class' => 'btn btn-primary', 'id' => 'btn-solicitar-servicio']); ?>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <?= Html::button('Cancelar', ['class' => 'btn btn-primary', 'id' => 'btn-cancelar']); ?>
                        </div>

                    <?php endif; ?>
                </div>
            </div>
        </article>
    </section>
</div>


