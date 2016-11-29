<?php

use yii\helpers\BaseHtml;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
//use app\assets\AppAssetWebSite;
use app\assets\AppAssetChofer;
use app\assets\AppAsset;
use app\assets\BootswatchAsset;
use yii\helpers\Url;

raoul2000\bootswatch\BootswatchAsset::$theme = 'superhero';
BootswatchAsset::register($this);
AppAsset::register($this);
//AppAssetWebSite::register($this);
AppAssetChofer::register($this);

?>
<div class="container">
    <div class="row">
        <div class="col-lg-5">
            <h3>
                <strong>Calificar Servicio</strong>
            </h3>
            <h1>
                <?= Html::encode($this->title) ?>
            </h1>

            <?php if (Yii::$app->session->hasFlash('Calificacion exitosa!')): ?>
            <div class="alert alert-success">
                Gracias por su opini&oacute;n.
            </div>
            <?php else: ?>
            <?php $form = ActiveForm::begin(); ?>
            <h4>
                <u>Datos</u>
                <u>Calificaci&oacute;n</u>
            </h4>
            <?= $form->field($model, 'puntaje')->dropDownList(['prompt' => 'Seleccione...', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10']) ?>
            <?= $form->field($model, 'comentario')->textArea(['rows' => 7, 'column' => 4])->label('Comentario'); ?>
            <div id='botones-group'>
                <?= Html::submitButton('Calificar', ['class' => 'btn btn-primary', 'id' => 'btn-carga-calificacion']); ?>
                <?= Html::a('Cancelar', [('/chofer/lista_historial_viajes')],['class' => 'btn btn-primary btn-lg', 'id' => 'btn-cancelar']); ?>
            </div>
            <?php ActiveForm::end(); ?>

            <?php endif; ?>

        </div>
    </div>
</div>
