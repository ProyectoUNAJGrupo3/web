<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\assets\BootswatchAsset;

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
                'brandLabel' => '<img src="img/LogoApp.png" style="display:inline; margin-top: -20px; vertical-align: top; width:120px; height:55px;">&nbsp&nbsp&nbsp&nbsp<b styel="size:15px">Agencia</b>',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => ['class' => 'navbar navbar-default navbar-fixed-top navbar-transparent'],
            ]);
            ;
            echo Nav::widget([
                'encodeLabels' => false,
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    ['label' => '<span class="fa fa-home"  ></span> ' . Html::encode('Home'), 'url' => ['/agencia/index']],
                    [
                        'label' => '<span class="fa fa-user-plus"></span> ' . Html::encode('Choferes'),
                        'items' => [
                            ['label' => '<span class="fa fa-th-list"></span> ' . Html::encode('Administrar'), 'url' => ['/agencia/listar_choferes_agencia'], 'data-toggle' => 'dropdown', 'class' => 'dropdown-toggle'],
                        ],
                    ],
                    [
                        'label' => '<span class="fa fa-user-plus"></span> ' . Html::encode('Telefonistas'),
                        'items' => [
                            ['label' => '<span class="fa fa-th-list"></span> ' . Html::encode('Administrar'), 'url' => ['/agencia/listar_recepcionistas_agencia'], 'data-toggle' => 'dropdown', 'class' => 'dropdown-toggle'],
                        ],
                    ],
                    [
                        'label' => '<span class="fa fa-plus"  ></span> ' . Html::encode('Vehiculos'),
                        'items' => [
                            ['label' => '<span class="fa fa-th-list"></span> ' . Html::encode('Administrar'), 'url' => ['/agencia/listar_vehiculo_agencia'], 'data-toggle' => 'dropdown', 'class' => 'dropdown-toggle'],
                        ],
                    ],
                    [
                        'label' => '<span class="fa fa-star"  ></span> ' . Html::encode('Calificaciones'),
                        'items' => [
                            ['label' => '<span class="fa fa-th-list"></span> ' . Html::encode('Administrar'), 'url' => ['/agencia/listado_calificaciones'], 'style' => 'background-color:blue;', 'class' => 'dropdown-toggle'],
                        ],
                    ],
                    [
                        'label' => '<span class="fa fa-suitcase"  ></span> ' . Html::encode('Viajes'),
                        'items' => [
                            ['label' => '<span class="fa fa-th-list"></span> ' . Html::encode('Administrar'), 'url' => ['/agencia/listado_viajes'], 'style' => 'background-color:blue;', 'class' => 'dropdown-toggle'],
                        ],
                    ],
                    Yii::$app->user->isGuest ? (
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
