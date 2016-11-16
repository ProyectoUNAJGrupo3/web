<?php

use yii\helpers\BaseHtml;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\AppAssetCliente;

AppAssetCliente::register($this);
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
                        <strong>Solicitud Servicio Remis</strong>
                    </h1>
                    <div class="container-form" id="contenedor-formulario">

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
                                    <u>Solicitud</u>
                                </h3>
                            </b>

                            <?= $form->field($model, 'idAgencia')->input("text", ['readonly' => true, 'autofocus' => true, 'maxlength' => '50', 'id' => 'nombreAgenciaSolicitudRemisUsuario'])->label("Nombre Agencia<b id='asterisco'>*</b>"); ?>
                            <?= $form->field($model, 'idTarifa')->input("text", ['readonly' => true, 'maxlength' => '50', 'id' => 'nombreSolicitudRemisUsuario'])->label("Nombre Usuario<b id='asterisco'>*</b>"); ?>
                            <?= $form->field($model, 'importeTotal')->input("text", ['readonly' => true, 'autofocus' => true, 'maxlength' => '50', 'id' => 'nombreAgenciaSolicitudRemisUsuario'])->label("Nombre Agencia<b id='asterisco'>*</b>"); ?>
                            <?= $form->field($model, 'origen')->input("text", ['readonly' => true, 'maxlength' => '50', 'id' => 'nombreSolicitudRemisUsuario'])->label("Nombre Usuario<b id='asterisco'>*</b>"); ?>
                            <?= $form->field($model, 'destino')->input("text", ['readonly' => true, 'maxlength' => '50', 'id' => 'apellidoSolicitudRemisUsuario'])->label("Apellido Usuario<b id='asterisco'>*</b>"); ?>
                            <?= $form->field($model, 'OrigenTexto')->input("text", ['readonly' => true, 'maxlength' => '50', 'id' => 'origenSolicitudRemisUsuario'])->label("Origen <b id='asterisco'>*</b>"); ?>
                            <?= $form->field($model, 'DestinoTexto')->input("text", ['readonly' => true, 'maxlength' => '50', 'id' => 'destinoSolicitudRemisUsuario'])->label("Destino <b id='asterisco'>*</b>"); ?>
                            <?= $form->field($model, 'Distancia')->input("text", ['readonly' => true, 'maxlength' => '50', 'id' => 'destinoSolicitudRemisUsuario'])->label("Destino <b id='asterisco'>*</b>"); ?>
                            <?php ActiveForm::end(); ?>
                            <br>
                            <b>Campos con</b> <b id="asterisco">*</b> <b>son obligatorios</b>
                            <br>
                            <div id='botones-group'>
                                <?= Html::submitButton('Enviar Solicitud', ['class' => 'btn btn-primary', 'id' => 'btn-guardar']); ?>
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
