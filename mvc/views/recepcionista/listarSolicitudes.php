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
AppAssetRecepcionista::register($this);
$this->title = 'RemisYa';
Modal::begin([
'header' => '<h4>Mensaje</h4>',
'id'=>'processmodal',
'size'=>'modal-sm',
'options'=>['class'=>'modal']
]);
echo "Procesando...";
Modal::end();
?>

<?php if (Yii::$app->session->hasFlash('viajeCerrado')): ?>
<div class="alert alert-dismissible alert-success">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Operacion exitosa!</strong>
    <a href="#" class="alert-link">Viaje cerrado correctamente</a>.
</div>
<?php endif ?>
<?php if (Yii::$app->session->hasFlash('viajeCancelado')): ?>
<div class="alert alert-dismissible alert-warning">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Operacion exitosa!</strong>
    <a href="#" class="alert-link">Viaje cerrado correctamente</a>.
</div>
<?php endif ?>


<div class="panel panel-primary">
    <div class="panel-heading">
        <h4 class="panel-title">Listado de viajes emitidos</h4>
    </div>
    <div class="panel-body">
        <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true]]);?>

        <?php Pjax::begin(['timeout' => false]); ?>
        <?php if (Yii::$app->session->hasFlash('viajeCerrado')): ?>
        <div class="alert alert-dismissible alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Operacion exitosa!</strong>
            <a href="#" class="alert-link">Viaje cerrado correctamente</a>.
        </div>
        <?php endif ?>
        <?= Html::a("Refresh", ['recepcionista/listaviajes'], ['class' => 'btn btn-lg btn-primary']) ?>
        <?= Html::button('Cerrar viaje', ['id'=>'cerrarid','class' => 'btn btn-lg btn-primary']);?>

        <h1>
            Current time: <?= $time ?>
        </h1>
        
        <?php Pjax::end(); ?>

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

        
        

        <?= Html::button('Confirmar solicitud', ['class' => 'btn btn-primary']) ?>
        <?= Html::button('Cancelar solicitud', ['class' => 'btn btn-primary']) ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>

<?php
$this->registerJs(
   "$('#cerrarid').click(function(){
     var keys = $('#viajes_grid').yiiGridView('getSelectedRows');
$('#processmodal').modal('show');
                         $.ajax({
                        type     :'post',
                        cache    : false,
                        data: {keylist: keys},
                        processData: true,
                        url  : '".Url::to(['recepcionista/listaviajes'])."',
                        success  : function() {
$('#processmodal').modal('hide');
                        },
                        error: function(){
                           alert('Error');
$('#processmodal').modal('hide');
                        }
                        });return false;
});"
);
?>
