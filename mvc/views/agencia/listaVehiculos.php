<?php

use yii\helpers\BaseHtml;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\AppAsset;
use app\assets\AppAssetAgencia;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\assets\BootswatchAsset;

raoul2000\bootswatch\BootswatchAsset::$theme = 'superhero';
/*BootswatchAsset::register($this);*/
AppAssetAgencia::register($this);
AppAsset::register($this);
?>

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
            
    <br />
    <br />
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title">&ensp; &ensp; Listado de Vehiculos</h4>
        </div>
        <div class="container">
            <div class="panel-body">
                <div class="row">
                    <div class="table-responsive">

                        <?=
                GridView::widget([
                    'dataProvider' => $model->dataProvider,
                    'tableOptions' => ['class' => 'table table-bordered table-hover', 'style'=>'border-collapse: collapse; border: 3px solid #df691a; '],
                    'columns' => [
                        ['class'  => 'yii\grid\CheckboxColumn','contentOptions' => ['style'=>'border-color:black;'],'headerOptions' => ['style'=>'border-color:black;background-color:#df691a;']],
                        ['header' => '<h5>Marca</h5>','attribute' => 'Marca','contentOptions' => ['style'=>'border-color:black;'],'headerOptions' => ['style'=>'border-color:black;background-color:#df691a;']],
                        ['header' => '<h5>Modelo</h5>','attribute' => 'Modelo','contentOptions' => ['style'=>'border-color:black;'],'headerOptions' => ['style'=>'border-color:black;background-color:#df691a;']],
                        ['header' => '<h5>Matricula</h5>','attribute' => 'Matricula','contentOptions' => ['style'=>'border-color:black;'],'headerOptions' => ['style'=>'border-color:black;background-color:#df691a;']],
                    ],
                       'rowOptions' => function ($model, $key, $index, $grid) {
                           return ['rowid' => $key, 'onclick' => '$(this).addClass("success").siblings().removeClass("success");','style' => 'cursor:pointer'];
                       },
               ]);
                        ?>
                        <div id='botones-group'>
                            <?= Html::submitButton('Agregar', ['class' => 'btn btn-primary', 'id' => 'btn-guardar']); ?>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <?= Html::submitButton('Actualizar', ['class' => 'btn btn-primary', 'id' => 'btn-guardar']); ?>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <?= Html::submitButton('Eliminar', ['class' => 'btn btn-primary', 'id' => 'btn-guardar']); ?>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <?= Html::button('Cerrar', ['class' => 'btn btn-primary', 'id' => 'btn-cancelar']); ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!--</div>
                        </article>
                        </section>
                    </div>-->
                </div>
            </div>
        </div>
    </div>
