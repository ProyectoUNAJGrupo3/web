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

<?php $form = ActiveForm::begin(); ?>
<br />
<br />
<div class="panel panel-primary">
    <div class="panel-heading" style="text-align: center">
        <div class="panel-title">
            <h4>&ensp; &ensp; Listado Viajes</h4>
        </div>
    </div>
    <div class="container">
        <div class="panel-body">
            <div class="row">
                <div class="table-responsive">
                </div>
                <?=
                GridView::widget(['id' => 'grid',
        'dataProvider' => $model->dataProvider,
        'columns' => [
            ['header' => '<h5>Origen Direccion</h5>','attribute' =>'OrigenDireccion','contentOptions' => ['style'=>'border-color:black;'],'headerOptions' => ['style'=>'border-color:black;background-color:#df691a;']],
            ['header' => '<h5>Destino Direccion</h5>','attribute' =>'DestinoDireccion','contentOptions' => ['style'=>'border-color:black;'],'headerOptions' => ['style'=>'border-color:black;background-color:#df691a;']],
            ['header' => '<h5>Nombre Chofer</h5>','attribute' =>'ChoferNombre','contentOptions' => ['style'=>'border-color:black;'],'headerOptions' => ['style'=>'border-color:black;background-color:#df691a;']],
            ['header' => '<h5>Marca Vehiculo</h5>','attribute' =>'VehiculoMarca','contentOptions' => ['style'=>'border-color:black;'],'headerOptions' => ['style'=>'border-color:black;background-color:#df691a;']],
            ['header' => '<h5>Modelo Vehiculo</h5>','attribute' =>'VehiculoModelo','contentOptions' => ['style'=>'border-color:black;'],'headerOptions' => ['style'=>'border-color:black;background-color:#df691a;']],
            ['header' => '<h5>Fecha Salida</h5>','attribute' =>'FechaSalida','contentOptions' => ['style'=>'border-color:black;'],'headerOptions' => ['style'=>'border-color:black;background-color:#df691a;']],
            ['header' => '<h5>Importe Total</h5>','attribute' =>'ImporteTotal','contentOptions' => ['style'=>'border-color:black;'],'headerOptions' => ['style'=>'border-color:black;background-color:#df691a;']],
            ['header' => '<h5>Distancia en Km</h5>','attribute' =>'Distancia','contentOptions' => ['style'=>'border-color:black;'],'headerOptions' => ['style'=>'border-color:black;background-color:#df691a;']],
            ['header' => '<h5>Tipo de viaje</h5>','attribute' =>'ViajeTipo','contentOptions' => ['style'=>'border-color:black;'],'headerOptions' => ['style'=>'border-color:black;background-color:#df691a;']],
            ['header' => '<h5>Estado</h5>','attribute' =>'Estado','contentOptions' => ['style'=>'border-color:black;'],'headerOptions' => ['style'=>'border-color:black;background-color:#df691a;']],
            ]
               ]);
                ?>

                <div style="text-align: center">
                    <?= Html::a('Cerrar', [('/agencia/index')], ['class' => 'btn btn-primary btn-lg', 'id' => 'btn-cancelar']); ?>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
