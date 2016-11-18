<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\BootswatchAsset;
use app\assets\AppAsset;

BootswatchAsset::register($this);
AppAsset::register($this);


$this->title = 'Agencia';
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
        <meta charset="<?= Yii::$app->charset ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <?= Html::csrfMetaTags() ?>
        <title>
            <?= Html::encode($this->title) ?>
        </title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php
        $this->beginBody();
        /* include('testMaps.php'); */
        ?>

        <div class="wrap">
            <?php
            NavBar::begin([
                'id' => 'barra-agencia',
                'brandLabel' => '<img src="img/LogoApp.png" style="display:inline; margin-top: -20px; vertical-align: top; width:120px; height:55px;">&nbsp&nbsp&nbsp&nbsp<b styel="size:15px">Agencia</b>',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => ['class' => 'navbar navbar-default navbar-fixed-top navbar-transparent'],
                    //'options' => [
                    //    'class' => 'navbar-inverse navbar-fixed-top',
                    //],
            ]);
            ;
            echo Nav::widget([
                'encodeLabels' => false,
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    ['label' => '<span class="fa fa-suitcase"  ></span> ' . Html::encode('Viajes'), 'url' => ['/agencia/index']],
                    [
                        'label' => '<span class="fa fa-user-plus"></span> ' . Html::encode('Choferes'),
                        'items' => [
                            ['label' => '<span class="fa fa-th-list"></span> ' . Html::encode('Administrar'), 'url' => ['/agencia/listar_choferes_agencia'], 'data-toggle' => 'dropdown', 'class' => 'dropdown-toggle'],
                        //['label' => '<span class="fa fa-user"></span> ' . Html::encode('Nuevo'), 'url' => ['/agencia/alta_chofer_agencia']],
                        ],
                    ],
                    //['label' => 'Choferes', 'data-toggle' => 'dropdown', 'class' => 'dropdown-toggle', 'items' => [
                    //DatePicker
                    //['label' => 'Actualizar', 'url' => ['/agencia/actualizar_chofer_agencia']],
                    //],],
                    //['label' => 'Telefonistas', 'items' => [
                    [
                        'label' => '<span class="fa fa-user-plus"></span> ' . Html::encode('Telefonistas'),
                        'items' => [
                            ['label' => '<span class="fa fa-th-list"></span> ' . Html::encode('Administrar'), 'url' => ['/agencia/listar_recepcionistas_agencia'], 'data-toggle' => 'dropdown', 'class' => 'dropdown-toggle'],
                        //['label' => '<span class="fa fa-user"></span> ' . Html::encode('Nuevo'), 'url' => ['/agencia/alta_telefonista_agencia'], 'class' => 'dropdown-toggle'],
                        //'<li class="divider"></li>',
                        //['label' => '<span class="fa fa-th-list"></span> ' . Html::encode('Listar Todos'), 'url' => ['/agencia/listar_recepcionistas_agencia'], 'data-toggle' => 'dropdown', 'class' => 'dropdown-toggle'],
                        ],
                    ],
                    //DatePicker                            
                    //['label' => 'Actualizar', 'url' => ['/agencia/actualizar_recepcionista_agencia']],
                    //],],
                    [
                        'label' => '<span class="fa fa-plus"  ></span> ' . Html::encode('Vehiculos'),
                        'items' => [
                            ['label' => '<span class="fa fa-th-list"></span> ' . Html::encode('Administrar'), 'url' => ['/agencia/listar_vehiculo_agencia'], 'data-toggle' => 'dropdown', 'class' => 'dropdown-toggle'],
                        //['label' => '<span class="fa fa-car"></span> ' . Html::encode('Nuevo'), 'url' => ['/agencia/alta_vehiculo_agencia'], 'class' => 'dropdown-toggle'],
                        //'<li class="divider"></li>',
                        //['label' => 'Actualizar', 'url' => ['/agencia/actualizar_vehiculo_agencia'], 'class' => 'dropdown-toggle'],
                        //'<li class="divider"></li>',
                        //['label' => '<span class="fa fa-th-list"></span> ' . Html::encode('Listar Todos'), 'url' => ['/agencia/listar_vehiculo_agencia'], 'data-toggle' => 'dropdown', 'class' => 'dropdown-toggle'],
                        ],
                    ],
                    [
                        'label' => '<span class="fa fa-star"  ></span> ' . Html::encode('Calificaciones'),
                        'items' => [
                            ['label' => '<span class="fa fa-th-list"></span> ' . Html::encode('Administrar'), 'url' => ['#'], 'style' => 'background-color:blue;', 'class' => 'dropdown-toggle'],
                        /*  '<li class="divider"></li>',
                          ['label' => '<span class="fa fa-th-list"></span> ' . Html::encode('Listar Turno Tarde'), 'url' => ['/agencia/listar_viajes_turno_tarde_agencia'], 'style' => 'background-color:blue;', 'class' => 'dropdown-toggle'],
                          '<li class="divider"></li>',
                          ['label' => '<span class="fa fa-th-list"></span> ' . Html::encode('Listar Turno Noche'), 'url' => ['/agencia/listar_viajes_turno_noche_agencia'], 'style' => 'background-color:blue;', 'class' => 'dropdown-toggle'],
                          '<li class="divider"></li>', */
                        //  ['label' => '<span class="fa fa-th-list"></span> ' . Html::encode('Listar Todos'), 'url' => ['/agencia/listar_viajes_totales_agencia'], 'data-toggle' => 'dropdown', 'class' => 'dropdown-toggle'],
                        ],
                    ],
                    Yii::$app->user->isGuest ? (
                            //['label' => 'Login', 'url' => ['/site/login'], 'id'=>'btn-login','onClick()'=>'abrirLoginDesdeBotonLoginHeader()']
                            ['label' => 'Login', 'url' => ['/site/login']]
                            ) : (
                            '<li>'
                            . Html::beginForm(['/site/logout'], 'post', ['class' => 'navbar-form'])
                            . Html::submitButton(
                                    'Logout (' . Yii::$app->user->identity->Usuario . ')', ['class' => 'btn btn-link']
                            )
                            . Html::endForm()
                            . '</li>'
                            )
                ],
            ]);
            NavBar::end();
            ?>


            <!--<div class="container">-->
            <?=
            Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ])
            ?>
            <?= $content ?>
            <!--</div>-->
        </div>

        <footer class="footer">
            <div class="container">
                <!--<hr style="border:1px solid gray;">-->

                <span id="footer-copy-right" style="text-align:center"> 
                    <i class="fa fa-map-marker"></i>   Contactenos:&nbsp; &nbsp; &nbsp; &nbsp;
                    <i class="fa fa-phone-square"></i> &nbsp; 011-4369-4657 &nbsp; &nbsp; 011-4287-5324 &nbsp; &nbsp;
                    <i class="fa fa-envelope"></i> &nbsp; administracion@remisya.com
                </span>
            </div>
        </footer>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
