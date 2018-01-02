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

            <?php if (Yii::$app->session->hasFlash('Calificacion exitosa!')): ?>
            <div class="alert alert-success">
                Gracias por su opini&oacute;n.
            </div>
            <?php else: ?>


    <div class="panel panel-primary">
    <div class="panel-heading">
        <h4 class="panel-title">&ensp; &ensp;  Calificar servicio</h4>
    </div>
    <div class="panel-body">
        <?php $form = ActiveForm::begin(); ?>
        <h4>
            <u>Datos</u>
            <u>Calificaci&oacute;n</u>
        </h4>
        <?= $form->field($model, 'puntaje')->dropDownList(['prompt' => 'Seleccione...', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10']) ?>
        <?= $form->field($model, 'comentario')->textArea(['rows' => 7, 'column' => 4])->label('Comentario'); ?>
        <?= Html::submitButton('Calificar', ['class' => 'btn btn-primary btn-lg', 'id' => 'btn-carga-calificacion']); ?>
            <?= Html::a('Cancelar', [('/chofer/lista_historial_viajes')],['class' => 'btn btn-primary btn-lg', 'id' => 'btn-cancelar']); ?>
        <?php ActiveForm::end(); ?>

        <?php endif; ?>

    </div>
</div>
