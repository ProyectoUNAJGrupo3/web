
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

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
                    ['label' => 'Home'], 'url' => ['/site/index'],
                    ['label' => 'Listar Empleados'], 'url' => ['/site/about'],
                    ['label' => 'Listar Viajes'], 'url' => ['/site/contact'],
                    ['label' => 'Listar Vehiculo'], 'url' => ['/site/registro']], //boludez que agregue yo
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

            <div class="menu">
                <a href="#" class="btn-menu">Menu <span class="icono glyphicon glyphicon-list"></span></a>

                <ul class="menu-empleados">
                    <li><a href="#"><span class="icono izquierda glyphicon glyphicon-user"></span>
                            Empleados
                            <span class="icono derecha glyphicon glyphicon-chevron-down"></span></a>

                        <ul class="menu-chofer">
                            <li>
                                <a href="#"><span class="icono izquierda glyphicons glyphicons-car"></span>
                                        <!--<span class="glyphicon icon-car"></span>-->
                                    Chofer
                                    <span class="icono derecha glyphicon glyphicon-chevron-down"></span></a>
                                <ul>
                                    <li><a href="#"><span class="glyphicon glyphicon-user"></span>Nuevo Chofer</a></li>
                                    <li><a href="#"><span class="glyphicon glyphicon-trash"></span>Eliminar Chofer</a></li>
                                    <li><a href="#"><span class="glyphicon glyphicon-repeat"></span>Actualizar Datos Chofer</a></li>
                                    <li><a href="#"><span class="glyphicon glyphicon-list"></span>Listar Choferes</a></li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="menu-recepcionista">
                            <li><a href="#"><span class="icono izquierda glyphicon glyphicon-earphone"></span>
                                    Telefonista
                                    <span class="icono derecha glyphicon glyphicon-chevron-down"></span></a>
                                <ul>
                                    <li><a href="#"><span class="glyphicon glyphicon-user"></span>Nueva Telefonista</a></li>
                                    <li><a href="#"><span class="glyphicon glyphicon-trash"></span>Eliminar Telefonista</a></li>
                                    <li><a href="#"><span class="glyphicon glyphicon-repeat"></span>Actualizar  Datos Telefonista</a></li>
                                    <li><a href="#"><span class="glyphicon glyphicon-list"></span>Listar Telefonistas</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>

                <ul class="menu-vehiculos">
                    <li><a href="#"><!--<span class="icono izquierda glyphicon glyphicon-car"></span>-->
                            Veh&iacute;culos <span class="icono derecha glyphicon glyphicon-chevron-down"></span></a>
                        <ul>
                            <li>Nuevo Veh&iacute;culo</li>
                            <li><a href="#"><span class="glyphicon glyphicon-trash"></span>Eliminar Veh&iacute;culo</a></li>
                            <li><a href="#"><span class="glyphicon glyphicon-repeat"></span>Actualizar Datos Veh&iacute;culo</a></li>
                            <li><a href="#"><span class="glyphicon glyphicon-list"></span>Listar Veh&iacute;culo</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="menu-viajes">
                    <li><a href="#"> <span class="icono izquierda glyphicon glyphicon-road"></span>
                            Viajes <span class="icono derecha glyphicon glyphicon-chevron-down"></span></a>
                        <ul>
                            <li>Nuevo Viaje</li>
                            <li><a href="#"><span class="glyphicon glyphicon-trash"></span>Eliminar Viaje</a></li>
                            <li><a href="#"><span class="glyphicon glyphicon-repeat"></span>Actualizar Datos Viaje</a></li>
                            <li><a href="#"><span class="glyphicon glyphicon-list"></span>Listar Viaje</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </aside>
        <?php $this->endBody() ?>
        <!--<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script src="web/js/jQuery.js"></script>-->

    </body>
</html>
<?php $this->endPage() ?>
