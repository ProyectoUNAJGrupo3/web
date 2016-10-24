<?php

use yii\helpers\BaseHtml;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\PSCssAsset;

PSCssAsset::register($this);
?>
<div class="site-contact">
    <section id="main">
        <article>
            <div id="page-single-main">
                <br />
                <h1 id="title-form">
                    <strong>F&oacute;rmulario Actualizar Datos Veh&iacute;culo </strong>
                </h1>
                <div class="container-form" id="contenedor-formulario">
                    <h1>
                        <?= Html::encode($this->title) ?>
                    </h1>

                    <?php if (Yii::$app->session->hasFlash('Usuario creado con exito')): ?>
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

                        <!--<div class="col-lg-5">-->
                        <br>


                        <?php $form = ActiveForm::begin(); ?>
                        <b>
                            <h3>
                                <u>Datos</u>
                                <u>del</u>
                                <u>Veh&iacute;culo</u>
                            </h3>
                        </b>
                        <?= $form->field($model, 'marca')->input("text", ['maxlength' => '50', 'id' => 'marca','autofocus'=>true])->label("Marca <b id='asterisco'>*</b>"); ?>
                        <?= $form->field($model, 'modelo')->input("text", ['maxlength' => '50', 'id' => 'modelo','autofocus'=>true])->label("Modelo <b id='asterisco'>*</b>"); ?>
                        <?= $form->field($model, 'patente')->input("text", ['maxlength' => '50', 'id' => 'patente'])->label("Patente <b id='asterisco'>*</b>"); ?>
                        <?= $form->field($model, 'anio')->input("text", ['maxlength' => '4', 'id' => 'anio'])->label("A&ntilde;o <b id='asterisco'>*</b>"); ?>
                        <?= $form->field($model, 'numeroSeguro')->input('text', ['maxlength' => '10', 'id' => 'numeroSeguro'])->label("N&uacute;mero de Seguro <b id='asterisco'>*</b>"); ?>
                        <?php $select = Html::beginForm() ?>
                        <?php echo Html::label("Estado <b id='asterisco'>*</b>") ?>
                        <br>
                        <?php echo Html::dropDownList('listaEstado', $select, ['Item A' => 'Seleccion...', 'Item B' => '0 km', 'Item C' => 'Usado', 'Item D' => 'En reparación', 'Item E' => 'Fuera de Servicio'], ['id' => 'listaEstados']); ?>
                        <?php Html::endForm() ?>
                        <br><br>
                        <b>Campos con</b> <b id="asterisco">*</b> <b>son obligatorios</b>
                        <br><br>
                        <div id='botones-group'>
                            <?= Html::submitButton('Actualizar', ['class' => 'btn btn-primary', 'id' => 'btn-guardar']); ?>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <?= Html::button('Cancelar', ['class' => 'btn btn-primary', 'id' => 'btn-cancelar']); ?>
                        </div>



                        <?php ActiveForm::end(); ?>
                        <!--</div>-->
                    </div>

                <?php endif; ?>
            </div>
            </div>
        </article>
    </section>
</div>
