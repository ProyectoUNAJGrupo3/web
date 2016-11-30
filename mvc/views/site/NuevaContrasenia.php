<?php
use yii\helpers\BaseHtml;
use yii\helpers\Html;
use yii\captcha\Captcha;
use yii\widgets\ActiveForm;
use app\assets\BootswatchAsset;
use app\assets\AppAssetCliente;
raoul2000\bootswatch\BootswatchAsset::$theme = 'superhero';
BootswatchAsset::register($this);
AppAssetCliente::register($this);
?>
<div class="container">
    <div class="well bs-component">
        <?php if (Yii::$app->session->hasFlash('SeteoExitoso')): ?>
        <div class="alert alert-success">
            La clave ha sido renovada exitosamente!
        </div>

        <?php else: ?>
        <div class="row">
            <div class="col-lg-8">

                <?php
                $form = ActiveForm::begin();
                ?>
                <h3>Datos personales</h3>
                <?= $form->field($model, 'contrasenia')->passwordInput()->label("Contrase&ntilde;a"); ?>
                <?= $form->field($model, 'confirmarContrasenia')->passwordInput()->label("Confirmar Contrase&ntilde;a"); ?>
                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), ['template' => '<div class="row"><div class="col-lg-6">{image}</div><div class="col-lg-6">{input}</div></div>',])->label('C&oacute;digo de Verificaci&oacute;n'); ?>
                <?= Html::submitButton('Registrar', ['class' => 'btn btn-primary', 'id' => 'btn-registrar']); ?>
                <?php ActiveForm::end(); ?>
            </div>

             <?php endif; ?>
             </div>
       
    </div>
</div>