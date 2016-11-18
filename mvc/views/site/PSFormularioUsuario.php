<?php
use yii\helpers\BaseHtml;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\BootswatchAsset;
use app\assets\AppAssetCliente;
raoul2000\bootswatch\BootswatchAsset::$theme = 'superhero';
BootswatchAsset::register($this);
AppAssetCliente::register($this);
?>
<div class="container">
    <div class="well bs-component">
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
            <div class="col-lg-8">

                <?php $form = ActiveForm::begin();
                ?>
                <h3>Datos personales</h3>
                <?= $form->field($model, 'nombre')->input("text", ['maxlength' => '50'])->label("Nombre");?>
                <?= $form->field($model, 'apellido')->input("text", ['maxlength' => '50'])->label("Apellido"); ?>
                <?= $form->field($model, 'correo')->input("email")->label("Correo"); ?>
                <?= $form->field($model, 'telefono')->input('text', ['maxlength' => '20'])->label("Tel&eacute;fono"); ?>
                <?= $form->field($model, 'direccion')->textInput(['readonly' => true])->label("Direcci&oacute;n"); ?>
                <?= $form->field($model, 'coordenadas')->textInput(['id' => 'coordenadas','style'=>'display:none;'])->label(""); ?>
                <?= Html::Button('Buscar Dirección', ['class' => 'btn btn-primary', 'onClick' => 'initMap();']); ?>
                <h3>Datos de usuario</h3>
                <?= $form->field($model, 'usuario')->textInput()->label("Usuario"); ?>
                <?= $form->field($model, 'contrasenia')->passwordInput()->label("Contrase&ntilde;a"); ?>
                <?= $form->field($model, 'confirmarContrasenia')->passwordInput()->label("Confirmar Contrase&ntilde;a"); ?>
                <?= Html::submitButton('Registrarme', ['class' => 'btn btn-primary', 'id' => 'btn-registrarme']); ?>
                <?php ActiveForm::end(); ?>
            </div>
            <div class="col-lg-4">
                <div id="map-container" style="width:100%">
                    <div id="map"></div>
                </div>
                <input id="pac-input" class="controls" type="text" placeholder="Busca tu partido / barrio " />
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
