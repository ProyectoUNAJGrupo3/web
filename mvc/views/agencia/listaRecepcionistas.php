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
/*BootswatchAsset::register($this);*/
AppAssetAgencia::register($this);
AppAsset::register($this);
AppAssetWebSite::register($this);

/* @var $this yii\web\View */
Modal::begin([
    'id' => 'modal',
    'size' => 'modal-lg',
]);
echo "<div id='modalContent'></div>";
Modal::end();
?>
                    <h1>
                        <?= Html::encode($this->title) ?>
                    </h1>
                    <?php if (Yii::$app->session->hasFlash('Recepcionista eliminado con exito')): ?>
                    <div class="alert alert-dismissible alert-success">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Operacion exitosa!</strong>
                        <a href="#" class="alert-link">Recepcionista Eliminado correctamente</a>.
                    </div>
                    <?php endif ?>
                    <?php if (Yii::$app->session->hasFlash('Recepcionista creado con exito')): ?>
                    <div class="alert alert-dismissible alert-success">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Operacion exitosa!</strong>
                        <a href="#" class="alert-link">Recepcionista creado con exito</a>.
                    </div>
                    <?php endif ?>
                    <?php if (Yii::$app->session->hasFlash('Recepcionista actualizado con exito')): ?>
                    <div class="alert alert-dismissible alert-success">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Operacion exitosa!</strong>
                        <a href="#" class="alert-link">Recepcionista actualizado correctamente</a>.
                    </div>
                    <?php endif ?>


                    <?php $form = ActiveForm::begin(); ?>
<br />
<br />
  <div class="panel panel-primary">
    <div class="panel-heading">
        <h4 class="panel-title">&ensp; &ensp; Listado de Telefonistas</h4>
    </div>
       <div class="container">
        <div class="panel-body">
            <div class="row">
                <div class="table-responsive">
                    <?=
                    GridView::widget(['id' => 'grid',
                                      'summary'=>'',
                                                'dataProvider' => $model->dataProvider,
                                                'tableOptions' => ['class' => 'table table-bordered table-hover', 'style'=>'border-collapse: collapse; border: 3px solid #df691a; '],
                                                'columns' => [
                                                     ['header' => '<h5>Usuario</h5>','attribute' => 'Usuario','contentOptions' => ['style'=>'border-color:black;'],'headerOptions' => ['style'=>'border-color:black;background-color:#df691a;']],
                                                     ['header' => '<h5>Password</h5>','attribute' => 'Password','contentOptions' => ['style'=>'border-color:black;'],'headerOptions' => ['style'=>'border-color:black;background-color:#df691a;']],
                                                     ['header' => '<h5>Nombre</h5>','attribute' => 'Nombre','contentOptions' => ['style'=>'border-color:black;'],'headerOptions' => ['style'=>'border-color:black;background-color:#df691a;']],
                                                     ['header' => '<h5>Apellido</h5>','attribute' => 'Apellido','contentOptions' => ['style'=>'border-color:black;'],'headerOptions' => ['style'=>'border-color:black;background-color:#df691a;']],
                                                     ['header' => '<h5>Documento</h5>','attribute' => 'Documento','contentOptions' => ['style'=>'border-color:black;'],'headerOptions' => ['style'=>'border-color:black;background-color:#df691a;']],
                                             ],
                         'rowOptions' => function ($model, $key, $index, $grid) {
                                return ['rowid' => $key, 'onclick' => '$(this).addClass("success").siblings().removeClass("success");','style' => 'cursor:pointer'];
                            },
                                                ]);
                    ?>
                    <div id='botones-group'>
                        <?= Html::button('Agregar', ['value' => Url::toRoute('agencia/alta_telefonista_agencia'), 'class' => 'btn btn-primary btn-lg', 'id' => 'modalButton']); ?>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <?= Html::Button('Actualizar', ['value' => Url::toRoute('agencia/actualizar_recepcionista_agencia'),'valor'=> 'actualizar','name' => 'submit','class' => 'btn btn-primary btn-lg', 'id' => 'actualizarButton']); ?>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <?= Html::submitButton('Eliminar', ['class' => 'btn btn-primary btn-lg','name' => 'submit', 'valor' => 'eliminar', 'id' => 'eliminarButton']); ?>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <?= Html::a('Cerrar', [('/agencia/index')],['class' => 'btn btn-primary btn-lg', 'id' => 'btn-cancelar']); ?>
                    </div>

                </div>
                <?php ActiveForm::end(); ?>
                <!--</div>
                    </article>
                    </section>
                </div>-->
                </div>
            </div>
        </div>
    </div>
