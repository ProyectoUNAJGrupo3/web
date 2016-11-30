<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use app\assets\BootswatchAsset;
use app\assets\AppAssetPopups;
use yii\bootstrap\Modal;

raoul2000\bootswatch\BootswatchAsset::$theme = 'superhero';
BootswatchAsset::register($this);
AppAssetPopups::register($this);
$this->title = 'Quiénes Somos';

Modal::begin([
    'id' => 'modal',
    //'size' => 'modal-lg',
]);
echo "<div id='modalContent'></div>";
Modal::end();
?>
<div class="container">
    <div class="well bs-component" style='color: white; text-align: justify;'>
        <h3>Nuestra Empresa</h3>
        <ul id="lista-empresa">
            <li> En Remis Ya! nos dedicamos plenamente a mejorar nuestro desempeño para poder ofrecer un producto de competencia, no s&oacute;lo en el aspecto tecnol&oacute;gico, sino tambi&eacute;n en lo profesional, y as&iacute;, destacarnos como una empresa desarrolldora de Software de Gestin l&iacute;der en Argentina.  </li>
        </ul>
        <h3>Nuestra Misi&oacute;n</h3>
        <ul id="lista-mision">
            <li>
                Desarrollar Software de Gesti&oacute;n Para Remiserias basado en las necesidades crecientes de los usuarios de remises como de empresarios del Rubro, utilizando para ello las mejores tecnolog&iacute;as disponibles.

                En Remis Ya! consideramos que el Software de Gesti&oacute;n para remiserias se ha vuelto fundamental para la gesti&oacute;n y el control de operaciones de negocio del remis de todo tipo; desde los emprendimientos pequeños a mediana escala y para clientes finales que desean encontrar un servicio eficiente y seguro.

                En este contexto la adaptabilidad, la escalabilidad, la eficiencia y la usabilidad de nuestro producto implica que las empresas usuarias sean m&aacute;s competitivas.

                Utilizamos lo mejor de la tecnolog&iacute;a disponible, tanto en el mundo comercial como en el &aacute;mbito acad&eacute;mico para hacer productos de software est&aacute;ndar que se adapten al servicio del rem&iacute;s. El mismo va a ser ergon&oacute;micos, aut&oacute;nomos como sea posible. A su vez es muy importante que el manejo del producto sea simple de aprender tanto por el usuario, como por el administrador y los mismos empleados de la agencia.
            </li>
        </ul>
        <h3>Otros Servicios</h3>
        <ul id="Servicios">
            <li>
                Conectar a las usuarios con la agencias de remiser&iacute;a con el objetivo facilitar la prestaci&oacute;n del servicio sin necesidad de un c&oacute;digo para cada agencia.</p>
            </li>

            <li>

                Hacer que el servicio solicitado sea el mejor posible por medio de la calificaci&oacute;n dell mismo por parte de los usuario.
            </li>
            <li>
                Brindarle a las agencias que prestan el servicio la posiblidad de aceptar o rechazar de la solicitud.
            </li>
            <li>
                Permitirle a los usuario, basando en la calificaciones de la agencias, contra el servicio que mejor.
            </li>
        </ul>


        <h3>Nuestro Equipo</h3>
        <ul id="lista-plantel">
            <h4>Nelson Galdeman </h4>
            <h4>Marcelo Mansilla </h4>
            <h4>Ignacio Morales</h4>
            <h4>Alejandro Ezequiel Mendez </h4>
            <h4>Aldo Rodriguez </h4>
            <h4>Sebastian Encina </h4>
            <h4>Lilian Silva</h4>
            <h4>Bruno Vitucci </h4>
            <h4>Federico Lozada</h4>


        </ul>
    </div>
</div>
