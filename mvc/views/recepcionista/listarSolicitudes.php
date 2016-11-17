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

AppAssetRecepcionista::register($this);
/* @var $this yii\web\View */
$this->title = 'RemisYa';
?>

    

    
<?=Html::beginForm(['recepcionista/cerrar'],'post');?>
    <?=
    GridView::widget([
    'id' => 'viajes_grid',
    'dataProvider' => $model->dataProvider,
    'tableOptions' => ['class' => 'table  table-bordered table-hover'],
    'columns' => [
            ['class' => 'yii\grid\CheckboxColumn','checkboxOptions' => function($model, $key, $index, $widget) {
                return ['value' => $model['VehiculoModelo'] ];
            },],
        'ClienteNombre',
        'DestinoDireccion',
        'ChoferNombre',
        'VehiculoMarca',
        'VehiculoModelo',
        'ViajeTipo',
        'Estado',
    ],]);
    ?>
<?= Html::endForm();?>

<?php $form = ActiveForm::begin();?>
    <?= $form->field($model, 'Chofer')->dropDownList($model->Choferes, ['prompt' => 'Seleccione chofer']) ?>
    <?= $form->field($model, 'Vehiculo')->dropDownList($model->Vehiculos, ['prompt' => 'Seleccione vehiculo']) ?>
    
    <?= Html::a('Cerrar viaje',['recepcionista/cerrar'], ['class' => 'btn btn-primary']) ?>

    <?= Html::button('Cancelar viaje', ['class' => 'btn btn-primary']) ?>


    <?= Html::button('Modificar viaje', ['class' => 'btn btn-primary']) ?>

    <?= Html::button('Confirmar solicitud', ['class' => 'btn btn-primary']) ?>

    <?= Html::button('Cancelar solicitud', ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end(); ?>
