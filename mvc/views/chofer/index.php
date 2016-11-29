<?php

use yii\helpers\BaseHtml;
use yii\helpers\Html;
//use app\assets\AppAsset;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use app\assets\BootswatchAsset;
use app\assets\AppAssetPopups;

raoul2000\bootswatch\BootswatchAsset::$theme = 'superhero';
BootswatchAsset::register($this);
//AppAsset::register($this);
AppAssetPopups::register($this);

Modal::begin([
    'id' => 'modal',
        //'size' => 'modal-lg',
]);
echo "<div id='modalContentChofer'></div>";
Modal::end();
?>
<div class="panel panel-primary">
    <div class="panel-heading" style="text-align: center">
        <div class="panel-title">
            <h3>
                Historial Viajes
            </h3>
        </div>
    </div>
    <div class="panel-body">

        <?php if (Yii::$app->session->hasFlash('viajeCerrado')): ?>
            <div class="alert alert-success alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
                <h4>
                    <i class="icon fa fa-check"></i>Operacion realizada.
                </h4>
                <?= Yii::$app->session->getFlash('viajeCerrado') ?>
            </div>
        <?php endif; ?>
        <?php $form = ActiveForm::begin([]); ?>
        <div class="table-responsive">
        </div>
        <div style="text-align: center">
            <?= Html::button('Calificar Usuario', ['value' => Url::toRoute('/chofer/calificar_conducta_usuario'), 'class' => 'btn btn-primary', 'id' => 'modalButtonCalificarUsuario']); ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>