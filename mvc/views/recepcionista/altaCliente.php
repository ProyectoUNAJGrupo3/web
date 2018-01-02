<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\BootswatchAsset;
use app\assets\AppAssetRecepcionista;
use app\assets\AppAsset;
use yii\grid\GridView;
use yii\helpers\BaseHtml;
use yii\widgets\ActiveForm;
use yii\bootstrap\Dropdown;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Button;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\bootstrap\Alert;

raoul2000\bootswatch\BootswatchAsset::$theme = 'superhero';
AppAssetRecepcionista::register($this);
$this->title = 'RemisYa';
?>


<div class="panel panel-primary">
    <div class="panel-heading">
        <h4 class="panel-title">Nuevo cliente</h4>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-8">

                <?php $form = ActiveForm::begin();?>
                <h3>Datos personales</h3>
                <?= $form->field($model, 'nombre')->input("text", ['maxlength' => '50'])->label("Nombre");?>
                <?= $form->field($model, 'apellido')->input("text", ['maxlength' => '50'])->label("Apellido"); ?>
                <?= $form->field($model, 'documento')->input("decimal", ['maxlength' => '8'])->label("Nro Documento"); ?>
                <?= $form->field($model, 'correo')->input("email")->label("Correo"); ?>
                <?= $form->field($model, 'telefono')->input('text', ['maxlength' => '20'])->label("Tel&eacute;fono"); ?>
                <?= $form->field($model, 'direccion')->textInput(['id'=>'altacliente_direccion','readonly' => true])->label("Direcci&oacute;n"); ?>
                <?= $form->field($model, 'coordenadas')->textInput(['id' => 'altacliente_coordenada','style'=>'display:none;'])->label(""); ?>
                <?= Html::Button('Buscar Direcci&oacute;n', ['class' => 'btn btn-primary', 'onClick' => 'initMap(false);']); ?>
                <h3>Datos de usuario</h3>
                <?= $form->field($model, 'usuario')->textInput()->label("Usuario"); ?>
                <?= $form->field($model, 'contrasenia')->passwordInput()->label("Contrase&ntilde;a"); ?>
                <?= $form->field($model, 'confirmarContrasenia')->passwordInput()->label("Confirmar Contrase&ntilde;a"); ?>

                <?= Html::submitButton('Confirmar', ['class' => 'btn btn-primary']); ?>
                <?= Html::resetButton('Limpiar', ['class' => 'btn btn-primary']); ?>
                <?php ActiveForm::end(); ?>
            </div>
            <div class="col-lg-4">
                <div id="map-container" style="width:100%">
                    <div id="map"></div>
                </div>
                <input id="pac-input" class="controls" type="text" placeholder="Busca tu partido / barrio " />
            </div>
        </div>
    </div>
</div>