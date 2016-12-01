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
        <h4 class="panel-title">Actualizar Cliente</h4>
    </div>
    <div class="panel-body">

        <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true]]); ?>
        <div class="table-responsive">

        </div>

        <?php ActiveForm::end(); ?>
        <div id="solicitudesbuttonsOperaciones">
            <?= Html::button('Actualizar', ['class' => 'btn btn-lg btn-primary', 'id' => 'autorizarButton', 'operacion' => 'autorizar',]); ?>
            <?= Html::button('Cerrar', ['class' => 'btn btn-lg btn-primary', 'name' => 'submit', 'operacion' => 'rechazar']); ?>
        </div>
    </div>
</div>
