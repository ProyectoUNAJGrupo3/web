<?php

use yii\helpers\BaseHtml;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\AppAssetRecepcionista;
use app\assets\AppAsset;
AppAsset::register($this);
AppAssetRecepcionista::register($this);
?>


<div class="site-contact">
    <section id="main">
        <article>
            <div id="page-single-main-recepcionista">
                <br />
                <h1 id="title-form-recepcionista">
                    <strong>Nuevo Viaje</strong>
                </h1>
                <div class="container-form" id="contenedor-formulario-recepcionista">
                    <h1>
                        <?= Html::encode($this->title) ?>
                    </h1>

                    <?php if (Yii::$app->session->hasFlash('Carga exitosa')): ?>
                        <div class="alert alert-success">
                            La carga del nuevo viajes ha sido exitosa
                        </div>
                    <?php else: ?>

                        <?php $form = ActiveForm::begin(); ?>
                        <b>
                            <h3>
                                <u>Datos</u>
                                <u>Del</u>
                                <u>Pasajero</u>
                            </h3>
                        </b>

                        <?= $form->field($model, 'nombre')->input("text", ['autofocus' => true, 'maxlength' => '50', 'id' => 'nombrePasajero'])->label("Nombre"); ?>
                        <?= $form->field($model, 'apellido')->input("text", ['maxlength' => '50', 'id' => 'apellidoPasajero'])->label("Apellido"); ?>

                        <b>
                            <h3>
                                <u>Datos</u>
                                <u>Del</u>
                                <u>Viaje</u>
                            </h3>
                        </b>

                        <?= $form->field($model, 'origen')->input('text', ['readonly' => true, 'id' => 'origenViajeManual'])->label("Origen <b id='asterisco'>*</b>"); ?>
                        <?= $form->field($model, 'destino')->textInput(['maxlength' => '100', 'id' => 'destinoViajeManual',])->label("Destino <b id='asterisco'>*</b>"); ?>
                        <b>
                            <h3>
                                <u>Datos</u>
                                <u>Del</u>
                                <u>Chofer</u>
                            </h3>
                        </b>

                        <?php $select = Html::beginForm() ?>
                        <?php echo Html::label("Choferes <b id='asterisco'>*</b>") ?>
                        <br>
                        <?php echo Html::dropDownList('listadoChoferes', $select, ['empty' => 'Seleccion...', '1' => 'Pablo', '2' => 'Martin'], ['id' => 'listadoChoferes']); ?>
                        <br><br>
                        <?php echo Html::label("Veh&iacute;culos <b id='asterisco'>*</b>") ?>
                        <br>
                        <?php echo Html::dropDownList('listadoCoches', $select, ['empty' => 'Seleccion...', '1' => 'Renault', '2' => 'Fiat'], ['id' => 'listadoCoches']); ?>
                        <?php ActiveForm::end(); ?>
                        <br>
                        <b>Campos con</b> <b id="asterisco">*</b> <b>son obligatorios</b>
                        <br><br>
                        <div id='botones-grupo-viaje-manual'>
                            <?= Html::submitButton('Cargar Viaje', ['class' => 'btn btn-primary', 'id' => 'btn-cargar-viaje']); ?>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <?= Html::button('Cancelar', ['class' => 'btn btn-primary', 'id' => 'btn-cancelar-viaje']); ?>
                        </div>

                    <?php endif; ?>
                </div>
            </div>
        </article>
    </section>
</div>

