<?php
/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
//use app\assets\AppAsset;
use app\assets\BootswatchAsset;

raoul2000\bootswatch\BootswatchAsset::$theme = 'superhero';
BootswatchAsset::register($this);

//AppAsset::register($this);
$this->title = $name;
?>
<div class="container">
    <div class="well bs-component">
        <div class="row">
            <div class="body">
                <div style="text-align: center">
                    <div style="text-align: center">
                        <p>
                        <h1 style="color: red">Warning</h1>
                        <img src="img/warning.jpg">
                        <h1 style="color: red">Acceso Denegado</h1>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
