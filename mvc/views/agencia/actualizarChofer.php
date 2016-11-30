<?php

use yii\helpers\BaseHtml;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\AppAsset;
use app\assets\AppAssetAgencia;
use app\assets\BootswatchAsset;

raoul2000\bootswatch\BootswatchAsset::$theme = 'superhero';
BootswatchAsset::register($this);

AppAssetAgencia::register($this);
AppAsset::register($this);
?>
<!--<div class="container">
    <section id="main">
        <article>
            <div id="page-single-main">-->
<div class="container">
    <!--<div class="well bs-component">-->
    <div class="row">
        <div class="col-lg-8">
            <!--<div class="site-contact">
                    <div class="col-lg-20">
                        <section id="main">
                            <article>
                                <div id="page-single-main">
                                    <br />-->
            <h1>
                <strong>F&oacute;rmulario Actualizar Datos Chofer</strong>
            </h1>
            <!--<div class="container-form" >-->
            <!--<div id="map-container">
                    <div id="map"></div>
                </div>
                <input id="pac-input" class="controls" type="text" placeholder="Busca tu partido / barrio " />-->

            <h1>
                <?= Html::encode($this->title) ?>
            </h1>

            <?php if (Yii::$app->session->hasFlash('Empleado actualizado con exito')): ?>
            <div class="alert alert-dismissible alert-warning">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Operacion exitosa!</strong>
                <a href="#" class="alert-link">Empleado actualizado correctamente</a>.
                <?php endif; ?>


                <?php $form = ActiveForm::begin(); ?>
                <b>
                    <h3>
                        <u>Datos</u>
                        <u>Personales</u>
                    </h3>
                </b>
                <?= $form->field($model, 'nombre')->input("text", ['maxlength' => '50', 'id' => 'nombre'])->label("Nombre <b id='asterisco'>*</b>"); ?>
                <?= $form->field($model, 'apellido')->input("text", ['maxlength' => '50', 'id' => 'apellido'])->label("Apellido <b id='asterisco'>*</b>"); ?>
                <?= $form->field($model, 'dni')->input('text', ['maxlength' => '8', 'id' => 'dni'])->label("Documento <b id='asterisco'>*</b>"); ?>
                <?= $form->field($model, 'telefono')->input('text', ['maxlength' => '20', 'id' => 'telefono'])->label("Tel&eacute;fono <b id='asterisco'>*</b>"); ?>
                <b>
                    <h3>
                        <u>Datos</u>
                        <u>del</u>
                        <u>Chofer</u>
                    </h3>
                </b>
                <br />
                <?= $form->field($model, 'usuario')->textInput(['maxlength' => '50', 'id' => 'usuario'])->label("Usuario <b id='asterisco'>*</b>"); ?>
                <?= $form->field($model, 'contrasenia')->passwordInput(['maxlength' => '50', 'id' => 'contrasenia'])->label("Contrase&ntilde;a <b id='asterisco'>*</b>"); ?>
                <?= $form->field($model, 'confirmarContrasenia')->passwordInput(['maxlength' => '50', 'id' => 'confirmarContrasenia'])->label("Confirmar Contrase&ntilde;a <b id='asterisco'>*</b>"); ?>
                <b>Campos con</b>
                <b id="asterisco">*</b>
                <b>son obligatorios</b>
                <br />
                <div id='botones-group'>
                    <?= Html::submitButton('Actualizar', ['class' => 'btn btn-primary', 'id' => 'btn-guardar']); ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <?= Html::button('Cancelar', ['class' => 'btn btn-primary', 'id' => 'btn-cancelar']); ?>
                </div>
                <?php ActiveForm::end(); ?>
                <!--       </div>
                   </div>
                   </div>
               </article>
           </section>
        </div>-->
            </div>
        </div>
    </div>
</div>