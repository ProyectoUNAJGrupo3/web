<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);


$this->title = 'Agencia';
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
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
                'brandLabel' => '<img src="img/logo.ico" style="display:inline; margin-top: -15px; vertical-align: top; width:50px; height:50px;">&nbsp&nbsp&nbsp&nbsp<b styel="size:15px">Agencia</b>',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            ;
            echo Nav::widget([
                //'options' => ['class' => 'navbar-nav navbar-right'],
                'options' => ['class' => 'nav-pills navbar-right'],
                'items' => [
                    ['label' => 'Home', 'url' => ['/agencia/index']],
                    [
                        'label' => 'Choferes',
                        'items' => [
                            ['label' => 'Nuevo', 'url' => ['/agencia/alta_chofer_agencia']],
                            '<li class="divider"></li>',
                            ['label' => 'Listar Todos', 'url' => ['/agencia/listar_choferes_agencia'], 'data-toggle' => 'dropdown', 'class' => 'dropdown-toggle'],
                        ],
                    ],
                    //['label' => 'Choferes', 'data-toggle' => 'dropdown', 'class' => 'dropdown-toggle', 'items' => [
                    //DatePicker
                    //['label' => 'Actualizar', 'url' => ['/agencia/actualizar_chofer_agencia']],
                    //],],
                    //['label' => 'Telefonistas', 'items' => [
                    [
                        'label' => 'Telefonistas',
                        'items' => [
                            ['label' => 'Nuevo', 'url' => ['/agencia/alta_telefonista_agencia'], 'class' => 'dropdown-toggle'],
                            '<li class="divider"></li>',
                            ['label' => 'Listar Todos', 'url' => ['/agencia/listar_recepcionistas_agencia'], 'data-toggle' => 'dropdown', 'class' => 'dropdown-toggle'],
                        ],
                    ],
                    //DatePicker                            
                    //['label' => 'Actualizar', 'url' => ['/agencia/actualizar_recepcionista_agencia']],
                    //],],
                    [
                        'label' => 'Vehiculos',
                        'items' => [
                            ['label' => 'Nuevo', 'url' => ['/agencia/alta_vehiculo_agencia'], 'class' => 'dropdown-toggle'],
                            '<li class="divider"></li>',
                            ['label' => 'Actualizar', 'url' => ['/agencia/actualizar_vehiculo_agencia'], 'class' => 'dropdown-toggle'],
                            '<li class="divider"></li>',
                            ['label' => 'Listar Todos', 'url' => ['/agencia/listar_vehiculo_agencia'], 'data-toggle' => 'dropdown', 'class' => 'dropdown-toggle'],
                        ],
                    ],
                    [
                        'label' => 'Viajes',
                        'items' => [
                            ['label' => 'Listar Turno Mañana', 'url' => ['/agencia/listar_viajes_turno_maniana_agencia'], 'style' => 'background-color:blue;', 'class' => 'dropdown-toggle'],
                            '<li class="divider"></li>',
                            ['label' => 'Listar Turno Tarde', 'url' => ['/agencia/listar_viajes_turno_tarde_agencia'], 'style' => 'background-color:blue;', 'class' => 'dropdown-toggle'],
                            '<li class="divider"></li>',
                            ['label' => 'Listar Turno Noche', 'url' => ['/agencia/listar_viajes_turno_noche_agencia'], 'style' => 'background-color:blue;', 'class' => 'dropdown-toggle'],
                            '<li class="divider"></li>',
                            ['label' => 'Listar Todos', 'url' => ['/agencia/listar_viajes_totales_agencia'], 'data-toggle' => 'dropdown', 'class' => 'dropdown-toggle'],
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


            <div class="container">
                <?=
                Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ])
                ?>
                <?= $content ?>
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <!--<hr style="border:1px solid gray;">-->
                <span id="footer-copy-right" style="text-align:center">Derechos Reservado &copy 2016</span>
            </div>
        </footer>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
