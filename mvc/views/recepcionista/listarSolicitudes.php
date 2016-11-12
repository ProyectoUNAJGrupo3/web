<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\assets\AppAssetWebSite;
use yii\grid\GridView;
use yii\helpers\BaseHtml;
use yii\widgets\ActiveForm;
use yii\bootstrap\Dropdown;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Button;
use yii\bootstrap\Modal;

AppAsset::register($this);
AppAssetWebSite::register($this);
/* @var $this yii\web\View */
$this->title = 'RemisYa';
?>

<div class="container">
    <section id="main">
        <article>
            <div id="page-single-main-recepcionista">
                <br />
                <h1 id="title-form-recepcionista">
                    <strong>Datos Solicitud</strong>
                </h1>
                <div class="container-form" id="contenedor-formulario-recepcionista">
                    <h1>
                        <?= Html::encode($this->title) ?>
                    </h1>
                    <?=
                    GridView::widget([
                        'dataProvider' => $model->dataProvider,
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

                    <?php $form = ActiveForm::begin(); ?>
                    <?= $form->field($model, 'Chofer')->dropDownList($model->Choferes, ['prompt' => 'Seleccione chofer']) ?>
                    <?= $form->field($model, 'Vehiculo')->dropDownList($model->Vehiculos, ['prompt' => 'Seleccione vehiculo']) ?>

                    <?= Html::button('Cerrar viaje', ['class' => 'btn btn-primary']) ?>

                    <?= Html::button('Cancelar viaje', ['class' => 'btn btn-primary']) ?>

                    <?= Html::button('Modificar viaje', ['class' => 'btn btn-primary']) ?>

                    <?= Html::button('Confirmar solicitud', ['class' => 'btn btn-primary']) ?>

                    <?= Html::button('Cancelar solicitud', ['class' => 'btn btn-primary']) ?>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </article>
    </section>
</div>