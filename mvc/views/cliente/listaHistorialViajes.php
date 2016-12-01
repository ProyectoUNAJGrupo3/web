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
BootswatchAsset::register($this);
AppAssetCliente::register($this);
//AppAssetPopups::register($this);
//AppAsset::register($this);
//AppAssetWebSite::register($this);
//AppAsset::register($this);
Modal::begin([
    'id' => 'modal',
    'size' => 'modal-lg',
]);
echo "<div id='modalContent'></div>";
Modal::end();
?>

<?php $form = ActiveForm::begin(); ?>
<br />
<br />
<div class="panel panel-primary">
    <div class="panel-heading">
        <h4 class="panel-title">&ensp; &ensp; Listado de Vehiculos</h4>
    </div>
    <div class="container">
 <?= $this->registerJs(
            "$( document ).ready(function() {
     var channelInfo = ". json_encode($socketInfo).";
    doThePush(channelInfo)});",\yii\web\View::POS_READY);
        ?>
        <div class="panel-body">
            <div class="row">
                <div class="table-responsive">

                    <?=
    GridView::widget(['id' => 'grid',
        'dataProvider' => $model->dataProvider,
        'columns' => [
            ['header' => '<h5>Nombre Agencia</h5>','attribute' =>'AgenciaNombre','contentOptions' => ['style'=>'border-color:black;'],'headerOptions' => ['style'=>'border-color:black;background-color:#df691a;']],
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
            ],
            /*Row Option para seleccionar*/
            'rowOptions' => function ($model, $key, $index, $grid) {
               return ['rowid' => $key, 'onclick' => '$(this).addClass("success").siblings().removeClass("success");','style' => 'cursor:pointer'];
                },
               ]);

                    ?>
                    <?= Html::Button('Calificar Servicio', ['value' => Url::toRoute('cliente/calificar_servicio'), 'class' => 'btn btn-primary', 'id' => 'buttonAbrirCalificacion']); ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>

            <!--</div>
                </article>
                </section>
            </div>-->
        </div>
    </div>
</div>