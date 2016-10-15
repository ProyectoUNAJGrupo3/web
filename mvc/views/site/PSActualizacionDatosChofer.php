<?php

use yii\helpers\BaseHtml;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<!--<div class="container">
    <section id="main">
        <article>
            <div id="page-single-main">-->

<div class="site-contact">
    <h1>Actualizaci&oacute;n de Datos del Chofer</h1>
   

    <div class="row">
        
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin(); ?>
     
            <?= $form->field($model, 'Nombre')->input("text", ['maxlength' => '50']); ?>
            <?= $form->field($model, 'Apellido')->input("text", ['maxlength' => '50']); ?>
            <?= $form->field($model, 'DNI')->Input("text",['maxlength' => '8']); ?>
            <?= $form->field($model, 'direccion')->textInput(['readonly' => true]); ?>
            <?= $form->field($model, 'FechaDeIngreso')->input("Date", []); ?>       
            <?= $form->dropDownList($model, 'Turno', array ('1'=>'Mañana','2'=>'Tarde', '3'=>'Noche')) ?>
            <?= $form->dropDownList($model,'TipoDeEmpleado',array('1'=>'Chofer','2'=>'Recepcionista'))  ?>
            <?= $form->field($model, 'FechadeEgreso')->input('Date',[]); ?>
            <?= $form->field($model, 'Matricula')->input("text", ['maxlength' => '20']); ?>
            <?= $form->field($model, 'Modelo')->input("text", ['maxlength' => '20']); ?>
            <?= $form->field($model, 'Marca')->input("text", ['maxlength' => '20']); ?>
            <?= $form->dropDownList($model,'Estado',array('1'=>'Habilitado','2'=>'deshabilitado'));?>
            <?= $form->field($model, 'FechaDeAlta')->input ("Date", []);?>
          
          
          
            <?= Html::submitButton('Registrarme', ['class' => 'btn btn-primary']); ?>

            <br />
            <br />
            <?= Html::Button('Cancelar', ['class' => 'btn btn-primary']); ?>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

  
</div>
