<?php

use yii\helpers\BaseHtml;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\PSCssAsset;
use yii\grid\GridView;

PSCssAsset::register($this);


?>
<!--<div class="container">
    <section id="main">
        <article>
            <div id="page-single-main">-->
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDMVbdR-TGis783bW9rB9tZUJXVXsIRzkQ&libraries=places"></script>
<div class="site-contact">
    <?= GridView::widget([
'dataProvider' => $model->dataProvider,
'columns' => [
        'ClienteNombre',
        'OrigenDireccion',
        'DestinoDireccion',
        'ChoferNombre',
        'VehiculoMarca',
        'VehiculoModelo',
        'FechaSalida',
        'ImporteTotal',
        'Distancia',
        'ViajeTipo',
        'Estado',

    ],]); ?>

</div>