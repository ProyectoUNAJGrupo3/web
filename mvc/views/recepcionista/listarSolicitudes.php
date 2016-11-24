<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAssetRecepcionista;
use yii\grid\GridView;
use yii\helpers\BaseHtml;
use yii\widgets\ActiveForm;
use yii\bootstrap\Dropdown;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Button;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\bootstrap\Alert;
AppAssetRecepcionista::register($this);
raoul2000\bootswatch\BootswatchAsset::$theme = 'superhero';
$this->title = 'RemisYa';

?>


<?php  Modal::begin([
'header' => '
        <h4>Mensaje</h4>',
'id'=>'processmodal',
'size'=>'modal-sm',
'options'=>['class'=>'modal'],
'clientOptions' => ['backdrop' => 'static', 'keyboard' => false]
]);
       echo "Procesando...";
       Modal::end();
?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h4 class="panel-title">Listado de viajes emitidos</h4>
    </div>
    <div class="panel-body">
        

        <?php Pjax::begin(['id'=>'containerpjax','timeout' => false]); ?>
        <?php if (Yii::$app->session->hasFlash('viajeCerrado')): ?>
        <div class="alert alert-success alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
            <h4>
                <i class="icon fa fa-check"></i>Operacion realizada.
            </h4>
            <?= Yii::$app->session->getFlash('viajeCerrado') ?>
        </div>
        <?php endif; ?>
        <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true]]);?>
        <?=
        GridView::widget([
        'id' => 'viajes_grid',
        'dataProvider' => $model->dataProvider,
        'tableOptions' => ['class' => 'table  table-bordered table-hover'],
        'columns' => [
        ['class' => 'yii\grid\CheckboxColumn'],
            'ClienteNombre',
            'DestinoDireccion',
            'ChoferNombre',
            'VehiculoMarca',
            'VehiculoModelo',
            'ViajeTipo',
            'Estado',
        ],]);
        ?>
        

        <?= $form->field($model, 'Chofer')->dropDownList($model->Choferes, ['prompt' => 'Seleccione chofer']) ?>
        <?= $form->field($model, 'Vehiculo')->dropDownList($model->Vehiculos, ['prompt' => 'Seleccione vehiculo']) ?>
        <?php ActiveForm::end(); ?>
        <?php Pjax::end(); ?>
        <div id="buttonsOperaciones">
            <?= Html::button('Cerrar viaje',['class' => 'btn btn-lg btn-primary','name'=>'submit','value'=>'cerrar']);?>
            <?= Html::button('Cancelar viaje',['class' => 'btn btn-lg btn-primary','name'=>'submit','value'=>'cancelar']);?>
        </div>

        </div>
</div>

<?php
$this->registerJs(

   "$( document ).ready(function() {
$('#buttonsOperaciones :button').click(function(){
        var keys = $('#viajes_grid').yiiGridView('getSelectedRows');
        var operacion = $(this).attr('value');
                        $('#processmodal').modal('show');
                         $.ajax({
                        type     :'post',
                        cache    : true,
                        data: {keylist: keys,viajeoperacion: operacion},
                        url  : '".Url::to(['recepcionista/listaviajes'])."',
                        success  : function() {
                            $('#processmodal').modal('hide');
                            $.pjax.reload({container:'#containerpjax',timeout: 20000});
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
