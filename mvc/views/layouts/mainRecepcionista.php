<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
//use app\assets\AppAssetRecepcionista;
use app\assets\BootswatchAsset;

BootswatchAsset::register($this);
//AppAssetRecepcionista::register($this);

$this->title = 'Recepcionista';
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
                'brandLabel' => '<img src="img/LogoApp.png" style="display:inline; margin-top: -20px; vertical-align: top; width:120px; height:55px;">&nbsp&nbsp&nbsp&nbsp<b styel="size:15px">Recepcionista</b>',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar navbar-default',
                ],
            ]);
            ;
            echo Nav::widget([
                'encodeLabels' => false,
                'options' => ['class' => 'nav-pills navbar-right'],
                'items' => [
                    //['label' => '<span class="fa fa-home"></span> ' . Html::encode('Home'), 'url' => ['recepcionista/index']],
                    [
                        'label' => '<span class="fa fa-suitcase"></span> ' . Html::encode('Viajes'),
                        'items' => [
                            //['label' => 'Carga Nuevo viaje', 'url' => ['/recepcionista/alta_viaje_manual'], 'style' => 'background-color:blue;', 'class' => 'dropdown-toggle'],
                            //'<li class="divider"></li>',
                            ['label' => '<span class="fa fa-th-list"></span> ' . Html::encode('Administrar'), 'url' => ['/recepcionista/alta_viaje_manual'], 'style' => 'background-color:blue;', 'class' => 'dropdown-toggle'],
                            ['label' => '<span class="fa fa-th-list"></span> ' . Html::encode('Solicitudes Online'), 'url' => ['/recepcionista/listasolicitudes'], 'style' => 'background-color:blue;', 'class' => 'dropdown-toggle'],
                        ],
                    ],
                    [
                        'label' => '<span class="fa fa-users"></span> ' . Html::encode('Clientes'),
                        'items' => [
                            ['label' => '<span class="fa fa-th-list"></span> ' . Html::encode('Administrar'), 'url' => ['/recepcionista/administrarcliente'], 'style' => 'background-color:blue;', 'class' => 'dropdown-toggle'],
                        //['label' => '<span class="fa fa-th-list"></span> ' . Html::encode('Alta'), 'url' => ['/recepcionista/alta_cliente'], 'style' => 'background-color:blue;', 'class' => 'dropdown-toggle'],
                        //['label' => '<span class="fa fa-th-list"></span> ' . Html::encode('Modificacion'), 'url' => ['/recepcionista/actualizar_cliente'], 'style' => 'background-color:blue;', 'class' => 'dropdown-toggle'],
                        ],
                    ],
                    [
                        'label' => '<span class="fa fa-usd"></span> ' . Html::encode('Tarifas'),
                        'items' => [
                            ['label' => '<span class="fa fa-th-list"></span> ' . Html::encode('Administrar'), 'url' => ['/recepcionista/administrartarifa'], 'style' => 'background-color:blue;', 'class' => 'dropdown-toggle'],
                        //['label' => '<span class="fa fa-th-list"></span> ' . Html::encode('Alta'), 'url' => ['/recepcionista/alta_tarifa'], 'style' => 'background-color:blue;', 'class' => 'dropdown-toggle'],
                        //['label' => '<span class="fa fa-th-list"></span> ' . Html::encode('Modificacion'), 'url' => ['/recepcionista/actualizar_tarifa'], 'style' => 'background-color:blue;', 'class' => 'dropdown-toggle'],
                        ],
                    ],
                    //['label' => 'Ver Solicitud', 'url' => ['recepcionista/ver_datos_solicitud_de_servicio']],
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


            <?=
            Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ])
            ?>
            <?= $content ?>
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
