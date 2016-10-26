<?php

use yii\helpers\BaseHtml;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\PSCssAsset;

PSCssAsset::register($this);
?>
<!--<div class="container">
    <section id="main">
        <article>
            <div id="page-single-main">-->
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDMVbdR-TGis783bW9rB9tZUJXVXsIRzkQ&libraries=places"></script>
<div class="site-contact">
    <section id="main">
        <article>
            <div id="page-single-main">
                <br />
                <h1 id="title-form">
                    <strong>F&oacute;rmulario de Usuario</strong>
                </h1>
                <div class="container-form" id="contenedor-formulario">
                    <h1>
                        <?= Html::encode($this->title) ?>
                    </h1>

                    <?php if (Yii::$app->session->hasFlash('Usuario creado con exito')): ?>
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

                    <div class="row">
                        <div id="map-container">
                            <div id="map"></div>
                        </div>
                        <input id="pac-input" class="controls" type="text" placeholder="Busca tu partido / barrio " />
                        <div class="col-lg-5">
                            <?php $form = ActiveForm::begin(); ?>
                            <b>
                                <h3>
                                    <u>Datos</u>
                                    <u>Personales</u>
                                </h3>
                            </b>
                            <?= $form->field($model, 'nombre')->input("text", ['maxlength' => '50'])->label("Nombre");; ?>
                            <?= $form->field($model, 'apellido')->input("text", ['maxlength' => '50'])->label("Apellido"); ?>
                            <?= $form->field($model, 'correo')->input("email")->label("Correo"); ?>
                            <?= $form->field($model, 'telefono')->input('text', ['maxlength' => '20'])->label("Tele&eacute;fono"); ?>
                            <?= $form->field($model, 'direccion')->textInput(['readonly' => true])->label("Direcci&oacute;n"); ?>
                            <?= $form->field($model, 'coordenadas')->textInput(['id'=>'coordenadas'])->label(""); ?>
                            <?= Html::Button('Buscar Dirección', ['class' => 'btn btn-primary', 'onClick' => 'initMap();']); ?>
                            <b>
                                <h3>
                                    <u>Datos</u>
                                    <u>de</u>
                                    <u>Usuario</u>
                                </h3>
                            </b>
                            <br />
                            <?= $form->field($model, 'usuario')->textInput()->label("Usuario"); ?>
                            <?= $form->field($model, 'contrasenia')->passwordInput()->label("Contrase&ntilde;a"); ?>
                            <?= $form->field($model, 'confirmarContrasenia')->passwordInput()->label("Confirmar Contrase&ntilde;a"); ?>
                            <?= Html::submitButton('Registrarme', ['class' => 'btn btn-primary', 'id'=>'btn-registrarme']);  ?>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>

                    <?php endif; ?>
                </div>
            </div>
        </article>
    </section>
</div>

