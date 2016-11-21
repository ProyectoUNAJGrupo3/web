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

AppAssetRecepcionista::register($this);
$this->title = 'RemisYa';
?>
<?php Pjax::begin(['id' => 'viajegrid_pjax']); ?>
<div class="panel panel-primary">
    
    <?php $form = ActiveForm::begin(['id'=>'viajeForm','enableAjaxValidation'=>true,'enableClientScript' => true,'options' => ['data-pjax' => true ]]);?>
    <?=
    GridView::widget([
    'id' => 'viajes_grid',
    'dataProvider' => $model->dataProvider,
    'tableOptions' => ['class' => 'table  table-bordered table-hover'],
    'columns' => [
    ['class' => 'yii\grid\CheckboxColumn'],
        'ClienteNombre',
        'DestinoDireccion',
        'ChoferNombre',
        'VehiculoMarca',
        'VehiculoModelo',
        'ViajeTipo',
        'Estado',
    ],]);
    ?>


    <?= $form->field($model, 'Chofer')->dropDownList($model->Choferes, ['prompt' => 'Seleccione chofer']) ?>
    <?= $form->field($model, 'Vehiculo')->dropDownList($model->Vehiculos, ['prompt' => 'Seleccione vehiculo']) ?>

    <?= Html::submitButton('Cerrar viaje', ['class' => 'btn btn-primary','name' => 'submit', 'value' => 'cerrar_viaje']) ?>
    <?= Html::submitButton('Cancelar viaje', ['class' => 'btn btn-primary','name' => 'submit', 'value' => 'cancelar_viaje']) ?>
    <?= Html::submitButton('Actualizar viaje', ['class' => 'btn btn-primary','name' => 'submit', 'value' => 'actualizar_viaje']) ?>

    <?= Html::button('Confirmar solicitud', ['class' => 'btn btn-primary']) ?>
    <?= Html::button('Cancelar solicitud', ['class' => 'btn btn-primary']) ?>
    <?php ActiveForm::end(); ?>
    
</div>
<?php Pjax::end(); ?>



<?php
$this->registerJs('
    // obtener la id del formulario y establecer el manejador de eventos
        $("form#viajeForm").on("beforeSubmit", function(e) {
            var form = $(this);
            $.post(
                form.attr("action"),
                form.serialize()
            )
            .done(function(result) {
alert("prp");
  form.parent().html(result.message);
                $.pjax.reload({container:"#viajes_grid", timeout: false});
            });
            return false;
        }).on("submit", function(e){
            e.preventDefault();
            e.stopImmediatePropagation();
            return false;
        });
    ');
?>