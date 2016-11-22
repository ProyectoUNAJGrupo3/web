<?php

use yii\helpers\BaseHtml;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\AppAsset;
use app\assets\AppAssetAgencia;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\assets\BootswatchAsset;

raoul2000\bootswatch\BootswatchAsset::$theme = 'superhero';
BootswatchAsset::register($this);
AppAssetAgencia::register($this);
AppAsset::register($this);
?>
<div class="container">
    <div class="well bs-component">
        <div class="row">
            <!--<div class="site-contact">
                <section id="main">
                    <article>
                        <div id="page-single-main">
                            <br />-->
            <h1 >
                <strong>Historial Calificaciones</strong>
            </h1>
            <!--<div class="container-form" id="contenedor-formulario">-->
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
                <?php $form = ActiveForm::begin(); ?>

                <div id='botones-group'>
                    <?= Html::submitButton('Volver', ['class' => 'btn btn-primary', 'id' => 'btn-guardar']); ?>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <?= Html::submitButton('Cerrar', ['class' => 'btn btn-primary', 'id' => 'btn-cancelar']); ?>
                </div>
                <?php $form = ActiveForm::end(); ?>
            <?php endif; ?>
        </div>  
    </div>  
</div>  

<!--</article>
</section>
</div>-->