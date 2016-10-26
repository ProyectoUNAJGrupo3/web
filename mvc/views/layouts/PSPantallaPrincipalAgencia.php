<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\assets\PSCssAsset;

AppAsset::register($this);
PSCssAsset::register($this);
$this->title = 'Agencia';
?>


<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <!--Icons-->
        <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
        <!--fonts-->
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 
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
                'brandLabel' => '<img src="img/logo.ico" style="display:inline; margin-top: -15px; vertical-align: top; width:50px; height:50px;">&nbsp&nbsp&nbsp&nbsp<b styel="size:15px">Agencia</b>',
                'brandUrl' => Yii::$app->homeUrl,
                'id' => 'barra-agencia',
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            ;
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    ['label' => 'Home'], // 'url' => ['/site/index']],
//                    ['label' => 'Listar Empleados'], // 'url' => ['/site/about']],
//                    ['label' => 'Listar Viajes'], // 'url' => ['/site/contact']],
//                    ['label' => 'Listar Vehiculo'], // 'url' => ['/site/registro']], //boludez que agregue yo
                    Yii::$app->user->isGuest ? (
                            //['label' => 'Login', 'url' => ['/site/login'], 'id'=>'btn-login','onClick()'=>'abrirLoginDesdeBotonLoginHeader()']
                            ['label' => 'Login']// 'url' => ['/site/login']]
                            ) : (
                            '<li>'
                            . Html::beginForm(['/site/logout'], 'post', ['class' => 'navbar-form'])
                            . Html::submitButton(
                                    'Logout (' . Yii::$app->user->identity->Usuario . ')', ['class' => 'btn btn-link']
                            )
                            . Html::endForm()
                            . '</li>'
                            )
                ]
            ]);
            NavBar::end();
            ?>

            <div class="container">
                <?=
                Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ])
                ?>
            </div>
        </div>
        <section id="seccion">
            <article>
                <div class="body">
                    <div id="contenedor">
                        <div id="cartel"><p>
                            <h1 id="warning">Warning</h1>
                            <img src="img/warning.jpg">
                            <h1 id="acceso-denegado">Acceso Denegado</h1>
                            <p ><h3>By Sebastian Encina</h3></p>
                            </p>
                        </div>
                    </div>
                </div>
            </article>
        </section>

        <aside id="columna">

         <!--<a href="#" class="btn-menu">Menu<i class="fa fa-bars" aria-hidden="true"></i></a>-->
            <ul class="menu-empleados">
                <li><a href="#"><i class="icono izquierda fa fa-user" aria-hidden="true"></i>Empleados<i class="icono derecha fa fa-chevron-down" aria-hidden="true"></i></a>

                    <ul class="menu-chofer">
                        <li><a href="#"><i class="icono izquierda fa fa-car" aria-hidden="true"></i>
                                Chofer
                                <i class="icono derecha fa fa-chevron-down" aria-hidden="true"></i></a>
                            <ul>
                                <li>Nuevo Chofer</li>
                                <li>Eliminar Chofer</li>
                                <li>Actualizar Datos Chofer</li>
                                <li>Listar Choferes</li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="menu-recepcionista">
                        <li><a href="#"><i class="icono izquierda fa fa-phone-square" aria-hidden="true"></i>
                                Telefonista
                                <i class="icono derecha fa fa-chevron-down" aria-hidden="true"></i></a>
                            <ul>
                                <li>Nueva Telefonista</li>
                                <li>Eliminar Telefonista</li>
                                <li>Actualizar  Datos Telefonista</li>
                                <li>Listar Telefonistas</li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>

            <ul class="menu-vehiculos">
                <li><a href="#"><i class="icono izquierda fa fa-car" aria-hidden="true"></i>
                        Veh&iacute;culos<i class="icono derecha fa fa-chevron-down" aria-hidden="true"></i></a>
                    <ul>
                        <li>Nuevo Veh&iacute;culo</li>
                        <li>Eliminar Veh&iacute;culo</li>
                        <li>Actualizar Datos Veh&iacute;culo</li>
                        <li>Listar Veh&iacute;culo</li>
                    </ul>
                </li>
            </ul>

            <ul class="menu-viajes">
                <li><a href="#"> <i class="icono izquierda fa fa-road" aria-hidden="true"></i>
                        Viajes <i class="icono derecha fa fa-chevron-down" aria-hidden="true"></i></a></li>
                <ul>
                    <li>Nuevo Viaje</li>
                    <li>Eliminar Viaje</li>
                    <li>Actualizar Datos Viaje</li>
                    <li>Listar Viaje</li>
                </ul>
            </ul>

        </aside>
        <?php $this->endBody() ?>
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script src="web/js/jQuery.js"></script>

    </body>
</html>
<?php $this->endPage() ?>
