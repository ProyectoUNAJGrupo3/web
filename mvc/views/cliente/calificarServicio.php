<?php

use yii\helpers\BaseHtml;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
//use app\assets\AppAssetWebSite;
use app\assets\AppAssetCliente;
use app\assets\AppAsset;
use app\assets\BootswatchAsset;

raoul2000\bootswatch\BootswatchAsset::$theme = 'superhero';
BootswatchAsset::register($this);
AppAsset::register($this);
//AppAssetWebSite::register($this);
AppAssetCliente::register($this);
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
                <?= $form->field($model, 'puntaje')->dropDownList(['prompt' => 'Seleccione...', 'uno' => '1', 'dos' => '2', 'tres' => '3', 'cuatro' => '4', 'cinco' => '5', 'seis' => '6', 'siete' => '7', 'ocho' => '8', 'nueve' => '9', 'diez' => '10']) ?>
                <?= $form->field($model, 'comentario')->textArea(['rows' => 7, 'column' => 4])->label('Comentario'); ?>
                <?= Html::submitButton('Calificar', ['class' => 'btn btn-primary', 'id' => 'btn-carga-calificacion']); ?>
                <?= Html::button('Cancelar', [('/cliente/listaHistorialViajes'),'class' => 'btn btn-primary btn-lg', 'id' => 'btn-cancelar']); ?>
                <?php ActiveForm::end(); ?>

            <?php endif; ?>

        </div>
    </div>
</div>


