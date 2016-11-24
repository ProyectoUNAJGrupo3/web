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

$this->title = 'Chofer';
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
                'brandLabel' => '<img src="img/LogoApp.png" style="display:inline; margin-top: -20px; vertical-align: top; width:120px; height:55px;">&nbsp&nbsp&nbsp&nbsp<b styel="size:15px">Chofer</b>',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            ;
            echo Nav::widget([
                'encodeLabels' => false,
                'options' => ['class' => 'nav-pills navbar-right'],
                'items' => [
                    [ 'label' => '<span class="fa fa-suitcase" ></span>' . Html::encode(' Viajes'), 'url' => ['/chofer/index']],
                    //[ 'label' => '<span class="fa fa-suitcase" ></span>' . Html::encode(' Calificar Conducta Usuario'), 'url' => ['/chofer/calificar_conducta_usuario']],
                    [
                        'label' => '<span class="fa fa-star" ></span>' . Html::encode(' Calificaciones'), 'url' => ['#'],
                        'items' => [
                            ['label' => '<span class="fa fa-list" ></span>' . Html::encode(' Administrar'), 'url' => ['/chofer/listar_historial_calificaciones'], 'data-toggle' => 'dropdown', 'class' => 'dropdown-toggle'],
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
