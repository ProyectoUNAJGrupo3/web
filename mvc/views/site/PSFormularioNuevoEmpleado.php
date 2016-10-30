<?php

use yii\helpers\BaseHtml;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\PSCssAsset;

PSCssAsset::register($this);
?>
<!--<div class="container">
    <section id="main">
        <article>
            <div id="page-single-main">-->
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDMVbdR-TGis783bW9rB9tZUJXVXsIRzkQ&libraries=places"></script>
<div class="site-contact">
    <div class="col-lg-20">
        <section id="main">
            <article>
                <div id="page-single-main">
                    <br />
                    <h1 id="title-form">
                        <strong>F&oacute;rmulario Nuevo Empleado</strong>
                    </h1>
                    <div class="container-form" id="contenedor-formulario">
                        <div id="map-container">
                            <div id="map"></div>
                        </div>
                        <input id="pac-input" class="controls" type="text" placeholder="Busca tu partido / barrio " />

                        <h1>
                            <?= Html::encode($this->title) ?>
                        </h1>

                        <?php if (Yii::$app->session->hasFlash('Empleado creado con exito')): ?>
                            <div class="alert alert-success">
                                Thank you for contacting us. We will respond to you as soon as possible.
                            </div>
                            <p>
                                Note that if you turn on the Yii debugger, you should be able
                                to view the mail message on the mail panel of the debugger.
                                <?php if (Yii::$app->mailer->useFileTransport): ?>
                                    Because the application is in development mode, the email is not sent but saved as
                                    a file under
                                    <code>
                                        <?= Yii::getAlias(Yii::$app->mailer->fileTransportPath) ?>
                                    </code>.
                                    Please configure the
                                    <code>useFileTransport</code>property of the
                                    <code>mail</code>
                                    application component to be false to enable email sending.
                                <?php endif; ?>
                            </p>
                        <?php else: ?>

                            <?php $form = ActiveForm::begin(); ?>
                            <b>
                                <h3>
                                    <u>Datos</u>
                                    <u>Personales</u>
                                </h3>
                            </b>
                            <?= $form->field($model, 'nombre')->input("text", ['autofocus' => true, 'maxlength' => '50', 'id' => 'nombre'])->label("Nombre <b id='asterisco'>*</b>"); ?>
                            <?= $form->field($model, 'apellido')->input("text", ['maxlength' => '50', 'id' => 'apellido'])->label("Apellido <b id='asterisco'>*</b>"); ?>
                            <?= $form->field($model, 'dni')->input('text', ['maxlength' => '8', 'id' => 'dni'])->label("DNI <b id='asterisco'>*</b>"); ?>
                            <?= $form->field($model, 'telefono')->input('text', ['maxlength' => '20', 'id' => 'telefono'])->label("Tel&eacute;fono <b id='asterisco'>*</b>"); ?>
                            <?= $form->field($model, 'direccion')->textInput(['readonly' => true, 'id' => 'direccion'])->label("Direcci&oacute;n"); ?>
                            <?= Html::Button('Buscar Dirección', ['class' => 'btn btn-primary', 'onClick' => 'initMap();']); ?>

                            <br><br>

                            <?php $select = Html::beginForm() ?>
                            <?php echo Html::label("Tipo Empleado<b id='asterisco'>*</b>") ?>
                            <br>
                            <?php echo Html::dropDownList('listaTipoEmpleado', $select, ['empty' => 'Seleccion...', '1' => 'Receptionista', '2' => 'Chofer'], ['id' => 'listaTipoEmpleado']); ?>

                            <!--EVALUO SI TIPO EMPLEADO ES Chofer, ->true
                                MOSTRAR OPCION TIENE AUTO O NO
                            -->
                            <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

                                <div id="emplado_tiene_auto">
                                    <br><br>
                                    <h4><b>Auto propio</b></h4>
                                    <br>
                                    <?php echo Html::radioList($select, false, ['0' => 'Si', '1' => 'No']); ?>
                                </div>

                                <!-- SI EMPLEADO NUEVO, CHOFER, TIENE AUTO -> CARGO LO DATOS DEL MISMO
                                -->
                                <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>
                                    <div id="dato_vehiculo_empleado">
                                        <h3>
                                            <u>Datos</u>
                                            <u>Vehículo</u>
                                        </h3>
                                        </b>
                                        <?= $form->field($model, 'modelo')->input("text", ['maxlength' => '50', 'id' => 'modelo'])->label("Modelo <b id='asterisco'>*</b>"); ?>
                                        <?= $form->field($model, 'patente')->input("text", ['maxlength' => '50', 'id' => 'patente'])->label("Patente <b id='asterisco'>*</b>"); ?>
                                        <?= $form->field($model, 'numeroSeguro')->input('text', ['maxlength' => '8', 'id' => 'numeroSeguro'])->label("N&uacute;mero de Seguro <b id='asterisco'>*</b>"); ?>
                                        <?= $form->field($model, 'anio')->input('text', ['maxlength' => '4', 'id' => 'numeroSeguro'])->label("A&ntilde;o <b id='asterisco'>*</b>"); ?>
                                        <?php echo Html::label("Estado <b id='asterisco'>*</b>") ?>
                                        <br>
                                        <?php echo Html::dropDownList('listaEstadoAuto', $select, ['0' => 'Seleccion...', '1' => '0 Km', '2' => 'Chocado'], ['id' => 'listaEstadoAuto']); ?>
                                        <?php $select = Html::endForm() ?>                            
                                    </div>
                                <?php else: ?>
                                <?php endif; ?>
                            <?php else: ?>



                            <?php endif; ?>

                            <?php ActiveForm::end(); ?>
                            <br>
                            <b>Campos con</b> <b id="asterisco">*</b> <b>son obligatorios</b>
                            <br>
                            <div id='botones-group'>
                                <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary', 'id' => 'btn-guardar']); ?>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <?= Html::button('Cancelar', ['class' => 'btn btn-primary', 'id' => 'btn-cancelar']); ?>
                            </div>

                        <?php endif; ?>
                    </div>
                </div>
                </div>
            </article>
        </section>
    </div>

