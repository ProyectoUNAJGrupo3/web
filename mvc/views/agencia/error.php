<?php
/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use app\assets\AppAsset;
use app\assets\AppAssetAgencia;

AppAssetAgencia::register($this);
AppAsset::register($this);
$this->title = $name;
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
    <div class="body">
        <div id="contenedor">
            <div id="cartel"><p>
                <h1 id="warning">Warning</h1>
                <img src="img/warning.jpg">
                <h1 id="acceso-denegado">Acceso Denegado</h1>
                </p>
                <h2><b>A Desarrollar</b></h2>
            </div>
        </div>
    </div>
</p>

</div>
