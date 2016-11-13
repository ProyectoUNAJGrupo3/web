<?php

use yii\helpers\BaseHtml;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\AppAssetCliente;
use app\assets\AppAsset;

AppAsset::register($this);
AppAssetCliente::register($this);
?>
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
                            <?= $form->field($model, 'nombreAgencia')->input("text", ['autofocus' => true, 'maxlength' => '50', 'id' => 'nombreAgencia'])->label("Nombre<b id='asterisco'>*</b>"); ?>
                            <?= $form->field($model, 'telefonoAgencia')->input("text", ['maxlength' => '50', 'id' => 'telefonoAgencia'])->label("Número Teléfono de Agencia <b id='asterisco'>*</b>"); ?>
                           
                            
                            <a style="color: black"><b><u><h4>CUIT</h4></u></b></a>
                            <?= $form->field($model, 'CUIT')->Input("text", ['autofocus' => true, 'maxlength' => '11', 'id' => 'CUIT'])->label("Código de CUIT<b id='asterisco'>*</b>"); ?>
                            <?= $form->field($model, 'emailAgencia')->input('text', ['maxlength' => '40', 'id' => 'emailAgencia'])->label("Email <b id='asterisco'>*</b>"); ?>
                            <?= $form->field($model, 'direccionAgencia')->input("text", ['readonly' => true, 'maxlength' => '50', 'id' => 'direccionAgencia'])->label("Dirección <b id='asterisco'>*</b>"); ?>
                            <?= Html::Button('Buscar Dirección', ['class' => 'btn btn-primary', 'onClick' => 'initMap();']); ?>
                            <?= $form->field($model, 'direccionCoordenadas')->textInput(['id' => 'coordenadasRemiseria'])->label(""); ?>
                            <br>

                            <h3>
                                <u>Datos</u>
                                <u>Due&ntilde;o</u>
                            </h3>
                            </b>
                            <?= $form->field($model, 'nombre')->input("text", ['maxlength' => '50', 'id' => 'nombre'])->label("Nombre <b id='asterisco'>*</b>"); ?>
                            <?= $form->field($model, 'apellido')->input("text", ['maxlength' => '50', 'id' => 'apellido'])->label("Apellido <b id='asterisco'>*</b>"); ?>
                            <?= $form->field($model, 'telefono')->input("text", ['maxlength' => '50', 'id' => 'telefono'])->label("Número Teléfono de usuario <b id='asterisco'>*</b>"); ?>
                            <?= $form->field($model, 'dni')->input("text", ['maxlength' => '50', 'id' => 'dni'])->label("Documento <b id='asterisco'>*</b>"); ?>
                            <?= $form->field($model, 'email')->input('text', ['maxlength' => '40', 'id' => 'email'])->label("Email <b id='asterisco'>*</b>"); ?>
                            <b>
                                <h3>
                                    <u>Datos</u>
                                    <u>de</u>
                                    <u>Usuario</u>
                                </h3>
                            </b>
                            <br />
                            <?= $form->field($model, 'usuario')->textInput(['id' => 'usuario'])->label("Usuario"); ?>
                            <?= $form->field($model, 'contrasenia')->passwordInput(['id' => 'contrasenia'])->label("Contrase&ntilde;a"); ?>
                            <?= $form->field($model, 'confirmarContrasenia')->passwordInput(['id' => 'confirmarContrasenia'])->label("Confirmar Contrase&ntilde;a"); ?>
                            
                            <br>
                            <b>Campos con</b> <b id="asterisco">*</b> <b>son obligatorios</b>
                            <br>
                            <div id='botones-group'>
                                <?= Html::submitButton('Enviar solicitud', ['class' => 'btn btn-primary', 'id' => 'btn-enviar-solicitud']); ?>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <?= Html::button('Cancelar', ['class' => 'btn btn-primary', 'id' => 'btn-cancelar']); ?>
        <?php ActiveForm::end(); ?>
                            </div>

                        <?php endif; ?>
                    </div>
                </div>

            </article>
        </section>
    </div>
</div>
