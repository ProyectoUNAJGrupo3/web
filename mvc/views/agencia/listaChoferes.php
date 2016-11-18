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


AppAssetAgencia::register($this);
AppAsset::register($this);
AppAssetWebSite::register($this);

/* @var $this yii\web\View */
Modal::begin([
'id'=>'modal',
'size'=>'modal-lg',
]);
echo "<div id='modalContent'></div>";
Modal::end();
?>
<!--<div class="container">
    <section id="main">
        <article>
            <div id="page-single-main">-->
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDMVbdR-TGis783bW9rB9tZUJXVXsIRzkQ&libraries=places"></script>
<div class="site-contact">
    <section id="main">
        <article>
            <div id="page-single-main">
                <br />
                <h1 id="title-form">
                    <strong>Listado de Choferes</strong>
                </h1>
                <div class="container-form" id="contenedor-formulario">
                    <h1>
<?= Html::encode($this->title) ?>
                    </h1>

<?php if (Yii::$app->session->hasFlash('Usuario creado con exito')): ?>
                        <div class="alert alert-success">
                            Thank you for contacting us. We will respond to you as soon as possible.
                        </div>
                        <p>
                            Note that if you turn on the Yii debugger, you should be able
                            to view the mail message on the mail panel of the debugger.
    <?php if (Yii::$app->mailer->useFileTransport): ?>
                                Because the application is in development mode, the email is not sent but saved as
                                a file under
                                <code>
        <?= Yii::getAlias(Yii::$app->mailer->fileTransportPath) ?>
                                </code>.
                                Please configure the
                                <code>useFileTransport</code>property of the
                                <code>mail</code>
                                application component to be false to enable email sending.
                        <?php endif; ?>
                        </p>
<?php else: ?>
                        <div>
                            <h1> Grilla de choferes</h1>

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
                           <?php $form = ActiveForm::begin(); ?>
                            <div id='botones-group'>
                                <?=Html::button('agregar', ['value'=>Url::toRoute('agencia/alta_chofer_agencia'), 'class'=>'btn btn-primary btn-lg','id'=>'modalButton']);  ?>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <?= Html::Button('Actualizar', ['class' => 'btn btn-primary', 'id' => 'btn-guardar']); ?>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <?= Html::Button('Eliminar', ['class' => 'btn btn-primary', 'id' => 'btn-guardar']); ?>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <?= Html::button('Cerrar', ['class' => 'btn btn-primary', 'id' => 'btn-cancelar']); ?>
                            </div>
                             <?php ActiveForm::end(); ?>
<?php endif; ?>
                    </div>  
                    </article>
                    </section>
                </div>