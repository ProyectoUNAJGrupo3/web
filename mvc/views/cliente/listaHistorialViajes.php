<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\assets\AppAssetCliente;
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
use app\assets\AppAssetPopups;

raoul2000\bootswatch\BootswatchAsset::$theme = 'superhero';
BootswatchAsset::register($this);
//AppAsset::register($this);
AppAssetPopups::register($this);

Modal::begin([
    'id' => 'modal',
    //'size' => 'modal-lg',
]);
echo "<div id='modalContentCliente'></div>";
Modal::end();

/*
raoul2000\bootswatch\BootswatchAsset::$theme = 'superhero';
BootswatchAsset::register($this);
AppAsset::register($this);
AppAssetCliente::register($this);
//AppAssetWebSite::register($this);
// @var $this yii\web\View
//$this->title = 'RemisYa';
*/
?>
<div class="container">
    <div class="well bs-component">
        <?=
        GridView::widget([
            'id' => 'calificar_grid',
            'dataProvider' => $model->dataProvider,
            'columns' => [
                ['class' => 'yii\grid\CheckboxColumn'],
                'ClienteNombre',
                'AgenciaNombre',
                'OrigenDireccion',
                'DestinoDireccion',
                'ChoferNombre',
                'VehiculoMarca',
                'VehiculoModelo',
                'FechaSalida',
                'ImporteTotal',
                'Distancia',
                'ViajeTipo',
                'Estado',
            ],]);
        ?>
        <?php $form = ActiveForm::begin(); ?>
        <div id='botones-group'>
            <?= Html::button('Abrir ventana calificar', ['value' => Url::toRoute('/cliente/calificar_servicio_remis'), 'class' => 'btn btn-primary', 'id' => 'modalButtonCalificarServicio']); ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <?= Html::submitButton('Cerrar', ['class' => 'btn btn-primary', 'id' => 'btn-cancelar']); ?>
        </div>
        <?php $form = ActiveForm::end(); ?>
    </div>
</div>
<?php
$this->registerJs(
   "$( document ).ready(function() {
$('#modalButtonCalificarServicio').click(function(){
        var keys = $('#calificar_grid').yiiGridView('getSelectedRows');

                                                $.ajax({
                        type     :'post',
                        cache    : true,
                        data: {keylist: keys},
                        url  : '".Url::to(['cliente/calificar_servicio_remis'])."',
                        success  : function() {
                            alert('prueba');

                        },
                        error: function(){
                           alert('Error');
                            $('#processmodal').modal('hide');
                        }
                        });return false;
});
});"
);
?>
