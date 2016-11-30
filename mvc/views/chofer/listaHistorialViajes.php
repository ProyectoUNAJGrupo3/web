<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\assets\AppAssetChofer;
//use app\assets\AppAssetWebSite;
use yii\grid\GridView;
use yii\helpers\BaseHtml;
use yii\widgets\ActiveForm;
use yii\bootstrap\Dropdown;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Button;
use yii\bootstrap\Modal;
use app\assets\BootswatchAsset;
use yii\helpers\Url;
//use app\assets\AppAssetPopups;

$this->title = 'RemisYa';
raoul2000\bootswatch\BootswatchAsset::$theme = 'superhero';
BootswatchAsset::register($this);
AppAssetChofer::register($this);

Modal::begin([
    'id' => 'modal',
        //'size' => 'modal-lg',
]);
echo "<div id='modalContent'></div>";
Modal::end();
?>
<div class="container">
    <!--<div class="well bs-component">-->

    <?=
    GridView::widget(['id' => 'grid',
        'dataProvider' => $model->dataProvider,
        'columns' => [
            ['class' => 'yii\grid\CheckboxColumn'],
            'ChoferNombre',
            'VehiculoMarca',
            'VehiculoModelo',
            'AgenciaNombre',
            'ClienteNombre',
            'OrigenDireccion',
            'DestinoDireccion',
            'FechaSalida',
            'ImporteTotal',
            'Distancia',
            'ViajeTipo',
            'Estado',
            /*Probando agregar botones en la gridview*/

            [ 'class' => 'yii\grid\ActionColumn',
                'template' => '{Calificar}',
                'buttonOptions' => [
                    'Calificar' => [
                        'label' => 'calificar',
                        'class' => 'btn btn-primary',
                    ]
                //'class' => 'btn btn-primary',
                //'id' => 'modalButtonCalificar',
                ],
            ],
        ],
    ]);
    ?>
    <?php $form = ActiveForm::begin(); ?>
    <?= Html::Button('Abrir ventana calificar', ['value' => Url::toRoute('/chofer/calificar_cliente'), 'class' => 'btn btn-primary', 'id' => 'buttonAbrirCalificacion']); ?>
    <?php $form = ActiveForm::end(); ?>
</div>
<!--</div>-->
<?php