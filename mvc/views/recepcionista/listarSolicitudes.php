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
raoul2000\bootswatch\BootswatchAsset::$theme = 'superhero';
AppAssetRecepcionista::register($this);
$this->title = 'RemisYa';

?>
<?php
Modal::begin([
'header' => '
        <h4>Mensaje</h4>',
'id'=>'processmodal',
'size'=>'modal-sm',
'options'=>['class'=>'modal'],
'clientOptions' => ['backdrop' => 'static', 'keyboard' => false]
]);
echo "Procesando...";
Modal::end();
?>
<?php
Modal::begin([
'id' => 'modal',
'size' => 'modal-sm',
]);
echo "<div id='modalContent'></div>";
Modal::end();
?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h4 class="panel-title">Listado de viajes emitidos</h4>
    </div>
    <div class="panel-body">

        <?php Pjax::begin(['id'=>'containerpjax','timeout' => false]); ?>
        <?php if (Yii::$app->session->hasFlash('viajeActualizado')): ?>
        <div class="alert alert-success alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
            <h4>
                <i class="icon fa fa-check"></i>Operacion realizada.
            </h4>
            <?= Yii::$app->session->getFlash('viajeActualizado') ?>
        </div>
        <?php endif; ?>
        <?php if (Yii::$app->session->hasFlash('viajeCerrado')): ?>
        <div class="alert alert-success alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
            <h4>
                <i class="icon fa fa-check"></i>Operacion realizada.
            </h4>
            <?= Yii::$app->session->getFlash('viajeCerrado') ?>
        </div>
        <?php endif; ?>
        <?php if (Yii::$app->session->hasFlash('viajeCancelado')): ?>
        <div class="alert alert-success alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
            <h4>
                <i class="icon fa fa-check"></i>Operacion realizada.
            </h4>
            <?= Yii::$app->session->getFlash('viajeCancelado') ?>
        </div>
        <?php endif; ?>
        <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true]]);?>
        <div class="table-responsive">
            <?=
            GridView::widget([
            'id' => 'viajes_grid',
            'summary'=>'',
            'dataProvider' => $model->dataProvider,
            'tableOptions' => ['class' => 'table table-bordered table-hover', 'style'=>'border-collapse: collapse; border: 3px solid #df691a; '],
            'columns' => [
                ['header' => '<h5>Cliente</h5>','attribute' => 'ClienteNombre','contentOptions' => ['style'=>'border-color:black;'],'headerOptions' => ['style'=>'border-color:black;background-color:#df691a;']],
                ['header' => '<h5>Destino</h5>','attribute' => 'DestinoDireccion','contentOptions' => ['style'=>'border-color:black;',],'headerOptions' => ['style'=>'border-color:black;background-color:#df691a;']],
                ['header' => '<h5>Chofer</h5>','attribute' => 'ChoferNombre','contentOptions' => ['style'=>'border-color:black;',],'headerOptions' => ['style'=>'border-color:black;background-color:#df691a;']],
                ['header' => '<h5>Marca</h5>','attribute' => 'VehiculoMarca','contentOptions' => ['style'=>'border-color:black;',],'headerOptions' => ['style'=>'border-color:black;background-color:#df691a;']],
                ['header' => '<h5>Modelo</h5>','attribute' => 'VehiculoModelo','contentOptions' => ['style'=>'border-color:black;',],'headerOptions' => ['style'=>'border-color:black;background-color:#df691a;']],
                ['header' => '<h5>Canal</h5>','attribute' => 'ViajeTipo','contentOptions' => ['style'=>'border-color:black;',],'headerOptions' => ['style'=>'border-color:black;background-color:#df691a;']],
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
        <div id="buttonsOperaciones">
            <?= Html::button('Cerrar',['value' => Url::toRoute('recepcionista/listaviajes'),'class' => 'btn btn-lg btn-primary','name'=>'submit','operacion'=>'cerrar']);?>
            <?= Html::button('Cancelar',['value' => Url::toRoute('recepcionista/listaviajes'),'class' => 'btn btn-lg btn-primary','name'=>'submit','operacion'=>'cancelar']);?>
            <?= Html::button('Actualizar',['value' => Url::toRoute('recepcionista/actualizarviaje'), 'class' => 'btn btn-lg btn-primary', 'id' => 'actualizarButton','operacion'=>'actualizar',]);?>
            <?= Html::button('Enviar',['value' => Url::toRoute('recepcionista/listaviajes'),'class' => 'btn btn-lg btn-primary','name'=>'submit','operacion'=>'enviar']);?>
        </div>
    </div>
</div>
