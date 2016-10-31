<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

use app\assets\AppAssetAgencia;
use yii\grid\GridView;
use yii\helpers\BaseHtml;
use yii\widgets\ActiveForm;
use yii\bootstrap\Dropdown;
use yii\helpers\ArrayHelper;

AppAssetAgencia::register($this);
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
            <label id="distancia" class="display:none">
                <strong>
                    <p>
                        Distancia :
                    </p>

                </strong>
            </label>
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
        <?= $form->field($model, 'Origen')->input("text", ['maxlength' => '50'])->label("Origen"); ?>
        <?= $form->field($model, 'OrigenCoordenada')->hiddenInput(['id' => 'origencoordenada'])->label(false); ?>
        <?= $form->field($model, 'Destino')->input("text", ['maxlength' => '50'])->label("Destino"); ?>
        <?=
        $form->field($model, 'DestinoCoordenada')->hiddenInput(['id' => 'destinocoordenada'])->label(false);
        ?>
        <div class="row">
            <div class="col-md-8">
                <?= $form->field($model, 'Distancia')->input("text", ['maxlength' => '50'])->label("Distancia"); ?>
            </div>
            <div class="col-md-4">
                <?= Html::a('Calcular Tarifa', $model->setTarifa(), ['class'=>'btn btn-primary']) ?>
            </div>
        </div>
        <?= $form->field($model, 'ImporteTotal')->input("text", ['maxlength' => '50'])->label("Importe total"); ?>
        <?= $form->field($model, 'Chofer')->dropDownList($model->Chofer,['prompt'=>'Seleccione chofer'])?>
        <?= $form->field($model, 'Vehiculo')->dropDownList($model->Vehiculo,['prompt'=>'Seleccione vehiculo'])?>
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