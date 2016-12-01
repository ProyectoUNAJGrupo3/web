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
use app\assets\BootswatchAsset;

raoul2000\bootswatch\BootswatchAsset::$theme = 'superhero';
AppAssetRecepcionista::register($this);

?>
<?php
Modal::begin([
    'id' => 'cliente_modal',
    'size' => 'modal-lg',
]);
echo "<div id='modalContent'></div>";
Modal::end();
?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h4 class="panel-title">Administrar Clientes</h4>
    </div>
    <div class="panel-body">

<?php Pjax::begin(['id' => 'clientes_containerpjax', 'timeout' => false]); ?>
        <?php if (Yii::$app->session->hasFlash('clienteCreado')): ?>
            <div class="alert alert-success alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
                <h4>
                    <i class="icon fa fa-check"></i>Operacion realizada.
                </h4>
                <?= Yii::$app->session->getFlash('clienteCreado') ?>
            </div>
            <?php endif; ?>
        <?php if (Yii::$app->session->hasFlash('agregar_ClienteError')): ?>
            <div class="alert alert-danger alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
                <h4>
                    <i class="icon fa fa-check"></i>Operacion cancelada.
                </h4>
                <?= Yii::$app->session->getFlash('agregar_ClienteError') ?>
            </div>
            <?php endif; ?>
        <?php if (Yii::$app->session->hasFlash('clienteEliminado')): ?>
        <div class="alert alert-success alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
            <h4>
                <i class="icon fa fa-check"></i>Operacion realizada.
            </h4>
            <?= Yii::$app->session->getFlash('clienteEliminado') ?>
        </div>
        <?php endif; ?>
        <?php if (Yii::$app->session->hasFlash('eliminar_ClienteError')): ?>
        <div class="alert alert-danger alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
            <h4>
                <i class="icon fa fa-check"></i>Operacion cancelada.
            </h4>
            <?= Yii::$app->session->getFlash('eliminar_ClienteError') ?>
        </div>
        <?php endif; ?>
        <?php if (Yii::$app->session->hasFlash('clienteActualizado')): ?>
        <div class="alert alert-success alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
            <h4>
                <i class="icon fa fa-check"></i>Operacion realizada.
            </h4>
            <?= Yii::$app->session->getFlash('clienteActualizado') ?>
        </div>
        <?php endif; ?>
        <?php if (Yii::$app->session->hasFlash('actualizar_ClienteError')): ?>
        <div class="alert alert-danger alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
            <h4>
                <i class="icon fa fa-check"></i>Operacion cancelada.
            </h4>
            <?= Yii::$app->session->getFlash('actualizar_ClienteError') ?>
        </div>
        <?php endif; ?>
        <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true]]); ?>
        <div class="table-responsive">
            <?=
            GridView::widget([
            'id' => 'clientes_grid',
            'summary'=>'',
            'dataProvider' => $model->dataProvider,
            'tableOptions' => ['class' => 'table table-bordered table-hover', 'style'=>'border-collapse: collapse; border: 3px solid #df691a; '],
            'columns' => [
                ['header' => '<h5>Nombre</h5>','attribute' => 'Nombre','contentOptions' => ['style'=>'border-color:black;'],'headerOptions' => ['style'=>'border-color:black;background-color:#df691a;']],
                ['header' => '<h5>Apellido</h5>','attribute' => 'Apellido','contentOptions' => ['style'=>'border-color:black;'],'headerOptions' => ['style'=>'border-color:black;background-color:#df691a;']],
                ['header' => '<h5>Documento</h5>','attribute' => 'Documento','contentOptions' => ['style'=>'border-color:black;'],'headerOptions' => ['style'=>'border-color:black;background-color:#df691a;']],
                ['header' => '<h5>Telefono</h5>','attribute' => 'Telefono','contentOptions' => ['style'=>'border-color:black;'],'headerOptions' => ['style'=>'border-color:black;background-color:#df691a;']],
                ['header' => '<h5>Email</h5>','attribute' => 'Email','contentOptions' => ['style'=>'border-color:black;'],'headerOptions' => ['style'=>'border-color:black;background-color:#df691a;']],
            ],
            'rowOptions' => function ($model, $key, $index, $grid) {
                return ['rowid' => $key, 'onclick' => '$(this).addClass("success").siblings().removeClass("success");','style' => 'cursor:pointer'];
            },
      ]);
            ?>
        </div>
        <?php ActiveForm::end(); ?>
        <?php Pjax::end(); ?>
        <div id="clientesbuttonsOperaciones">
            <?= Html::button('Agregar',['value' => Url::toRoute('recepcionista/alta_cliente'), 'class' => 'btn btn-lg btn-primary', 'id' => 'cliente_agregarButton','operacion'=>'agregar',]);?>
            <?= Html::button('Modificar',['value' => Url::toRoute('recepcionista/actualizar_cliente'), 'class' => 'btn btn-lg btn-primary', 'id' => 'cliente_actualizarButton','operacion'=>'actualizar',]);?>
            <?= Html::button('Eliminar',['value' => Url::toRoute('recepcionista/eliminar_cliente'), 'class' => 'btn btn-lg btn-primary', 'id' => 'cliente_eliminarButton','operacion'=>'eliminar',]);?>
        </div>
    </div>
</div>