<?php

use yii\helpers\BaseHtml;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\AppAsset;
use app\assets\AppAssetAgencia;
use app\assets\BootswatchAsset;

raoul2000\bootswatch\BootswatchAsset::$theme = 'superhero';
BootswatchAsset::register($this);
AppAssetAgencia::register($this);
AppAsset::register($this);
?>

<div class="container">
    <!--<div class="well bs-component">-->
        <div class="row">
            <div class="col-lg-8">
                <!--<div class="site-contact">
            <section id="main">
                <article>
                    <div id="page-single-main">
                        <br />-->
                <h1>
                    <strong>F&oacute;rmulario Nuevo Veh&iacute;culo </strong>
                </h1>
                <!--<div class="container-form" id="contenedor-formulario">-->
                <h1>
                    <?= Html::encode($this->title) ?>
                </h1>

                <?php if (Yii::$app->session->hasFlash('vehiculo creado con exito')): ?>
                    <div class="alert alert-success">
                        El alta del vehiculo ha sido un exito
                    </div>
                    <p>
                        Dado los datos brindados el vehiculo ha sido dado de alta
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
                    <?= $form->field($model, 'marca')->input("text", ['maxlength' => '50', 'id' => 'marca', 'autofocus' => true])->label("Marca <b id='asterisco'>*</b>"); ?>
                    <?= $form->field($model, 'modelo')->input("text", ['maxlength' => '50', 'id' => 'modelo'])->label("Modelo <b id='asterisco'>*</b>"); ?>
                    <?= $form->field($model, 'patente')->input("text", ['maxlength' => '50', 'id' => 'patente'])->label("Patente <b id='asterisco'>*</b>"); ?>

                    <?php $select = Html::beginForm() ?>
                    <?php echo Html::label("Estado <b id='asterisco'>*</b>") ?>
                    <br>
                    <?php echo Html::dropDownList('listaEstado', $select, ['Item A' => 'Seleccion...', 'Item B' => '0 km', 'Item C' => 'Usado'], ['id' => 'listaEstados']); ?>
                    <?php Html::endForm() ?>
                    <br><br>
                    <b>Campos con</b> <b id="asterisco">*</b> <b>son obligatorios</b>
                    <br><br>
                    <div id='botones-group'>
                        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary', 'id' => 'btn-guardar']); ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <?= Html::button('Cancelar', ['class' => 'btn btn-primary', 'id' => 'btn-cancelar']); ?>
                    </div>



                    <?php ActiveForm::end(); ?>
                    <!--</div>-->


                <?php endif; ?>
                <!--   </div>
                   </div>
               </article>
            </section>
            </div>-->
            </div>
        </div>
    </div>
