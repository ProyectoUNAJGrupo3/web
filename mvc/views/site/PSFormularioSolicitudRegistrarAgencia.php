<?php

use yii\helpers\BaseHtml;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<!--<div class="container">
    <section id="main">
        <article>
            <div id="page-single-main">-->
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDMVbdR-TGis783bW9rB9tZUJXVXsIRzkQ&libraries=places"></script>
<div class="site-contact">
    <div class="col-lg-20">
        <section id="main">
            <article>
                <div id="page-single-main">
                    <br />
                    <h1 id="title-form">
                        <strong>Solicitud Registrar Agencia</strong>
                    </h1>
                    <div class="container-form" id="contenedor-formulario">
                        <div id="map-container">
                            <div id="map"></div>
                        </div>
                        <input id="pac-input" class="controls" type="text" placeholder="Busca tu partido / barrio " />

                        <h1>
                            <?= Html::encode($this->title) ?>
                        </h1>

                        <?php if (Yii::$app->session->hasFlash('Empleado creado con exito')): ?>
                            <div class="alert alert-success">
                                Thank you for contacting us. We will respond to you as soon as possible.
                            </div>
                            <p>
                                Note that if you turn on the Yii debugger, you should be able
                                to view the mail message on the mail panel of the debugger.
                                <?php if (Yii::$app->mailer->useFileTransport): ?>
                                    Because the application is in development mode, the email is not sent but saved as
                                    a file under
                                    <code>
                                        <?= Yii::getAlias(Yii::$app->mailer->fileTransportPath) ?>
                                    </code>.
                                    Please configure the
                                    <code>useFileTransport</code>property of the
                                    <code>mail</code>
                                    application component to be false to enable email sending.
                                <?php endif; ?>
                            </p>
                        <?php else: ?>

                            <?php $form = ActiveForm::begin(); ?>
                            <b>
                                <h3>
                                    <u>Datos</u>
                                    <u>Agencia</u>
                                </h3>
                            </b>
                            <?= $form->field($model, 'nombreAgencia')->input("text", ['autofocus' => true, 'maxlength' => '50', 'id' => 'marca'])->label("Nombre<b id='asterisco'>*</b>"); ?>
                            <?= $form->field($model, 'numeroClienteServcio')->input("text", ['maxlength' => '50', 'id' => 'patente'])->label("Número Cliente (Agua, gas, luz, cable, teléfono) <b id='asterisco'>*</b>"); ?>
                            <?= $form->field($model, 'telefonoAgencia')->input('text', ['maxlength' => '4', 'id' => 'anio'])->label("Tele&eacute;fono <b id='asterisco'>*</b>"); ?>
                            <?= $form->field($model, 'direccionAgencia')->input("text", ['readonly' => true, 'maxlength' => '50', 'id' => 'nombre'])->label("Dirección <b id='asterisco'>*</b>"); ?>
                            <?= Html::Button('Buscar Dirección', ['class' => 'btn btn-primary', 'onClick' => 'initMap();']); ?>
                            <br><br>

                            <h3>
                                <u>Datos</u>
                                <u>Due&ntilde;o</u>
                            </h3>
                            </b>
                            <?= $form->field($model, 'nombreDuenio')->input("text", ['maxlength' => '50', 'id' => 'modelo'])->label("Nombre <b id='asterisco'>*</b>"); ?>
                            <?= $form->field($model, 'apellidoDuenio')->input("text", ['maxlength' => '50', 'id' => 'modelo'])->label("Apellido <b id='asterisco'>*</b>"); ?>
                            <?= $form->field($model, 'dniDuenio')->input("text", ['maxlength' => '50', 'id' => 'modelo'])->label("DNI <b id='asterisco'>*</b>"); ?>
                            <?= $form->field($model, 'email')->input('text', ['maxlength' => '8', 'id' => 'numeroSeguro'])->label("Email <b id='asterisco'>*</b>"); ?>

                            <?php ActiveForm::end(); ?>
                            <br>
                            <b>Campos con</b> <b id="asterisco">*</b> <b>son obligatorios</b>
                            <br>
                            <div id='botones-group'>
                                <?= Html::submitButton('Enviar solicitud', ['class' => 'btn btn-primary', 'id' => 'btn-guardar']); ?>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <?= Html::button('Cancelar', ['class' => 'btn btn-primary', 'id' => 'btn-cancelar']); ?>
                            </div>

                        <?php endif; ?>
                    </div>
                </div>

            </article>
        </section>
    </div>
</div>
