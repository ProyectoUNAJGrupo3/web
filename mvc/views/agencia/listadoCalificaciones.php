<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\assets\AppAssetAgencia;
use app\assets\AppAssetWebSite;
use yii\grid\GridView;
use yii\helpers\BaseHtml;
use yii\widgets\ActiveForm;
use yii\bootstrap\Dropdown;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Button;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use app\assets\BootswatchAsset;

raoul2000\bootswatch\BootswatchAsset::$theme = 'superhero';
/* BootswatchAsset::register($this); */
AppAssetAgencia::register($this);
AppAsset::register($this);
AppAssetWebSite::register($this);
?>
<h1>
    <?= Html::encode($this->title) ?>
</h1>
<?php if (Yii::$app->session->hasFlash('Recepcionista eliminado con exito')): ?>
    <div class="alert alert-dismissible alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Operacion exitosa!</strong>
        <a href="#" class="alert-link">Recepcionista Eliminado correctamente</a>.
    </div>
<?php endif ?>
<?php if (Yii::$app->session->hasFlash('Recepcionista creado con exito')): ?>
    <div class="alert alert-dismissible alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Operacion exitosa!</strong>
        <a href="#" class="alert-link">Recepcionista creado con exito</a>.
    </div>
<?php endif ?>
<?php if (Yii::$app->session->hasFlash('Recepcionista actualizado con exito')): ?>
    <div class="alert alert-dismissible alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Operacion exitosa!</strong>
        <a href="#" class="alert-link">Recepcionista actualizado correctamente</a>.
    </div>
<?php endif ?>


<?php $form = ActiveForm::begin(); ?>
<br />
<br />
<div class="panel panel-primary">
    <div class="panel-heading" style="text-align: center">
        <div class="panel-title">
            <h4>&ensp; &ensp; Listado Calificaciones</h4>
        </div>
    </div>
    <div class="container">
        <div class="panel-body">
            <div class="row">
                <div class="table-responsive">
                </div>
                <?php ActiveForm::end(); ?>
                <div  style="text-align: center">
                    <?= Html::a('Cerrar', [('/agencia/index')], ['class' => 'btn btn-primary btn-lg', 'id' => 'btn-cancelar']); ?>
                </div>
            </div>
        </div>
    </div>
</div>
