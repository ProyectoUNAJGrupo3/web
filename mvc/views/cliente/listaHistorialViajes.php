<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\assets\AppAssetCliente;
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
AppAssetCliente::register($this);
//AppAssetPopups::register($this);
//AppAsset::register($this);
//AppAssetWebSite::register($this);
//AppAsset::register($this);
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

            <div class="panel-body">
                <div class="row">
                    <div class="table-responsive">

                                <!--<div class="well bs-component">-->
                                   <?= $this->registerJs(
                                    "$( document ).ready(function() {
                             var channelInfo = ". json_encode($socketInfo).";
                            doThePush(channelInfo)});",\yii\web\View::POS_READY);
                             ?>
   
                <?=
                GridView::widget(['id' => 'grid',
                    'dataProvider' => $model->dataProvider,
                    'tableOptions' => ['class' => 'table table-bordered table-hover', 'style'=>'border-collapse: collapse; border: 3px solid #df691a; '],

                    'columns' => [
                        /*['class'  => 'yii\grid\CheckboxColumn','contentOptions' => ['style'=>'border-color:black;'],'headerOptions' => ['style'=>'border-color:black;background-color:#df691a;']],*/
                        ['header' => '<h5>Nombre de Agencia</h5>','attribute' => 'AgenciaNombre','contentOptions' => ['style'=>'border-color:black;',],'headerOptions' => ['style'=>'border-color:black;background-color:#df691a;']],
                        ['header' => '<h5>Direccion Origen</h5>','attribute' => 'OrigenDireccion','contentOptions' => ['style'=>'border-color:black;',],'headerOptions' => ['style'=>'border-color:black;background-color:#df691a;']],
                        ['header' => '<h5>Direccion Destino</h5>','attribute' => 'DestinoDireccion','contentOptions' => ['style'=>'border-color:black;',],'headerOptions' => ['style'=>'border-color:black;background-color:#df691a;']],
                        ['header' => '<h5>Nombre del Chofer</h5>','attribute' => 'ChoferNombre','contentOptions' => ['style'=>'border-color:black;',],'headerOptions' => ['style'=>'border-color:black;background-color:#df691a;']],
                        ['header' => '<h5>marca del Vehiculo</h5>','attribute' => 'VehiculoMarca','contentOptions' => ['style'=>'border-color:black;',],'headerOptions' => ['style'=>'border-color:black;background-color:#df691a;']],
                        ['header' => '<h5>Modelo del Vehiculo</h5>','attribute' => 'VehiculoModelo','contentOptions' => ['style'=>'border-color:black;'],'headerOptions' => ['style'=>'border-color:black;background-color:#df691a;']],
                        ['header' => '<h5>Fecha de salida</h5>','attribute' => 'FechaSalida','contentOptions' => ['style'=>'border-color:black;',],'headerOptions' => ['style'=>'border-color:black;background-color:#df691a;']],
                        ['header' => '<h5>Importe Total</h5>','attribute' => 'ImporteTotal','contentOptions' => ['style'=>'border-color:black;',],'headerOptions' => ['style'=>'border-color:black;background-color:#df691a;']],
                        ['header' => '<h5>Distancia</h5>','attribute' => 'Distancia','contentOptions' => ['style'=>'border-color:black;',],'headerOptions' => ['style'=>'border-color:black;background-color:#df691a;']],
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
                <?= Html::Button('Abrir ventana calificar', ['value' => Url::toRoute('/cliente/calificar_servicio'), 'class' => 'btn btn-primary', 'id' => 'buttonAbrirCalificacion']); ?>
                  <?php $form = ActiveForm::end(); ?>
      
  </div>

                        <?php
                        /*$this->registerJs(
                                "$( document ).ready(function() {
                        $('#modalButtonCalificarServicio').click(function(){
                                var keys = $('#calificar_grid').yiiGridView('getSelectedRows');

                                                                        $.ajax({
                                                type     :'post',
                                                cache    : true,
                                                data: {keylist: keys},
                                                url  : '" . Url::to(['cliente/calificar_servicio']) . "',
                                                success  : function() {
                                                    alert('prueba');

                                                },
                                                error: function(){
                                                   alert('Error');
                                                    $('#processmodal').modal('hide');
                                                }
                                                });return false;
                        });
                        });"
                        );
                        ?>*/
                         ?>
 </div>

<?= $this->registerJs(
            "$( document ).ready(function() {
     var channelInfo = ". json_encode($socketInfo).";
    doThePush(channelInfo)});",\yii\web\View::POS_READY);
        ?>