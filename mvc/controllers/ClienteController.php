<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Usuario\PSFormularioSolicitudRegistrarAgenciaModel;
use app\models\Usuario\PSFormularioSolicitarServcioRemiseriaModel;
use app\models\Usuario\ListaHistorialViajesUsuarioModel;
use app\models\Usuario\ListaHistorialCalificacionesUsuarioModel;

class ClienteController extends Controller {

    public $layout = 'mainCliente';                           //se asocia al layout predeterminado

    public function actions() {
        Yii::$app->errorHandler->errorAction = 'cliente/error';             //seteo la ruta de vista de error para que al llamar al ErrorAction no vaya a la del site sino a la de agencia,
        //la ruta ya esta harcodeada en config/web en la parte errorHandler
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex() {                      //renderiza el index de la carpeta agencia dentro de views
        return $this->render('index');
    }

    public function actionSolicitud_registrar_agencia() {
        $model = new PSFormularioSolicitudRegistrarAgenciaModel();
        return $this->render("solicitudRegistrarAgencia", ['model' => $model]);
    }

    public function actionSolicitar_servicio_remis() {
        $model = new PSFormularioSolicitarServcioRemiseriaModel();
        return $this->render("solicitudPedirServicioRemiseria", ['model' => $model]);
    }

    public function actionListar_hisrotial_viajes() {
        $model = new ListaHistorialViajesUsuarioModel();
        return $this->render("listaHistorialViajes", ['model' => $model]);
    }

    public function actionListar_historial_calificaciones() {
        $model = new ListaHistorialCalificacionesUsuarioModel();
        return $this->render("listaHistorialCalificaciones", ['model' => $model]);
    }

}
