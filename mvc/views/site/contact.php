<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use app\assets\BootswatchAsset;
use app\assets\AppAssetPopups;
use yii\bootstrap\Modal;

AppAssetPopups::register($this);
raoul2000\bootswatch\BootswatchAsset::$theme = 'superhero';
BootswatchAsset::register($this);
$this->title = 'Contacto';

Modal::begin([
    'id' => 'modal',
    //'size' => 'modal-lg',
]);
echo "<div id='modalContent'></div>";
Modal::end();
?>
<div class="container">
   
    <div class="well bs-component">
        <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>
        <div class="alert alert-success">
            Operacion exitosa! Gracias por contactarnos.
        </div>
        
        <?php else: ?>
        <div class="row">
            <div class="col-lg-12">
                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                <h3>Datos de contacto</h3>
                <?= $form->field($model, 'name')->textInput(['autofocus' => true])->label('Nombre'); ?>
                <?= $form->field($model, 'email')->label('Email'); ?>
                <?= $form->field($model, 'subject')->label('Asunto'); ?>
                <?= $form->field($model, 'body')->textArea(['rows' => 6])->label('Mensaje'); ?>
                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), ['template' => '<div class="row"><div class="col-lg-6">{image}</div><div class="col-lg-6">{input}</div></div>',])->label('C&oacute;digo de Verificaci&oacute;n'); ?>
                <div class="form-group">
                    <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary', 'name' => 'contact-button']); ?>
                    <?= Html::button('Cancelar', ['class' => 'btn btn-primary', 'name' => 'contact-button']); ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
            <?php endif ?>
        </div>

    </div>
</div>