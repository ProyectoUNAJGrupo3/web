<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\assets\BootswatchAsset;
use app\assets\AppAsset;

AppAsset::register($this);

raoul2000\bootswatch\BootswatchAsset::$theme = 'superhero';
BootswatchAsset::register($this);
?>
<div class="container">
    <div class="well bs-component">
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
                <div class="form-group">
                    <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <?= Html::a('Cerrar', [('/site/index'), 'class' => 'btn btn-primary btn-lg', 'id' => 'btn-cancelar']); ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>