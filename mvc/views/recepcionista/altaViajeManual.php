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

AppAssetRecepcionista::register($this);
raoul2000\bootswatch\BootswatchAsset::$theme = 'superhero';
/* @var $this yii\web\View */
$this->title = 'RemisYa';
Modal::begin([
'header' => '<h2>Viajes</h2>',
'id'=>'modal',
'size'=>'modal-lg',
'clientOptions' => ['backdrop' => false],
]);
echo "<div id='modalContent'></div>";
Modal::end();
?>
<?php Pjax::begin(['id' => 'viaje_pjax']); ?>

<?php if (Yii::$app->session->hasFlash('viajeCreado')): ?>
<div class="alert alert-dismissible alert-success">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Operacion exitosa!</strong>
    <a href="#" class="alert-link">Viaje creado correctamente</a>.
</div>
<?php endif ?>
<?php if (Yii::$app->session->hasFlash('viajeCerrado')): ?>
<div class="alert alert-dismissible alert-success">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Operacion exitosa!</strong>
    <a href="#" class="alert-link">Viaje cerrado correctamente</a>.
</div>
<?php endif ?>
<?php if (Yii::$app->session->hasFlash('viajeCancelado')): ?>
<div class="alert alert-dismissible alert-warning">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Operacion exitosa!</strong>
    <a href="#" class="alert-link">Viaje cerrado correctamente</a>.
</div>
<?php endif ?>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h4 class="panel-title">Administrador de Viajes</h4>
    </div>
    <div class="panel-body">
        <div class="row">
            
            <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true ]]); ?>
            <div class="col-lg-8">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>Seleccione Origen y Destino: </h3></div>
                    <div class="panel-body">
                        <fieldset>
                            <div id="btn-bar">
                                <?=
                                    $this->registerJs('$(document).ready(function () {
            initMap(true);
            $("#btn-ver-remiserias").on("click", function() {getRemiserias(true)});
            });', \yii\web\View::POS_READY);
                                ?>
                            </div>
                            <div id="mapHome">
                                <div id="map-Index">
                                    <div id="map"></div>
                                </div>
                                <input id="pac-input" class="controls" type="text" placeholder="Busca tu partido / barrio " />
                            </div>
                            <?= $form->field($model, 'Comentario')->textArea(['rows' => '4']) ?>
                        </fieldset>
                    </div>
                </div>

            </div>
            <div class="col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>Datos del viaje: </h3>
                    </div>
                    <div class="panel-body">
                        <fieldset>
                            <?= $form->field($model, 'origenTexto')->input("text", ['id'=>'origenTexto','readonly' => true])->label("Origen"); ?>
                            <?= $form->field($model, 'origen')->hiddenInput(['id' => 'origencoordenada'])->label(false); ?>
                            <?= $form->field($model, 'destinoTexto')->input("text", ['id' => 'destinoTexto','readonly' => true])->label("Destino"); ?>
                            <?= $form->field($model, 'destino')->hiddenInput(['id' => 'destinocoordenada'])->label(false);?>
                            <div class="row">
                                <div class="col-md-4">
                                    <?= $form->field($model, 'Distancia')->input("text", ['id'=>'distancia','maxlength' => '50','readonly' => true])->label("Distancia"); ?>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label class="control-label">Tarifa automatica x Km</label>
                                        <div class="input-group">
                                            <span class="input-group-addon" style="background-color:#2b3e50">$</span>
                                            <?= Html::input('text', 'PrecioKM', $model->PrecioKM, ['class' => 'form-control','id'=>'precioKM']) ?>

                                            <span class="input-group-btn">
                                                <?=
 Html::button('Calcular', ['class'=>'btn btn-primary', 'onclick' => '$("#importetotal").val((($("#precioKM").val())*($("#distancia").val().replace(" Km",""))).toFixed(0) + " $");'])
                                                ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?= $form->field($model, 'ImporteTotal')->input("text", ['maxlength' => '50','id' => 'importetotal'])->label("Importe aproximado"); ?>
                            <?= $form->field($model, 'Chofer')->dropDownList($model->Choferes,['prompt'=>'Seleccione chofer'])?>
                            <?= $form->field($model, 'Vehiculo')->dropDownList($model->Vehiculos,['prompt'=>'Seleccione vehiculo'])?>

                            <div class="btn-group">
                                <?= Html::submitButton('Crear Viaje', ['class' => 'btn btn-primary btn-lg', 'id' => 'btn-crearViaje']); ?>
                                <?= Html::button('Ver Viajes', ['value'=>Url::toRoute('listar_solicitudes_servicio'),'class'=>'btn btn-primary btn-lg','id'=>'modalButton']) ?>
                            </div>
                        </fieldset>
                    </div>
                </div>

            </div>
            <?php ActiveForm::end(); ?>
            
        </div>
    </div>
</div>
<?php Pjax::end(); ?>

<?php

$this->registerJs(
   '$("document").ready(function(){
        $("#viaje_pjax").on("pjax:end", function() {
        });
    });'
);
?>