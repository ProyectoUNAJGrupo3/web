<?php

use yii\helpers\BaseHtml;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\AppAsset;
use app\assets\AppAssetAgencia;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\bootstrap\Alert;
use app\assets\BootswatchAsset;

raoul2000\bootswatch\BootswatchAsset::$theme = 'superhero';
BootswatchAsset::register($this);
//AppAssetAgencia::register($this);
//AppAsset::register($this);
Modal::begin([
    'id' => 'modal',
    //'size' => 'modal-lg',
]);
echo "<div id='modalContent'></div>";
Modal::end();
?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h4 class="panel-title">Administrar Cliente</h4>
    </div>
    <div class="panel-body">

<?php Pjax::begin(['id' => 'solicitudes_containerpjax', 'timeout' => false]); ?>
        <?php if (Yii::$app->session->hasFlash('solicitudAutorizada')): ?>
            <div class="alert alert-success alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
                <h4>
                    <i class="icon fa fa-check"></i>Operacion realizada.
                </h4>
    <?= Yii::$app->session->getFlash('solicitudAutorizada') ?>
            </div>
            <?php endif; ?>
        <?php if (Yii::$app->session->hasFlash('solicitudRechazada')): ?>
            <div class="alert alert-success alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
                <h4>
                    <i class="icon fa fa-check"></i>Operacion realizada.
                </h4>
    <?= Yii::$app->session->getFlash('solicitudRechazada') ?>
            </div>
            <?php endif; ?>
        <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true]]); ?>
        <div class="table-responsive">

        </div>

<?php ActiveForm::end(); ?>
        <?php Pjax::end(); ?>
        <div id="solicitudesbuttonsOperaciones">

<?= Html::button('Agregar', ['value' => Url::toRoute('#'), 'class' => 'btn btn-primary btn-lg', 'id' => 'modalButton']); ?>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <?= Html::Button('Actualizar', ['value' => Url::toRoute('#'), 'valor' => 'actualizar', 'name' => 'submit', 'class' => 'btn btn-primary btn-lg', 'id' => 'actualizarButton']); ?>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <?= Html::Button('Eliminar', ['class' => 'btn btn-primary btn-lg', 'name' => 'submit', 'valor' => 'eliminar', 'id' => 'eliminarButton']); ?>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <?= Html::a('Cerrar', [('/recepcionista/index')], ['class' => 'btn btn-primary btn-lg', 'id' => 'btn-cancelar']); ?>
        </div>
    </div>
</div>