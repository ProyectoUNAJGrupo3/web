<?php

use yii\helpers\BaseHtml;
use yii\helpers\Html;
//use app\assets\AppAsset;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use app\assets\BootswatchAsset;
use app\assets\AppAssetPopups;

raoul2000\bootswatch\BootswatchAsset::$theme = 'superhero';
BootswatchAsset::register($this);
//AppAsset::register($this);
AppAssetPopups::register($this);

Modal::begin([
    'id' => 'modal',
    //'size' => 'modal-lg',
]);
echo "<div id='modalContentChofer'></div>";
Modal::end();
?>
<div class="container">
    <div class="well bs-component">
        <div class="row">
            <div class="col-lg-8">
                <h1>
                    <strong>Historial Viajes</strong>
                </h1>
                <h1>
                    <?= Html::encode($this->title) ?>
                </h1>
                <?php if (Yii::$app->session->hasFlash('Index Chofer')): ?>
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
                        <?= Html::button('Abrir ventana calificar', ['value' => Url::toRoute('/chofer/calificar_conducta_usuario'), 'class' => 'btn btn-primary', 'id' => 'modalButtonCalificarUsuario']); ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <?= Html::submitButton('Cerrar', ['class' => 'btn btn-primary', 'id' => 'btn-cancelar']); ?>
                    </div>
                    <?php $form = ActiveForm::end(); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>