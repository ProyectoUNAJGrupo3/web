<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
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
$this->title = 'RemisYa';
?>

<div class="panel panel-primary">
    <div class="panel-heading" style="text-align: center">
        <div class="panel-title">
            <h3>
                Solicitudes Online
            </h3>
        </div>
    </div>
    <div class="panel-body">

        <?php if (Yii::$app->session->hasFlash('viajeCerrado')): ?>
            <div class="alert alert-success alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
                <h4>
                    <i class="icon fa fa-check"></i>Operacion realizada.
                </h4>
                <?= Yii::$app->session->getFlash('viajeCerrado') ?>
            </div>
        <?php endif; ?>
        <?php $form = ActiveForm::begin([]); ?>
        <div class="table-responsive">
        </div>
        <?php ActiveForm::end(); ?>
        <div style="text-align: center">
            <?= Html::button('Aceptar solicitud', ['class' => 'btn btn-lg btn-primary', 'name' => 'submit', 'value' => 'aceptar']); ?>
            <?= Html::button('Cancelar Solicitud', ['class' => 'btn btn-lg btn-primary', 'name' => 'submit', 'value' => 'cancelar']); ?>
        </div>

    </div>
</div>
