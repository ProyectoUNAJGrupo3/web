<?php
use yii\helpers\BaseHtml;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\AppAsset;
use app\assets\BootswatchAsset;
AppAsset::register($this);
raoul2000\bootswatch\BootswatchAsset::$theme = 'superhero';
BootswatchAsset::register($this);
?>
<div class="container">
    <div class="well bs-component">
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
        <?= $form->field($model, 'telefonoAgencia')->input("text", ['maxlength' => '50', 'id' => 'telefonoAgencia'])->label("Número Teléfono <b id='asterisco'>*</b>"); ?>
        <?= $form->field($model, 'cuit')->textInput(['id' => 'cuit'])->label(""); ?>
        <!--toma los campos de arriba para armar el cuit escondido-->
        <!--Armo el CUIT-->
        <a style="color: black"><b><u><h4>CUIT</h4></u></b></a>
        <?= $form->field($model, 'tipo')->input('text', ['maxlength' => '2', 'id' => 'tipo'])->label("Tipo <b id='asterisco'>*</b>"); ?>
        <?= $form->field($model, 'documento')->input('text', ['maxlength' => '8', 'id' => 'documento'])->label("Número <b id='asterisco'>*</b>"); ?>
        <?= $form->field($model, 'digitoVerificador')->input('text', ['maxlength' => '1', 'id' => 'digitoVerificador'])->label("Verificador <b id='asterisco'>*</b>"); ?>
        <?= $form->field($model, 'direccionAgencia')->input("text", ['readonly' => true, 'maxlength' => '50', 'id' => 'direccionAgencia'])->label("Dirección <b id='asterisco'>*</b>"); ?>
        <?= Html::Button('Buscar Dirección', ['class' => 'btn btn-primary', 'onClick' => 'initMap();']); ?>
        <?= $form->field($model, 'coordenadas')->textInput(['id' => 'coordenadasRemiseria'])->label(""); ?>
        <br>
        <h3>
            <u>Datos</u>
            <u>Due&ntilde;o</u>
        </h3>
        </b>
        <?= $form->field($model, 'nombreDuenio')->input("text", ['maxlength' => '50', 'id' => 'nombreDuenio'])->label("Nombre <b id='asterisco'>*</b>"); ?>
        <?= $form->field($model, 'apellidoDuenio')->input("text", ['maxlength' => '50', 'id' => 'apellidoDuenio'])->label("Apellido <b id='asterisco'>*</b>"); ?>
        <?= $form->field($model, 'dniDuenio')->input("text", ['maxlength' => '50', 'id' => 'dniDuenio'])->label("Documento <b id='asterisco'>*</b>"); ?>
        <?= $form->field($model, 'email')->input('text', ['maxlength' => '8', 'id' => 'email'])->label("Email <b id='asterisco'>*</b>"); ?>
        <b>
            <h3>
                <u>Datos</u>
                <u>de</u>
                <u>Usuario</u>
            </h3>
        </b>
        <br />
        <?= $form->field($model, 'usuario')->textInput(['id' => 'usuarioAgencia'])->label("Usuario"); ?>
        <?= $form->field($model, 'contrasenia')->passwordInput(['id' => 'contraseniaAgencia'])->label("Contrase&ntilde;a"); ?>
        <?= $form->field($model, 'confirmarContrasenia')->passwordInput(['id' => 'confirmarContraseniaAgencia'])->label("Confirmar Contrase&ntilde;a"); ?>
        <?php ActiveForm::end(); ?>
        <br>
        <b>Campos con</b> <b id="asterisco">*</b> <b>son obligatorios</b>
        <br>
        <div id='botones-group'>
            <?= Html::submitButton('Enviar solicitud', ['class' => 'btn btn-primary', 'id' => 'btn-enviar-solicitud']); ?>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <?= Html::button('Cancelar', ['class' => 'btn btn-primary', 'id' => 'btn-cancelar']); ?>
        </div>
        <?php endif; ?>
    </div>
</div>
          