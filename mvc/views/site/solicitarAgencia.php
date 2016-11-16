<?php
use yii\helpers\BaseHtml;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\AppAsset;
use app\assets\AppAssetWebSite;
use app\assets\BootswatchAsset;
AppAsset::register($this);
raoul2000\bootswatch\BootswatchAsset::$theme = 'superhero';
AppAssetWebSite::register($this);
BootswatchAsset::register($this);
?>
<div class="container">
    <div class="well bs-component">
        <div id="map-container">
            <div id="map"></div>
        </div>
        <input id="pac-input" class="controls" type="text" placeholder="Busca tu partido / barrio " />
        <?php if (Yii::$app->session->hasFlash('Agencia creado con exito')): ?>
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

        <?php $form = ActiveForm::begin(['id' => 'registroAgencia-form','options' => ['class' => 'form-horizontal'],]) ?>
        <fieldset>
            <legend>Datos de la su Agencia</legend>

            <?= $form->field($model, 'nombreAgencia')->input("text", ['autofocus' => true, 'maxlength' => '50', 'id' => 'nombreAgencia'])->label("Nombre"); ?>
            <?= $form->field($model, 'telefonoAgencia')->input("text", ['maxlength' => '50', 'id' => 'telefonoAgencia'])->label("Número Teléfono de Agencia"); ?>


            <?= $form->field($model, 'CUIT')->Input("text", ['autofocus' => true, 'maxlength' => '11', 'id' => 'CUIT'])->label("Numero de CUIT (Con esto validaremos que su agencia se encuentre en condiciones de operar.)"); ?>
            <?= $form->field($model, 'emailAgencia')->input('text', ['maxlength' => '40', 'id' => 'emailAgencia'])->label("Email"); ?>
            <?= $form->field($model, 'direccionAgencia')->input("text", ['readonly' => true, 'maxlength' => '50', 'id' => 'direccionAgencia'])->label("Dirección"); ?>
            <?= Html::Button('Buscar Dirección', ['class' => 'btn btn-primary', 'onClick' => 'initMap();']); ?>
            <?= $form->field($model, 'direccionCoordenadas')->hiddenInput(['id' => 'coordenadasRemiseria'])->label(false); ?>
        </fieldset>
        <fieldset>
            <legend>Informacion Personal</legend>
            <?= $form->field($model, 'nombre')->input("text", ['maxlength' => '50', 'id' => 'nombre'])->label("Nombre"); ?>
            <?= $form->field($model, 'apellido')->input("text", ['maxlength' => '50', 'id' => 'apellido'])->label("Apellido"); ?>
            <?= $form->field($model, 'telefono')->input("text", ['maxlength' => '50', 'id' => 'telefono'])->label("Número"); ?>
            <?= $form->field($model, 'dni')->input("text", ['maxlength' => '50', 'id' => 'dni'])->label("Documento"); ?>
            <?= $form->field($model, 'email')->input('text', ['maxlength' => '40', 'id' => 'email'])->label("Email"); ?>
        </fieldset>
        <fieldset>
            <legend>Datos de Usuario</legend>
            <?= $form->field($model, 'usuario')->textInput(['id' => 'usuario'])->label("Usuario"); ?>
            <?= $form->field($model, 'contrasenia')->passwordInput(['id' => 'contrasenia'])->label("Contrase&ntilde;a"); ?>
            <?= $form->field($model, 'confirmarContrasenia')->passwordInput(['id' => 'confirmarContrasenia'])->label("Confirmar Contrase&ntilde;a"); ?>
        </fieldset>
        <div id='botones-group'>
            <?= Html::submitButton('Enviar solicitud', ['class' => 'btn btn-primary', 'id' => 'btn-enviar-solicitud']); ?>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <?= Html::button('Cancelar', ['class' => 'btn btn-primary', 'id' => 'btn-cancelar']); ?>
            <?php ActiveForm::end(); ?>
        </div>

        <?php endif; ?>
    </div>
</div>