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
BootswatchAsset::register($this);
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

<!--<div class="container">
    <section id="main">
        <article>
            <div id="page-single-main">-->
<!--<div class="site-contact">
    <section id="main">
        <article>
<div id="page-single-main">-->
<div class="container">
    <div class="well bs-component">
        <div class="row">
            <div class="col-lg-8">
                <h1 >
                    <strong>Listado de Choferes</strong>
                </h1>
                <!--<div class="container-form" id="contenedor-formulario">-->
                <h1>
                    <?= Html::encode($this->title) ?>
                </h1>
                <?php if (Yii::$app->session->hasFlash('Chofer eliminado con exito')): ?>
                <div class="alert alert-dismissible alert-success">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Operacion exitosa!</strong>
                    <a href="#" class="alert-link">Chofer Eliminado correctamente</a>.
                </div>
                <?php endif ?>

                    <div>
                        <?php $form = ActiveForm::begin(); ?>
                        <?=
                        GridView::widget(['dataProvider' => $model->dataProvider,
                            'columns' => [
                                ['class' => 'yii\grid\CheckboxColumn'],
                                'Usuario',
                                'Password',
                                'Nombre',
                                'Apellido',
                                'Documento',
                            ],]);
                        ?>
                      
                        <div id='botones-group'>
                            <?= Html::button('Agregar', ['value' => Url::toRoute('agencia/alta_chofer_agencia'), 'class' => 'btn btn-primary btn-lg', 'id' => 'modalButton']); ?>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <?= Html::Button('Actualizar', ['class' => 'btn btn-primary', 'id' => 'btn-guardar']); ?>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <?= Html::submitButton('Eliminar', ['class' => 'btn btn-primary','name' => 'submit', 'value' => 'Eliminar']); ?>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <?= Html::button('Cerrar', ['class' => 'btn btn-primary', 'id' => 'btn-cancelar']); ?>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>  
                <!--</article>
                </section>
            </div>
            </div>-->
            </div>
        </div>

    </div>
</div>