<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use app\assets\BootswatchAsset;
use app\assets\AppAssetPopups;
use yii\bootstrap\Modal;

raoul2000\bootswatch\BootswatchAsset::$theme = 'superhero';
BootswatchAsset::register($this);
AppAssetPopups::register($this);
$this->title = 'Quiénes Somos';

Modal::begin([
    'id' => 'modal',
        //'size' => 'modal-lg',
]);
echo "<div id='modalContent'></div>";
Modal::end();
?>
<div class="container">
    <div class="well bs-component" style='color: white; text-align: justify;'>
        <div class="alert alert-dismissible alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <h3><strong>Felicitaciones!</strong></h3> 
            <p>
                Su cuenta a sido creada exitosamente!
                Inicie sesi&oacute;n para usar los servicios de la aplicaci&oacute;n.
            </p>
        </div>
        <?php ActiveForm::begin() ?>
        <p>
            <?= Html::button('Iniciar sesi&oacute;n', ['value' => Url::toRoute('/site/login'), 'class' => 'btn btn-primary btn-lg', 'id' => 'modalButtonEmail']); ?>
        </p>
        <?php ActiveForm::end() ?>

    </div>
</div>
