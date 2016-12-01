<?php

use yii\helpers\BaseHtml;
use yii\helpers\Html;
//use app\assets\AppAsset;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use app\assets\AppAssetChofer;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use app\assets\BootswatchAsset;
use app\assets\AppAssetPopups;

AppAssetChofer::register($this);
raoul2000\bootswatch\BootswatchAsset::$theme = 'superhero';
BootswatchAsset::register($this);
//AppAsset::register($this);
//AppAssetPopups::register($this);
//Html::button('Calificar Usuario', ['value' => Url::toRoute('/chofer/calificar_cliente'), 'class' => 'btn btn-primary', 'id' => 'modalButtonCalificarUsuario']);

Modal::begin([
    'id' => 'modal',
        //'size' => 'modal-lg',
]);
echo "<div id='modalContent'></div>";
Modal::end();
?>
<div class="container">
    <div class="jumbotron">
        <h1><b>Bienvenido <?php echo Yii::$app->user->identity->Nombre?></b></h1>
        <div class="row">
            <blockquote>
                <div>
                    <p style="text-align: justify">
                       Mediante la aplicaci&oacute;n usted  puede ver la lista de viajes realizados, permitir calificar a un cliente y ver las calificaciones que le fueron realizadas.
                    </p>
                </div>
            </blockquote>
        </div>
    </div>
</div>