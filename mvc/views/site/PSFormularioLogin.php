<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="site-login">
    <h1>Login</h1>

    <p>Ingrese su usario y contrase&ntilde;a</p>

    <?php
    $form = ActiveForm::begin(['id' => 'login-form',
                'options' => ['class' => 'form-horizontal'],
                'fieldConfig' => [
                    'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                    'labelOptions' => ['class' => 'col-lg-1 control-label'],
    ]]);
    ?>

    <?= $form->field($model, 'usuario')->textInput(['autofocus' => true]) ?>
    <?= $form->field($model, 'contrasenia')->passwordInput() ?>
    <?=
    $form->field($model, 'rememberMe')->checkbox([
        'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
    ])
    ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
<?= Html::submitButton('Registrarme', ['class' => 'btn btn-primary']); ?>
        </div>
    </div>

<?php ActiveForm::end(); ?>
</div>