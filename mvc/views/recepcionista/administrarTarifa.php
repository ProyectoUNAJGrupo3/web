<?php

use yii\helpers\BaseHtml;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\AppAssetRecepcionista;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\bootstrap\Alert;

raoul2000\bootswatch\BootswatchAsset::$theme = 'superhero';
AppAssetRecepcionista::register($this);
?>
<?php
Modal::begin([
'id' => 'tarifa_modal',
'size' => 'modal-md',
]);
echo "<div id='modalContent'></div>";
Modal::end();
?>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h4 class="panel-title">Administrar Tarifa</h4>
    </div>
    <div class="panel-body">

        <?php Pjax::begin(['id' => 'tarifas_containerpjax', 'timeout' => false]); ?>
        <?php if (Yii::$app->session->hasFlash('tarifaCreada')): ?>
            <div class="alert alert-success alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
                <h4>
                    <i class="icon fa fa-check"></i>Operacion realizada.
                </h4>
                <?= Yii::$app->session->getFlash('tarifaCreada') ?>
            </div>
        <?php endif; ?>
        <?php if (Yii::$app->session->hasFlash('altaTarifaError')): ?>
            <div class="alert alert-danger alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
                <h4>
                    <i class="icon fa fa-check"></i>Operacion cancelada.
                </h4>
                <?= Yii::$app->session->getFlash('altaTarifaError') ?>
            </div>
        <?php endif; ?>
        <?php if (Yii::$app->session->hasFlash('tarifaEliminada')): ?>
        <div class="alert alert-success alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
            <h4>
                <i class="icon fa fa-check"></i>Operacion realizada.
            </h4>
            <?= Yii::$app->session->getFlash('tarifaEliminada') ?>
        </div>
        <?php endif; ?>
        <?php if (Yii::$app->session->hasFlash('eliminarTarifaError')): ?>
        <div class="alert alert-danger alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
            <h4>
                <i class="icon fa fa-check"></i>Operacion cancelada.
            </h4>
            <?= Yii::$app->session->getFlash('eliminarTarifaError') ?>
        </div>
        <?php endif; ?>
        <?php if (Yii::$app->session->hasFlash('tarifaActualizada')): ?>
        <div class="alert alert-success alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
            <h4>
                <i class="icon fa fa-check"></i>Operacion realizada.
            </h4>
            <?= Yii::$app->session->getFlash('tarifaActualizada') ?>
        </div>
        <?php endif; ?>
        <?php if (Yii::$app->session->hasFlash('actualizar_TarifaError')): ?>
        <div class="alert alert-danger alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
            <h4>
                <i class="icon fa fa-check"></i>Operacion cancelada.
            </h4>
            <?= Yii::$app->session->getFlash('actualizar_TarifaError') ?>
        </div>
        <?php endif; ?>
        <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true]]); ?>
        <div class="table-responsive">
            <?=
            GridView::widget([
            'id' => 'tarifas_grid',
            'summary'=>'',
            'dataProvider' => $model->dataProvider,
            'tableOptions' => ['class' => 'table table-bordered table-hover', 'style'=>'border-collapse: collapse; border: 3px solid #df691a; '],
            'columns' => [
                ['header' => '<h5>TarifaID</h5>','attribute' => 'TarifaID','contentOptions' => ['style'=>'border-color:black;'],'headerOptions' => ['style'=>'border-color:black;background-color:#df691a;']],
                ['header' => '<h5>Precio Viaje Minimo</h5>','attribute' => 'ViajeMinimo','contentOptions' => ['style'=>'border-color:black;',],'headerOptions' => ['style'=>'border-color:black;background-color:#df691a;']],
                ['header' => '<h5>KmMinimo</h5>','attribute' => 'KmMinimo','contentOptions' => ['style'=>'border-color:black;',],'headerOptions' => ['style'=>'border-color:black;background-color:#df691a;']],
                ['header' => '<h5>PrecioKm</h5>','attribute' => 'PrecioKM','contentOptions' => ['style'=>'border-color:black;',],'headerOptions' => ['style'=>'border-color:black;background-color:#df691a;']],
                ['header' => '<h5>Comision</h5>','attribute' => 'Comision','contentOptions' => ['style'=>'border-color:black;',],'headerOptions' => ['style'=>'border-color:black;background-color:#df691a;']],
                ['header' => '<h5>Estado</h5>','attribute' => 'Estado','contentOptions' => ['style'=>'border-color:black;',],'headerOptions' => ['style'=>'border-color:black;background-color:#df691a;']],
            ],
            'rowOptions' => function ($model, $key, $index, $grid) {
                return ['rowid' => $key, 'onclick' => '$(this).addClass("success").siblings().removeClass("success");','style' => 'cursor:pointer'];
            },
      ]);
            ?>
        </div>

        <?php ActiveForm::end(); ?>
        <?php Pjax::end(); ?>
        <div id="tarifasbuttonsOperaciones">
            <?= Html::button('Agregar',['value' => Url::toRoute('recepcionista/alta_tarifa'), 'class' => 'btn btn-lg btn-primary', 'id' => 'tarifa_agregarButton','operacion'=>'agregar',]);?>
            <?= Html::button('Modificar',['value' => Url::toRoute('recepcionista/actualizar_tarifa'), 'class' => 'btn btn-lg btn-primary', 'id' => 'tarifa_actualizarButton','operacion'=>'actualizar',]);?>
            <?= Html::button('Eliminar',['value' => Url::toRoute('recepcionista/eliminar_tarifa'), 'class' => 'btn btn-lg btn-primary', 'id' => 'tarifa_eliminarButton','operacion'=>'eliminar',]);?>
        </div>
    </div>
</div>
