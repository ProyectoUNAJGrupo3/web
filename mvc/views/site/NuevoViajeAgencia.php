<?php

use yii\helpers\BaseHtml;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\PSCssAsset;

PSCssAsset::register($this);
?>

<!--
CARGAR UN NUEVO VIAJE MANUAL

USADO POR LA RECEPCIONISTA
-->


<div class="site-contact">
    <section id="main">
        <article>
            <div id="page-single-main">
                <br />
                <h1 id="title-form">
                    <strong>Nuevo Viaje</strong>
                </h1>
                <div class="container-form" id="contenedor-formulario">
                    <h1>
                        <?= Html::encode($this->title) ?>
                    </h1>

                    <?php if (Yii::$app->session->hasFlash('Carga exitosa')): ?>
                        <div class="alert alert-success">
                            La carga del nuevo viajes ha sido exitosa
                        </div>
                    <?php else: ?>

                        <div class="row">

                            <div class="col-lg-5">
                                <?php $form = ActiveForm::begin(); ?>
                                <b>
                                    <h3>
                                        <u>Datos</u>
                                        <u>Del</u>
                                        <u>Pasajero</u>
                                    </h3>
                                </b>

                                <?= $form->field($model, 'nombre')->input("text", ['maxlength' => '50', 'id'=>'nombrePasajero'])->label("Nombre"); ?>
                                <?= $form->field($model, 'apellido')->input("text", ['maxlength' => '50','id'=>'apellidoPasajero'])->label("Apellido"); ?>
                                <br>
                                <b>
                                    <h3>
                                        <u>Datos</u>
                                        <u>Del</u>
                                        <u>Viaje</u>
                                    </h3>
                                </b>
                                <br>
                                <?= $form->field($model, 'origen')->input('text', ['readonly' => true,'id'=>'origen'])->label("Origen <b id='asterisco'>*</b>"); ?>
                                <?= $form->field($model, 'destino')->textInput([''=>'','id'=>'destino','readonly' => true])->label("Destino <b id='asterisco'>*</b>"); ?>
                                <br>
                                <b>
                                    <h3>
                                        <u>Datos</u>
                                        <u>Del</u>
                                        <u>Chofer</u>
                                    </h3>
                                </b>
                                <br />
                                <?php $select = Html::beginForm() ?>
                                <?php echo Html::label("Choferes <b id='asterisco'>*</b>") ?>
                                <br>
                                <?php echo Html::dropDownList('listadoChoferes', $select, ['empty' => 'Seleccion...', '1' => 'Pablo', '2' => 'Martin'], ['id' => 'listadoChoferes']); ?>

                                <?php ActiveForm::end(); ?>

                                <br>
                                <b>Campos con</b> <b id="asterisco">*</b> <b>son obligatorios</b>
                                <br>
                                <div id='botones-group-viaje'>
                                    <?= Html::submitButton('Cargar Viaje', ['class' => 'btn btn-primary', 'id' => 'btn-cargar-viaje']); ?>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <?= Html::button('Cancelar', ['class' => 'btn btn-primary', 'id' => 'btn-cancelar']); ?>
                                </div>
                            </div>
                        </div>

                    <?php endif; ?>
                </div>
            </div>
        </article>
    </section>
</div>

