<?php

use yii\helpers\BaseHtml;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\AppAssetWebSite;
use app\assets\AppAsset;

AppAsset::register($this);
AppAssetWebSite::register($this);
?>
<!--<div class="container">
    <section id="main">
        <article>
            <div id="page-single-main">-->
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

                        <div class="col-lg-5">
                            <?php $form = ActiveForm::begin(); ?>
                            <b>
                                <h3>
                                    <u>Datos</u>
                                    <u>Personales</u>
                                </h3>
                            </b>
                            <?= $form->field($model, 'numeroViaje')->input("text", ['maxlength' => '50'])->label("Nombre"); ?>
                            <?= $form->field($model, 'nombreUsuario')->input("text", ['maxlength' => '50'])->label("Apellido"); ?>
                            <?= $form->field($model, 'nombreChofer')->input("email")->label("Correo"); ?>
                            <?= $form->field($model, 'puntaje')->input('text', ['maxlength' => '20'])->label("Tel&eacute;fono"); ?>
                            <?= $form->field($model, 'fecha')->textInput(['readonly' => true])->label("Direcci&oacute;n"); ?>
                            <?= $form->field($model, 'comentario')->textInput(['id' => 'coordenadas'])->label(""); ?>
                            <?= Html::submitButton('Registrarme', ['class' => 'btn btn-primary', 'id' => 'btn-registrarme']); ?>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>

                <?php endif; ?>
            </div>
        </div>
    </article>
</section>


