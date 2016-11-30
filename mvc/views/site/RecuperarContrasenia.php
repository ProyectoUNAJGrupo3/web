<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\captcha\Captcha;
use yii\bootstrap\ActiveForm;
use app\assets\BootswatchAsset;
use app\assets\AppAsset;

AppAsset::register($this);

raoul2000\bootswatch\BootswatchAsset::$theme = 'superhero';
BootswatchAsset::register($this);
?>
<div class="container">
    <div class="well bs-component">
        <?php if (Yii::$app->session->hasFlash('MailEnviado')): ?>
        <div class="alert alert-success">
            Se ha enviado un enlace a su cuenta de mail para que pueda ingresar una nueva contrasenia
        </div>
        <?php elseif (Yii::$app->session->hasFlash('UsuarioNoEncontrado')): ?>
        <div class="alert alert-success">
            El usuario que busca no existe
        </div>
        <?php else: ?>
        <div class="row" style="text-align: center">
            <div class="col-lg-5">

                <h4>
                    <strong>
                        <p style="text-align: center">Recuperar Contrase&ntilde;a</p>
                    </strong>
                </h4>
                <br />
                <?php
                $form = ActiveForm::begin([
                            'id' => 'login-form',
                            'options' => ['class' => 'form-horizontal'],
                            'fieldConfig' => [
                                'template' => "{label}\n<div class=\"col-lg-8\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                                'labelOptions' => ['class' => 'col-lg-2 control-label'],
                            ],]);
                ?>
                <?= $form->field($model, 'nombreUsuario')->textInput(['autofocus' => true]) ?>
                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), ['template' => '<div class="row"><div class="col-lg-6">{image}</div><div class="col-lg-6">{input}</div></div>',])->label('C&oacute;digo de Verificaci&oacute;n'); ?>
                <div class="form-group">
                    <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <?= Html::a('Cerrar', [('/site/index'), 'class' => 'btn btn-primary btn-lg', 'id' => 'btn-cancelar']); ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>