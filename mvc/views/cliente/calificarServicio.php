<?php

use yii\helpers\BaseHtml;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
//use app\assets\AppAssetWebSite;
use app\assets\AppAssetCliente;
use app\assets\AppAsset;
use app\assets\BootswatchAsset;
use yii\helpers\Url;

raoul2000\bootswatch\BootswatchAsset::$theme = 'superhero';
BootswatchAsset::register($this);
AppAsset::register($this);
//AppAssetWebSite::register($this);
//'value' => Url::toRoute('/cliente/listaHistorialCalificaciones')
//Html::submitButton('Calificar', ['value' => Url::toRoute('/cliente/listar_historial_calificaciones'),'class' => 'btn btn-primary', 'id' => 'btn-carga-calificacion']);
//Html::Button('Cancelar', ['value' => Url::toRoute('/cliente/listar_historial_viajes'),'class' => 'btn btn-primary btn-lg', 'id' => 'btn-cancelar']);
//<?= $form->field($model, 'puntaje')->dropDownList(['prompt' => 'Seleccione...', 'uno' => '1', 'dos' => '2', 'tres' => '3', 'cuatro' => '4', 'cinco' => '5', 'seis' => '6', 'siete' => '7', 'ocho' => '8', 'nueve' => '9', 'diez' => '10'])

AppAssetCliente::register($this);

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

        <div id='botones-group'>
            <?= Html::submitButton('Calificar', ['class' => 'btn btn-primary btn-lg', 'id' => 'btn-carga-calificacion']); ?>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <?= Html::a('Cancelar', [('cliente/lista_historial_viajes')],['class' => 'btn btn-primary btn-lg', 'id' => 'btn-cancelar']); ?>
        </div>
        <?php ActiveForm::end(); ?>

    </div>
</div>

            <?php endif; ?>


