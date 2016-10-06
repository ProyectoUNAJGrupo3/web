<?php

use yii\helpers\BaseHtml;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<!--<div class="container">
    <section id="main">
        <article>
            <div id="page-single-main">-->

<div class="site-contact">
    <h1>Formulario Usuario</h1>
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

        <div class="alert alert-success">
            Thank you for contacting us. We will respond to you as soon as possible.
        </div>

        <p>
            Note that if you turn on the Yii debugger, you should be able
            to view the mail message on the mail panel of the debugger.
            <?php if (Yii::$app->mailer->useFileTransport): ?>
                Because the application is in development mode, the email is not sent but saved as
                a file under <code><?= Yii::getAlias(Yii::$app->mailer->fileTransportPath) ?></code>.
                Please configure the <code>useFileTransport</code> property of the <code>mail</code>
                application component to be false to enable email sending.
            <?php endif; ?>
        </p>

    <?php else: ?>

        <p>
            A continuación ingrese sus datos para poder crearse un usuario.
        </p>

        <div class="row">
            <div class="col-lg-5">

                <?php $form = ActiveForm::begin(); ?>
                            <!--<h1 id="title-form"><strong>F&oacute;rmulario de Usuario</strong></h1>
                            <div class="container-form" id="contenedor-formulario">
                                <form id="contenido-form" onsubmit="return validateForm()" method="post" name="formUser">-->
                <b><h3><u>Datos</u> <u>Personales</u></h3></b>
                <?= $form->field($model, 'nombre')->input("text"); ?>
                <?= $form->field($model, 'apellido')->input("text"); ?>
                <?= $form->field($model, 'correo')->input("email"); ?>
                <?= $form->field($model, 'telefono'); ?>
                <?= $form->field($model, 'direccion'); ?>
                <?= Html::button('Buscar Dirección', ['class' => 'btn btn-primary']); ?>
                <!--                                    <label for="datos-personales" class="label-field-form">Nombre</label>
                                                    <input type="text" id="nombre" name="nombreForm" class="form-control" onblur="validarNombre()" placeholder="nombre" aria-required="true" required maxlength="60" /> <span id="errorInfoNom"></span>
                                                    <br>
                                                    <label for="datos-personales"  class="label-field-form" id="apellido">Apellido</label>
                                                    <br>
                                                    <input type="text" class="form-control" name="apellidoForm" id="apellido" onblur="validarApellido()" placeholder="apellido"  aria-required="true" required maxlength="60"><span id="errorInfoApel"></span>
                                                    <br>
                                                    <label for="datos-personales" id="correo" class="label-field-form">Correo Electr&oacute;nico</label>
                                                    <br>
                                                    <input type="email" id="correo-electronico" name="correoElectronicoForm" class="form-control" placeholder="correo" size="50" aria-required="true" required maxlength="75" onblur="validarEmail()"><span id="errorInfoEmail"></span>
                                                    <br>
                                                    <label class="label-field-form" >Tel&eacute;fono</label>
                                                    <br>
                                                    <input for="number-datos-personales"  type="text" id="telefono" name="telefonoForm" class="form-control" placeholder="tel&eacute;fono" size="40" aria-required="true" maxlength="20" onblur="validarTelefono();"><span id="errorInfoTel"></span>
                                                    <br>
                                                    <label for="datos-personales" class="label-field-form">Direcci&oacute;n</label>
                                                    <br>
                                                    <input type="text" class="form-control" id="direccion" placeholder="direcci&oacute;n" size="40" aria-required="true" required readonly>
                                                    <br>
                                                    <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-off"></span> Buscar direcci&oacute;n</button>
                                                    <br><br>-->

                <b><h3><u>Datos</u> <u>de</u> <u>Usuario</u></h3></b>
                <br>
                <!--label('Name')-->
                <?= $form->field($model, 'usuario')->textInput(); ?>
                <?= $form->field($model, 'contrasenia')->passwordInput(); ?>
                <?= $form->field($model, 'confirmarContrasenia')->passwordInput(); ?>
                <!--<label for="username" id="nombre-usuario" class="label-field-form" maxlength="100">Nombre de Usuario</label>
                <br>
                <input type="text" class="form-control" id="nombreUsuario" name="nombreUsuario" placeholder="nombre de usuario" size="40" aria-required="true" maxlength="30" required onblur="validarNombreUsuario()"><span id="errorInfUser"></span>
                <br> 
                <label for="password" id="alter-property-input" class="label-field-form">Contrase&ntilde;a</label>
                <br>
                <input type="password" class="form-control" id="contrasenia" name="contraseniaForm" placeholder="contrase&ntilde;a" onblur="validarContrasenia()" size="40" aria-required="true" required maxlength="30"><span id="errorInfContrasenia"></span>
                <br>  
                <label for="valdidate-password" id="confirmar-contrasenia" class="label-field-form">Confirmar Contrase&ntilde;a</label>
                <br>
                <input type="password" class="form-control" id="confirmarContrasenia" name="confirmarContraseniaForm" placeholder="confirmar contrase&ntilde;a" maxlength="30" onblur="validarConfirmacionContrasenia()" size="40" aria-required="true" required><span id="errorInfConfContrasenia"></span>
                </p>
                <p><br>
                <!--<input type="submit" class="form-control" id="confirmar-contrasenia" placeholder="confirmar contrase&ntilde;a" size="40" aria-required="true" required>-->
                <!--<button type="submit" class="btn btn-primary" id="btn-registrarme"><span class="glyphicon glyphicon-off"></span> Registrarme</button>
                </p>-->
                <?= Html::submitButton('Registrarme', ['class' => 'btn btn-primary']); ?>

                <!--</form>
            </div>
        </div>
        </article>
        </section>
        </div>-->
                <?php ActiveForm::end(); ?>
            </div>
        </div>

    <?php endif; ?>
</div>
