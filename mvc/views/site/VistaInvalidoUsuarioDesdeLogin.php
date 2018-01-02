<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use app\assets\BootswatchAsset;
use app\assets\AppAssetPopups;
use yii\bootstrap\Modal;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

raoul2000\bootswatch\BootswatchAsset::$theme = 'superhero';
BootswatchAsset::register($this);
AppAssetPopups::register($this);
$this->title = 'Usuario Inv&aacute;lido';

Modal::begin([
    'id' => 'modal',
        //'size' => 'modal-lg',
]);
echo "<div id='modalContent'></div>";
Modal::end();
?>
<div class="container">
    <div class="well bs-component" style='color: white; text-align: justify;'>
        <div class="alert alert-dismissible alert-warning">
            <!--<button type="button" class="close" data-dismiss="alert">&times;</button>-->
            <h2><strong>Usuario Inv&aacute;lido!</strong></h2> 
            <p>
            <h3>
                El usuario ingresado no existe!
                Verifique su correo para validar su cuenta de usuario o ingrese nuevamente sus credenciales
            </h3>
            </p>
        </div>
        <?php ActiveForm::begin() ?>
        <p>
            <?= Html::button('Iniciar sesi&oacute;n', ['value' => Url::toRoute('/site/login'), 'class' => 'btn btn-primary btn-lg', 'id' => 'modalButtonEmail']); ?>
        </p>
        <?php ActiveForm::end() ?>

    </div>
</div>
