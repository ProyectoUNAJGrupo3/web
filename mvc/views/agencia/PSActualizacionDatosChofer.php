<?php

use yii\helpers\BaseHtml;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\AppAsset;
use yii\jui\DatePicker;
use app\assets\AppAssetAgencia;

AppAssetAgencia::register($this);
AppAsset::register($this);
?>
<div class="container">
    <section id="main">
        <article>
            <div id="page-single-main">
                <br />
                <h1 id="title-form">
                    <strong> Actualizaci&oacute;n de Datos del Chofer</strong>
                </h1>
                <div class="container-form" id="contenedor-formulario">
                    <h1>
                        <?= Html::encode($this->title) ?>
                    </h1>


                    <!--   <div class="col-lg-5">-->

                    <?php $form = ActiveForm::begin(); ?>

                    <?= $form->field($model, 'nombre')->input("text", ['maxlength' => '50']); ?>
                    <?= $form->field($model, 'apellido')->input("text", ['maxlength' => '50']); ?>
                    <?= $form->field($model, 'dni')->Input("text", ['maxlength' => '8']); ?>
                    <?= $form->field($model, 'direccion')->textInput(['readonly' => true]); ?>
                    <?= $form->field($model, 'telefono')->input('text', ['maxlength' => '20']); ?>


                    <?= $form->field($model, 'fechaDeIngreso')->widget(DatePicker::className(), ['clientOptions' => ['defaultDate' => '2014-01-01']]) ?>

                    <?php $select = Html::beginForm() ?>
                    <?php echo Html::label("turno <b id='asterisco'>*</b>") ?>
                    <br />
                    <?php echo Html::dropDownList('listaTurno', $select, ['Item A' => 'Seleccione...', 'Item B' => 'Maniana', 'Item C' => 'Tarde', 'Item D' => 'Noche'], ['id' => 'listaTurno']); ?>
                    <br />
                    <br />
                    <?php echo Html::label("Empleado <b id='asterisco'>*</b>") ?>
                    <br />
                    <?php echo Html::dropDownList('listaEmpleado', $select, ['Item A' => 'Seleccione...', 'Item B' => 'Chofer', 'Item C' => 'Recepcionista',], ['id' => 'listaEmpleado']); ?>
                    <?php Html::endForm() ?>
                    <br />
                    <br />
                    <br />
                    <?= $form->field($model, 'fechaDeEgreso')->widget(DatePicker::className(), ['clientOptions' => ['defaultDate' => '2014-01-01']]) ?>
                    <?= $form->field($model, 'matricula')->input("text", ['maxlength' => '20']); ?>
                    <?= $form->field($model, 'modelo')->input("text", ['maxlength' => '20']); ?>
                    <?= $form->field($model, 'marca')->input("text", ['maxlength' => '20']); ?>

                    <?php $select = Html::beginForm() ?>
                    <?php echo Html::label("Estado <b id='asterisco'>*</b>") ?>
                    <br />
                    <?php echo Html::dropDownList('listaEstado', $select, ['Item A' => 'Seleccione...', 'Item B' => 'Habilitado', 'Item C' => 'Deshabilitado'], ['id' => 'listaEstado']); ?>
                    <?php Html::endForm() ?>
                    <br />
                    <br />
                    <br />
                    <?= $form->field($model, 'fechaDeAlta')->widget(DatePicker::className(), ['clientOptions' => ['defaultDate' => '2014-01-01']]) ?>


                    <div class="modal-footer">

                        <button type="button" class="btn btn-primary">Actualizar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    </div>


                    <?php ActiveForm::end(); ?>
                </div>
            </div>



        </article>
    </section>
</div>