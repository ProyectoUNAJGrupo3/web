<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use app\assets\PSCssAsset;

PSCssAsset::register($this);


$this->title = 'Contacto';
?>
<div class="site-contact">

    <section id="main">
        <article>
            <div id="page-single-main">
                <br />
                <h1 id="title-form">
                    <strong>F&oacute;rmulario de Contacto</strong>
                </h1>
                <div class="container-form" id="contenedor-formulario">
                    <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

                        <div class="alert alert-success">
                            Gracias por contactarse
                        </div>

                        <p>

                            <?php if (Yii::$app->mailer->useFileTransport): ?>
                            <p>En lo inmediato, nos contactaremos con usted a fin de dar
                                respuesta a sus inquietudes.
                            </p>
                            <p>
                                Siga disfrutando de nuestro servicios.
                            </p>    
                        <?php endif; ?>
                        </p>

                    <?php else: ?>
                        <div class="row">
                            <div class="col-lg-5">
                                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                                <b>
                                    <h3>
                                        <u>Datos</u>
                                        <u>De</u>
                                        <u>Contacto</u>
                                    </h3>
                                </b>

                                <?= $form->field($model, 'name')->textInput(['autofocus' => true])->label('Nombre'); ?>

                                <?= $form->field($model, 'email')->label('Email'); ?>

                                <?= $form->field($model, 'subject')->label('Asunto'); ?>

                                <?= $form->field($model, 'body')->textArea(['rows' => 6])->label('Mensaje'); ?>

                                <?=
                                $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                                                            'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6" style="margin-left:60px;">{input}</div></div>',
                                ])->label('C&oacute;digo de Verificaci&oacute;n');
                                ?>

                                <div class="form-group" style="display: inline-block; margin-left: 200px;">
                                    <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary', 'name' => 'contact-button','style'=>'margin-left:0px;font-size:20px;']); ?>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <?= Html::button('Cancelar', ['class' => 'btn btn-primary', 'name' => 'contact-button','style'=>'margin-left: 100px; margin-top:-65px;font-size:20px;']); ?>
                                </div>

                                <?php ActiveForm::end(); ?>

                            </div>
                        </div>


                    <?php endif; ?>
                </div>
            </div>
        </article>
    </section>
</div>
