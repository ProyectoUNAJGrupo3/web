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

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Registrarme', ['class' => 'btn btn-primary']); ?>
        </div>
    </div>


    <!--<div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
    
        </div>
    </div>-->

    <?php ActiveForm::end(); ?>
</div>
<!--
<div class="container">
<!-- Modal -->
<!--<div class="modal fade" id="myModal" role="dialog">

    <div class="modal-dialog">

<!-- Modal content-->
<!--       <div class="modal-content">

           <div class="modal-header" id="cabecera-modal"style="padding:35px 50px;">
               <button type="button" class="close" id="cruz-close" data-dismiss="modal">&times;</button>
               <img src="avatarUser.png" id="img-avatar-login" alt="Logo P&aacute;gina" align="left-top" >
               <!--<h1><!--<span class="glyphicon glyphicon-lock"></span>--> <!--Login</h1>-->
<!--                </div><!--End modal header-->

<!--            <div class="modal-body" style="padding:20px 50px;">

                    <form role="form" name="formLogin">
                        <div class="form-group">
                            <label for="usrname"><span class="glyphicon glyphicon-user"></span> Usuario</label>
                            <input type="text" class="form-control" id="usrname" name="usarioForm" placeholder="usuario" maxlength="50" onblur="validarLoginNombre()" ><span id="errorInfUsuario"></span>
                        </div>

                        <div class="form-group">
                            <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Contrase&ntilde;a</label>
                            <input type="password" class="form-control" id="psw" name="contraseniaForm" maxlength="30" placeholder="Contrase&ntilde;a" onblur="validarLoginContrasenia()"><span id="errorInfContrasenia"></span>
                        </div>

                        <div class="checkbox">
                            <label><input type="checkbox" value="" checked>Recordarme</label>
                        </div>

                        <a target="__blank" href="HOME-APP.html">
                            <button type="submit" class="btn btn-success btn-block" id="btn-login-popup" maxlength="30"><span class="glyphicon glyphicon-off"></span>Login</button>
                        </a>

                        <div id="imgEmail"  align="center">
                            <br>
                            <p>
                                <strong>Ingresa con tu cuenta de:</strong>
                            </p>
                            <a href="https://gmail.com" target="_blank" style="display:inline-block; float:center">
                                <img src="Google-Logo-3.jpg"  alt="www.gmail.com" style="width:30px;height:30px;">
                            </a>
                            <a href="https://www.facebook.com/" target="_blank" >
                                <img src="facebook_logo.jpg"  alt="www.facebook.com" style="width:30px;height:30px;">
                            </a>
                        </div>

                        <div id="imgEmail"  align="center">
                            <br>
                            <strong>&#191No est&aacute; registrado o quer&eacute;s que tu remiser&iacute;a aparezca?</strong>
                            <br><br>
                            <a>
                                <button type="button" class="btn btn-primary" id="btn-registrarme-login-popup" onclick="abrirFormulario()"><span class="glyphicon glyphicon-off" ><!--onclick="abrirFormulario()"-->
<!--                        </span>Registrarme
                    </button>
                </a>
<!--                    </div><!--End imgEmail-->

<!--            </form>

        </div> <!--End modal body-->
<!--
            </div>
        </div>
    </div>
</div>-->

