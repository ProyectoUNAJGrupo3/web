<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\assets\AppAssetChofer;
use app\assets\AppAssetWebSite;
use yii\grid\GridView;
use yii\helpers\BaseHtml;
use yii\widgets\ActiveForm;
use yii\bootstrap\Dropdown;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Button;
use yii\bootstrap\Modal;
use app\assets\BootswatchAsset;

raoul2000\bootswatch\BootswatchAsset::$theme = 'superhero';
/*BootswatchAsset::register($this);*/
AppAsset::register($this);
AppAssetChofer::register($this);
AppAssetWebSite::register($this);

?>
<h1>
    <?= Html::encode($this->title) ?>
</h1>
<?php if (Yii::$app->session->hasFlash('Calificacion Exitosa')): ?>
<div class="alert alert-dismissible alert-success">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Operacion exitosa!</strong>
    <a href="#" class="alert-link">Cliente Calificado con Exito</a>.
</div>
<?php endif ?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h4 class="panel-title">&ensp; &ensp;  Historial de Calificaciones</h4>
    </div>
    <div class="container">
        <div class="panel-body">
            <div class="row">
                <div class="table-responsive">
                    <!-- <div class="well bs-component">-->
                    <?=
                    GridView::widget([
                        'dataProvider' => $model->dataProvider,
                        'tableOptions' => ['class' => 'table table-bordered table-hover', 'style'=>'border-collapse: collapse; border: 3px solid #df691a; '],

                        'columns' => [
            ['header' => '<h5>Calificante</h5>','attribute' => 'Calificante','contentOptions' => ['style'=>'border-color:black;'],'headerOptions' => ['style'=>'border-color:black;background-color:#df691a;']],
            ['header' => '<h5>Calificado</h5>','attribute' => 'Calificado','contentOptions' => ['style'=>'border-color:black;',],'headerOptions' => ['style'=>'border-color:black;background-color:#df691a;']],
            ['header' => '<h5>Fecha</h5>','attribute' => 'Fecha','contentOptions' => ['style'=>'border-color:black;',],'headerOptions' => ['style'=>'border-color:black;background-color:#df691a;']],
            ['header' => '<h5>Puntaje</h5>','attribute' => 'Puntaje','contentOptions' => ['style'=>'border-color:black;',],'headerOptions' => ['style'=>'border-color:black;background-color:#df691a;']],
            ['header' => '<h5>Comentario</h5>','attribute' => 'Comentario','contentOptions' => ['style'=>'border-color:black;',],'headerOptions' => ['style'=>'border-color:black;background-color:#df691a;']],

                        ],
                           'rowOptions' => function ($model, $key, $index, $grid) {
                               return ['rowid' => $key, 'onclick' => '$(this).addClass("success").siblings().removeClass("success");','style' => 'cursor:pointer'];
                           },
                        ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>