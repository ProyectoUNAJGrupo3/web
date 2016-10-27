
<!--

VISTA CORRESPONDIENTE A LA AGENCIA (ADMINISTRADOR)

ESTA ES LA VISTA PRINCIPAL DESDE LA CUAL SE VA A PODER HACER

ABM Y  LISTAR DE CHOFER, RECEPCIONISTA Y VECHÍCULO

ESTA ARMADO EL MENU EN LA BARRA SUPERIOR

"ESTE SERÍA EL LAYOUT DE AGENCIA"
-->





<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Dropdown;
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

        <div class="dropdown dropdown-toggle glyphicon-chevron-down">
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
            echo Nav::widget([//'zii.widgets.CMenu', [
                'class' => 'dropdown',
                'options' => ['class' => 'navbar-nav navbar-right'],
                //'activeCssClass' => 'active',
                //'activateParents' => true,
                'items' => [
                    ['label' => 'Home', 'url' => ['#']],
                    ['label' => 'Choferes', 'id' => 'lblChoferCH', 'data-toggle' => 'dropdown', 'class' => 'dropdown-toggle', 'items' => [
                            ['label' => 'Nuevo', 'id' => 'lblNuevoCH', 'url' => ['#']],
                            ['label' => 'Actualizar', 'id' => 'lblActCH', 'url' => ['recepcionista/actualizarRecepcionista']],
                            ['label' => 'Eliminar', 'id' => 'lblEliCH', 'url' => ['#'], 'data-toggle' => 'dropdown', 'class' => 'dropdown-toggle'],
                            ['label' => 'Listar Todos', 'id' => 'lblListAllCH', 'url' => ['#'], 'data-toggle' => 'dropdown', 'class' => 'dropdown-toggle'],
                        ],],
                    ['label' => 'Recepcionista', 'items' => [
                            ['label' => 'Nuevo', 'url' => ['#'], 'data-toggle' => 'dropdown', 'class' => 'dropdown-toggle'],
                            ['label' => 'Actualizar', 'url' => ['#'], 'data-toggle' => 'dropdown', 'class' => 'dropdown-toggle'],
                            ['label' => 'Eliminar', 'url' => ['#'], 'data-toggle' => 'dropdown', 'class' => 'dropdown-toggle'],
                            ['label' => 'Listar Todos', 'url' => ['#'], 'data-toggle' => 'dropdown', 'class' => 'dropdown-toggle'],
                        ],],
                    ['label' => 'Vehiculos', 'items' => [
                            ['label' => 'Nuevo', 'url' => ['#'], 'data-toggle' => 'dropdown', 'class' => 'dropdown-toggle'],
                            ['label' => 'Actualizar', 'url' => ['#'], 'data-toggle' => 'dropdown', 'class' => 'dropdown-toggle'],
                            ['label' => 'Eliminar', 'url' => ['#'], 'data-toggle' => 'dropdown', 'class' => 'dropdown-toggle'],
                            ['label' => 'Listar Todos', 'url' => ['#'], 'data-toggle' => 'dropdown', 'class' => 'dropdown-toggle'],
                        ],],
                    ['label' => 'Viajes', 'items' => [
                            ['label' => 'Listar Turno Mañana', 'url' => ['#'], 'data-toggle' => 'dropdown', 'class' => 'dropdown-toggle'],
                            ['label' => 'Listar Turno Tarde', 'url' => ['#'], 'data-toggle' => 'dropdown', 'class' => 'dropdown-toggle'],
                            ['label' => 'Listar Turno Noche', 'url' => ['#'], 'data-toggle' => 'dropdown', 'class' => 'dropdown-toggle'],
                            ['label' => 'Listar Todos', 'url' => ['#'], 'data-toggle' => 'dropdown', 'class' => 'dropdown-toggle'],
                        ],],
                    Yii::$app->user->isGuest ? (
                            //['label' => 'Login', 'url' => ['/site/login'], 'id'=>'btn-login','onClick()'=>'abrirLoginDesdeBotonLoginHeader()']
                            ['label' => 'Login',]// 'url' => ['/site/login']]
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

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
