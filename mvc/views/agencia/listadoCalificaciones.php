<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\assets\AppAssetAgencia;
use app\assets\AppAssetWebSite;
use yii\grid\GridView;
use yii\helpers\BaseHtml;
use yii\widgets\ActiveForm;
use yii\bootstrap\Dropdown;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Button;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use app\assets\BootswatchAsset;

raoul2000\bootswatch\BootswatchAsset::$theme = 'superhero';
/* BootswatchAsset::register($this); */
AppAssetAgencia::register($this);
AppAsset::register($this);
AppAssetWebSite::register($this);
?>
<h1>
    <?= Html::encode($this->title) ?>
</h1>

<?php $form = ActiveForm::begin(); ?>
<br />
<br />
<div class="panel panel-primary">
    <div class="panel-heading" style="text-align: center">
        <div class="panel-title">
            <h4>&ensp; &ensp; Listado Calificaciones</h4>
        </div>
    </div>
    <div class="container">
        <div class="panel-body">
            <div class="row">
                <div class="table-responsive">
                </div>
                <?=
                GridView::widget([
                    'dataProvider' => $model->dataProvider,
                    'tableOptions' => ['class' => 'table table-bordered table-hover', 'style'=>'border-collapse: collapse; border: 3px solid #df691a; '],
                    'columns' => [
        ['header' => '<h5>Calificante</h5>','attribute' => 'Calificante','contentOptions' => ['style'=>'border-color:black;'],'headerOptions' => ['style'=>'border-color:black;background-color:#df691a;']],
        ['header' => '<h5>Chofer</h5>','attribute' => 'Calificado','contentOptions' => ['style'=>'border-color:black;',],'headerOptions' => ['style'=>'border-color:black;background-color:#df691a;']],
        ['header' => '<h5>Fecha</h5>','attribute' => 'Fecha','contentOptions' => ['style'=>'border-color:black;',],'headerOptions' => ['style'=>'border-color:black;background-color:#df691a;']],
        ['header' => '<h5>Puntaje</h5>','attribute' => 'Puntaje','contentOptions' => ['style'=>'border-color:black;',],'headerOptions' => ['style'=>'border-color:black;background-color:#df691a;']],
        ['header' => '<h5>Comentario</h5>','attribute' => 'Comentario','contentOptions' => ['style'=>'border-color:black;',],'headerOptions' => ['style'=>'border-color:black;background-color:#df691a;']],
                    ]
                    ]);
                ?>

                <div  style="text-align: center">
                    <?= Html::a('Cerrar', [('/agencia/index')], ['class' => 'btn btn-primary btn-lg', 'id' => 'btn-cancelar']); ?>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
