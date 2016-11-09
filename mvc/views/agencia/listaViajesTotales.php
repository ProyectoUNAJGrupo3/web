<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

use app\assets\AppAsset;
use app\assets\AppAssetWebSite;
use yii\grid\GridView;
use yii\helpers\BaseHtml;
use yii\widgets\ActiveForm;
use yii\bootstrap\Dropdown;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Button;
AppAsset::register($this);
AppAssetWebSite::register($this);
/* @var $this yii\web\View */
$this->title = 'RemisYa';
?>
<div class="row">
    <div class="col-md-8">
        <div id="btn-bar">
            <?=
        $this->registerJs('$(document).ready(function () {
            initMap(true);
            $("#btn-ver-remiserias").on("click", function() {getRemiserias(true)});
            });', \yii\web\View::POS_READY);
            ?>
            <h3>
                Seleccione origen y destino:
            </h3>
        </div>
        <div id="mapHome" style="width:100%">
            <div id="map-Index">
                <div id="map"></div>
            </div>
            <input id="pac-input" class="controls" type="text" placeholder="Busca tu partido / barrio " />
        </div>
    </div>
    <div class="col-md-4">
        <?php $form = ActiveForm::begin(); ?>
        <b>
            <h3>
                Datos del viaje:
            </h3>
        </b>
        <?= $form->field($model, 'origenTexto')->input("text", ['id'=>'origenTexto','readonly' => true])->label("Origen"); ?>
        <?= $form->field($model, 'origen')->hiddenInput(['id' => 'origencoordenada'])->label(false); ?>
        <?= $form->field($model, 'destinoTexto')->input("text", ['id' => 'destinoTexto','readonly' => true])->label("Destino"); ?>
        <?= $form->field($model, 'destino')->hiddenInput(['id' => 'destinocoordenada'])->label(false);?>
        <div class="row"> 
            <div class="col-md-8">
                <?= $form->field($model, 'Distancia')->input("text", ['maxlength' => '50','readonly' => true])->label("Distancia"); ?>
            </div>
            <div class="col-md-4">
                <?= Html::button('Calcular Tarifa', ['class'=>'btn btn-primary', 'onclick' => '$("#viajesgridmodel-importetotal").val("'."110".'");']) ?>
            </div>
        </div>
        <?= $form->field($model, 'ImporteTotal')->input("text", ['maxlength' => '50'])->label("Importe total"); ?>
        <?= $form->field($model, 'Chofer')->dropDownList($model->Choferes,['prompt'=>'Seleccione chofer'])?>
        <?= $form->field($model, 'Vehiculo')->dropDownList($model->Vehiculos,['prompt'=>'Seleccione vehiculo'])?>

        <?= Html::submitButton('Crear Viaje', ['class' => 'btn btn-primary btn-lg', 'id' => 'btn-crearViaje']); ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
    
<?=
GridView::widget([
'dataProvider' => $model->dataProvider,
'columns' => [
       'ClienteNombre',
       'OrigenDireccion',
       'DestinoDireccion',
       'ChoferNombre',
       'VehiculoMarca',
       'VehiculoModelo',
       'FechaSalida',
       'ImporteTotal',
       'Distancia',
       'ViajeTipo',
       'Estado',
   ],]);
?>