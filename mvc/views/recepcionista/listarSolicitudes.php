<?php

use yii\helpers\BaseHtml;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\AppAssetRecepcionista;
use app\assets\AppAsset;
AppAsset::register($this);
AppAssetRecepcionista::register($this);
?>

<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDMVbdR-TGis783bW9rB9tZUJXVXsIRzkQ&libraries=places"></script>
<div class="site-contact">
    <section id="main">
        <article>
            <div id="page-single-main-recepcionista">
                <br />
                <h1 id="title-form-recepcionista">
                    <strong>Solicitudes de Servicio</strong>
                </h1>
                <!--<div class="container-form" id="contenedor-formulario-listar-solicitudes-desde-recepcionista">-->
                <h1>
                    <?= Html::encode($this->title) ?>
                </h1>

                <?php if (Yii::$app->session->hasFlash('Usuario creado con exito')): ?>
                    <div class="alert alert-success">
                        Thank you for contacting us. We will respond to you as soon as possible.
                    </div>
                    <p>
                        Note that if you turn on the Yii debugger, you should be able
                        to view the mail message on the mail panel of the debugger.
                        <?php if (Yii::$app->mailer->useFileTransport): ?>
                            Because the application is in development mode, the email is not sent but saved as
                            a file under
                            <code>
                                <?= Yii::getAlias(Yii::$app->mailer->fileTransportPath) ?>
                            </code>.
                            Please configure the
                            <code>useFileTransport</code>property of the
                            <code>mail</code>
                            application component to be false to enable email sending.
                        <?php endif; ?>
                    </p>
                <?php else: ?>
                    <div>
                        <h1>Ac&aacute; colocamos la grilla para listar las solicitudes</h1>

                        <table class="table table-striped table-hover ">
                            <thead>
                                <tr>
                                    <th>Solicitud</th>
                                    <th>Nombre Usuario</th>
                                    <th>Origen</th>
                                    <th>Destino</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="info">
                                    <td>1</td>
                                    <td>Column content</td>
                                    <td>Column content</td>
                                    <td>Column content</td>
                                </tr>
                                <tr class="info">
                                    <td>2</td>
                                    <td>Column content</td>
                                    <td>Column content</td>
                                    <td>Column content</td>
                                </tr>
                                <tr class="info">
                                    <td>3</td>
                                    <td>Column content</td>
                                    <td>Column content</td>
                                    <td>Column content</td>
                                </tr>
                                <tr class="info">
                                    <td>4</td>
                                    <td>Column content</td>
                                    <td>Column content</td>
                                    <td>Column content</td>
                                </tr>
                                <tr class="info">
                                    <td>5</td>
                                    <td>Column content</td>
                                    <td>Column content</td>
                                    <td>Column content</td>
                                </tr>
                                <tr class="info">
                                    <td>6</td>
                                    <td>Column content</td>
                                    <td>Column content</td>
                                    <td>Column content</td>
                                </tr>
                                <tr class="info">
                                    <td>7</td>
                                    <td>Column content</td>
                                    <td>Column content</td>
                                    <td>Column content</td>
                                </tr>
                            </tbody>
                        </table> 
                    </div>
                    <div id="botones-grupo-ver-datos-solicitud">
                        <button type="button" class="btn btn-primary btn-lg" id="btn-ver-solicitud">Ver</button>
                        <button type="button" class="btn btn-primary btn-lg" id="btn-rechazar-solicitud">Rechazar</button>
                        <button type="button" class="btn btn-primary btn-lg" id="btn-aceptar-solicitud">Aceptar</button>
                    </div>
                <?php endif; ?>
                <!--</div>  -->
        </article>
    </section>
</div>