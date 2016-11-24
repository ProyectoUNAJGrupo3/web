<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\assets\BootswatchAsset;
use app\assets\AppAsset;
use yii\bootstrap\Modal;
use app\assets\AppAssetPopups;

AppAsset::register($this);
AppAssetPopups::register($this);

raoul2000\bootswatch\BootswatchAsset::$theme = 'superhero';
BootswatchAsset::register($this);

/* Modal::begin([
  'id' => 'modal',
  'size' => 'modal-lg',
  ]);
  echo "<div id='modalContent'></div>";
  Modal::end();
 */
?>
<div class="container" style="width: 100%;">

    <?php if (Yii::$app->session->hasFlash('UsuarioNoValidado')): ?>
        <div class="alert alert-success">
            Su usuario aun no ha sido validado
        </div>
    <?php else: ?>
        <div class="row">
            <div class="col-lg-15">
                <img src="img/avatarUser.png" id="img-avatar-login" alt="Logo P&aacute;gina" align="top" style="margin-left:40%;"/>
                <h4>
                    <strong>
                        <p style="text-align: center">Ingrese su usario y contrase&ntilde;a</p>
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
                            ],
                ]);
                ?>
                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                <?=
                $form->field($model, 'rememberMe')->checkbox([
                    'template' => "<div class=\"col-lg-offset-1 col-lg-4\">{input} {label}</div>\n<div class=\"col-lg-5\">{error}</div>", 'margin-left' => '50px'
                ])
                ?>
                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button', 'id' => 'btn-login-popup']) ?>
                    <br>
                    <h4>
                        <p id="mesagge-login">
                            <strong>&#191No est&aacute; registrado o quer&eacute;s que tu remiser&iacute;a aparezca?</strong>
                        </p>
                    </h4>
                    <br />
                    <div id="btn-grupo-resgistrar">
                        <?= Html::Button('Registrarme como Usuario', ['value' => Url::toRoute('/site/registro'), 'class' => 'btn btn-primary', 'id' => 'modalButtonRegistrarUsuario']); ?>
                        <?= Html::Button('Registrarme como Agencia', ['value' => Url::toRoute('/site/solicitud_registrar_agencia'), 'class' => 'btn btn-primary', 'id' => 'modalButtonRegistrarAgencias']); ?> 
                    </div>
                </div>

                <?php ActiveForm::end(); ?>
                <div class="modal-footer" id="pie-modal">
                    <b>
                        <a id="link-olvidaste-contrasenia" href="#">&#191;Has olvidado la contrase&ntilde;a?</a>
                    </b>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>