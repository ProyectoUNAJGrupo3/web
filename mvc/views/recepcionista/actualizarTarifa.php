<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAssetRecepcionista;
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
        <h4 class="panel-title">Modificar Tarifa</h4>
    </div>
    <div class="panel-body">

        <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'ViajeMinimo')->input("decimal", ['maxlength' => '10','id' => 'tarifa_viajeminimo'])->label("Precio de viaje minimo"); ?>
        <?= $form->field($model, 'KmMinimo')->input("decimal", ['maxlength' => '10','id' => 'tarifa_km_minimo'])->label("Km Minimo"); ?>
        <?= $form->field($model, 'PrecioKM')->input("decimal", ['maxlength' => '10','id' => 'tarifa_preciokm'])->label("Precio por Km"); ?>
        <?= $form->field($model, 'Comision')->input("decimal", ['maxlength' => '10','id' => 'tarifa_comision'])->label("Porcentaje de comision"); ?>
        <?= $form->field($model, 'Estado')->dropDownList([1 => 'Habilitado', 0 => 'Deshabilitado'],['options' => [ 1 => ['selected ' => true]]])->label("Estado") ?>
        <?= Html::submitButton('Confirmar', ['class' => 'btn btn-lg btn-primary']); ?>
        <?= Html::resetButton('Limpiar', ['class' => 'btn btn-lg btn-primary']); ?>
        <?php ActiveForm::end(); ?>

    </div>
</div>
