<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\assets\AppAssetChofer;
//use app\assets\AppAssetWebSite;
use yii\grid\GridView;
use yii\helpers\BaseHtml;
use yii\widgets\ActiveForm;
use yii\bootstrap\Dropdown;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Button;
use yii\bootstrap\Modal;
use app\assets\BootswatchAsset;
use yii\helpers\Url;
//use app\assets\AppAssetPopups;

$this->title = 'RemisYa';
raoul2000\bootswatch\BootswatchAsset::$theme = 'superhero';
/*BootswatchAsset::register($this);*/
AppAssetChofer::register($this);
AppAsset::register($this);

Modal::begin([
    'id' => 'modal',
    'size' => 'modal-md',
]);
echo "<div id='modalContent'></div>";
Modal::end();
?>

 
<div class="panel panel-primary">
    <div class="panel-heading">
        <h4 class="panel-title">&ensp; &ensp;  Historial de Viajes</h4>
    </div>
    <!--<div class="container">-->
    <div class="panel-body">
        <div class="row">
            <div class="table-responsive">
                <?=
                    GridView::widget(['id' => 'grid',
                        'dataProvider' => $model->dataProvider,

                        'tableOptions' => ['class' => 'table table-bordered table-hover', 'style'=>'border-collapse: collapse; border: 3px solid #df691a; '],

                        'columns' => [
                                ['header' => '<h5>marca del vehiculo</h5>','attribute' => 'VehiculoMarca','contentOptions' => ['style'=>'border-color:black;',],'headerOptions' => ['style'=>'border-color:black;background-color:#df691a;']],
                                ['header' => '<h5>Modelo del Vehiculo</h5>','attribute' => 'VehiculoModelo','contentOptions' => ['style'=>'border-color:black;',],'headerOptions' => ['style'=>'border-color:black;background-color:#df691a;']],
                                ['header' => '<h5>Cliente</h5>','attribute' => 'ClienteNombre','contentOptions' => ['style'=>'border-color:black;',],'headerOptions' => ['style'=>'border-color:black;background-color:#df691a;']],
                                ['header' => '<h5>direccion Origen</h5>','attribute' => 'OrigenDireccion','contentOptions' => ['style'=>'border-color:black;'],'headerOptions' => ['style'=>'border-color:black;background-color:#df691a;']],
                                ['header' => '<h5>Direccion Destino</h5>','attribute' => 'DestinoDireccion','contentOptions' => ['style'=>'border-color:black;',],'headerOptions' => ['style'=>'border-color:black;background-color:#df691a;']],
                                ['header' => '<h5>Fecha de Salida</h5>','attribute' => 'FechaSalida','contentOptions' => ['style'=>'border-color:black;',],'headerOptions' => ['style'=>'border-color:black;background-color:#df691a;']],
                                ['header' => '<h5>Importe Total</h5>','attribute' => 'ImporteTotal','contentOptions' => ['style'=>'border-color:black;',],'headerOptions' => ['style'=>'border-color:black;background-color:#df691a;']],
                                ['header' => '<h5>Distancia</h5>','attribute' => 'Distancia','contentOptions' => ['style'=>'border-color:black;',],'headerOptions' => ['style'=>'border-color:black;background-color:#df691a;']],
                                ['header' => '<h5>Tipo de Viaje</h5>','attribute' => 'ViajeTipo','contentOptions' => ['style'=>'border-color:black;'],'headerOptions' => ['style'=>'border-color:black;background-color:#df691a;']],
                                ['header' => '<h5>Estado</h5>','attribute' => 'Estado','contentOptions' => ['style'=>'border-color:black;',],'headerOptions' => ['style'=>'border-color:black;background-color:#df691a;']],

                        ],
                        'rowOptions' => function ($model, $key, $index, $grid) {
                               return ['rowid' => $key, 'onclick' => '$(this).addClass("success").siblings().removeClass("success");','style' => 'cursor:pointer'];
                           },
                    ]);
                ?>
            </div>
        </div>

        <?php $form = ActiveForm::begin(); ?>
        <?= Html::Button('Abrir ventana calificar', ['value' => Url::toRoute('/chofer/calificar_cliente'), 'class' => 'btn btn-primary', 'id' => 'buttonAbrirCalificacion']); ?>
        <?php $form = ActiveForm::end(); ?>
    </div>
</div>



                             
    
