<?php

use yii\helpers\BaseHtml;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\AppAssetRecepcionista;
use app\assets\AppAsset;
AppAsset::register($this);
AppAssetRecepcionista::register($this);
?>
<div class="container">
    <section id="main">
        <article>
            <div id="page-single-main-recepcionista">
                <br />
                <h1 id="title-form-recepcionista">
                    <strong>Datos Solicitud</strong>
                </h1>
                <div class="container-form" id="contenedor-formulario-recepcionista">
                    <h1>
                        <?= Html::encode($this->title) ?>
                    </h1>

                    <h4>
                        <strong>
                            <u>Datos</u>
                            <u>Solicitud</u>
                            <u>Servicio</u>
                        </strong>
                    </h4>
                    <?php $form = ActiveForm::begin(); ?>
                    <?= $form->field($model, 'numeroSolicitud')->input("text", ['readonly' => true,'id'=>'numeroSolicitud'])->label('N° Solicitud'); ?>
                    <?= $form->field($model, 'nombreUsuario')->input("text", ['readonly' => true,'id'=>'nombreUsuario'])->label('Nombre'); ?>
                    <?= $form->field($model, 'origen')->Input("text", ['readonly' => true,'id'=>'origen'])->label('Origen'); ?>
                    <?= $form->field($model, 'destino')->textInput(['readonly' => true,'id'=>'destino'])->label('Destino'); ?>

                    <h4>
                        <strong>
                            <u>Historial</u>
                            <u>Usuario</u>
                        </strong>
                    </h4>


                    <?php ActiveForm::end(); ?>

                    <div id="botones-grupo-ver-datos-solicitud">
                        <button type="button" class="btn btn-primary">Actualizar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    </div>

                </div>
            </div>
        </article>
    </section>
</div>