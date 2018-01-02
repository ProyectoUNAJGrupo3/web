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
raoul2000\bootswatch\BootswatchAsset::$theme = 'superhero';
AppAssetRecepcionista::register($this);
$this->title = 'RemisYa';

?>


<div class="panel panel-primary">
    <div class="panel-heading">
        <h4 class="panel-title">Autorizar solicitud</h4>
    </div>
    <div class="panel-body">
        
        <?php $form = ActiveForm::begin();?>
        <?= $form->field($model, 'Chofer')->dropDownList($model->Choferes, ['prompt' => 'Seleccione chofer']) ?>
        <?= $form->field($model, 'Vehiculo')->dropDownList($model->Vehiculos, ['prompt' => 'Seleccione vehiculo']) ?>
        

        <div id="buttonsOperaciones">
            <?= Html::submitButton('Confirmar',['class' => 'btn btn-primary']);?>
            <?= Html::resetButton('Cancelar',['class' => 'btn btn-primary']);?>
        </div>
        <?php ActiveForm::end(); ?>
        </div>
</div>