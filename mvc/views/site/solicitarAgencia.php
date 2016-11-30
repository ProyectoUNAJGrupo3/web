<?php
use yii\helpers\BaseHtml;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\AppAsset;
use app\assets\AppAssetWebSite;
use app\assets\BootswatchAsset;
AppAssetWebSite::register($this);
AppAsset::register($this);
raoul2000\bootswatch\BootswatchAsset::$theme = 'superhero';
BootswatchAsset::register($this);
?>
<div class="container">
    <div class="well bs-component">
        <div id="map-container">
            <div id="map"></div>
        </div>
        <input id="pac-input" class="controls" type="text" placeholder="Busca tu partido / barrio " />
        <?php if (Yii::$app->session->hasFlash('MailEnviado')): ?>
        <div class="alert alert-success">
            Sus datos nos han llegado adecuadamente via mail, pronto verificaremos los datos para validar la cuenta
        </div>
        <?php else: ?>

        <?php $form = ActiveForm::begin(['id' => 'registroAgencia-form','options' => ['class' => 'form-horizontal'],]) ?>
        <fieldset>
            <legend>Datos de su Agencia</legend>

            <?= $form->field($model, 'nombreAgencia')->input("text", ['autofocus' => true, 'maxlength' => '50', 'id' => 'nombreAgencia'])->label("Nombre"); ?>
            <?= $form->field($model, 'telefonoAgencia')->input("text", ['maxlength' => '50', 'id' => 'telefonoAgencia'])->label("N&uacute;mero Tel&eacute;fono de Agencia"); ?>


            <?= $form->field($model, 'CUIT')->Input("text", ['autofocus' => true, 'maxlength' => '11', 'id' => 'CUIT'])->label("Numero de CUIT (Con esto validaremos que su agencia se encuentre en condiciones de operar.)"); ?>
            <?= $form->field($model, 'emailAgencia')->input('text', ['maxlength' => '40', 'id' => 'emailAgencia'])->label("Email"); ?>
            <?= $form->field($model, 'direccionAgencia')->input("text", ['readonly' => true, 'maxlength' => '50', 'id' => 'direccionAgencia'])->label("Direcci&oacute;n"); ?>
            <?= Html::Button('Buscar Direcci&oacute;n', ['class' => 'btn btn-primary', 'onClick' => 'initMap();']); ?>
            <?= $form->field($model, 'direccionCoordenadas')->hiddenInput(['id' => 'coordenadasRemiseria'])->label(false); ?>
        </fieldset>
        <fieldset>
            <legend>Informacion Personal</legend>
            <?= $form->field($model, 'nombre')->input("text", ['maxlength' => '50', 'id' => 'nombre'])->label("Nombre"); ?>
            <?= $form->field($model, 'apellido')->input("text", ['maxlength' => '50', 'id' => 'apellido'])->label("Apellido"); ?>
            <?= $form->field($model, 'telefono')->input("text", ['maxlength' => '50', 'id' => 'telefono'])->label("N&uacute;mero"); ?>
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