<?php

use yii\helpers\BaseHtml;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\AppAssetWebSite;
use app\assets\AppAsset;
use app\assets\BootswatchAsset;

raoul2000\bootswatch\BootswatchAsset::$theme = 'superhero';
BootswatchAsset::register($this);
AppAsset::register($this);
AppAssetWebSite::register($this);
?>
<div class="container">
    <div class="row">
        <div class="col-lg-5">
            <h3>
                <strong>Calificar Usuario</strong>
            </h3>
            <h1>
                <?= Html::encode($this->title) ?>
            </h1>

            <?php if (Yii::$app->session->hasFlash('Clasificaci&oacute;n exitosa')): ?>
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
                    <h4>
                        <u>Datos</u>
                        <u>Calificaci&oacute;n</u>
                    </h4>
                </b>
                <?= $form->field($model, 'puntaje')->dropDownList(['prompt' => 'Seleccione...', 'uno' => '1', 'dos' => '2', 'tres' => '3', 'cuatro' => '4', 'cinco' => '5', 'seis' => '6', 'siete' => '7', 'ocho' => '8', 'nueve' => '9', 'diez' => '10']) ?>
                <?= $form->field($model, 'comentario')->textArea(['rows' => 7, 'column' => 4])->label('Comentario'); ?>
                <?= Html::submitButton('Calificar', ['class' => 'btn btn-primary', 'id' => 'btn-carga-calificacion']); ?>
                <?= Html::button('Cerrar', ['class' => 'btn btn-primary', 'id' => 'btn-cerrar']); ?>
                <?php ActiveForm::end(); ?>

            <?php endif; ?>

        </div>
    </div>
</div>


