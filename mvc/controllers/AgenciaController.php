<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\PSFormularioAltaVehiculoModel;
use app\models\PSFormularioActualizacionVehiculoModel;
use app\models\PSFormularioNuevoEmpleadoModel;
use app\models\PSFormularioNuevoTelefonistaModel;

class AgenciaController extends Controller {

    public $layout = 'mainAgencia';                           //se asocia al layout predeterminado

    public function actions() {                                 //Errores todavia no solucionado
        Yii::$app->errorHandler->errorAction = 'agencia/error';             //seteo la ruta de vista de error para que al llamar al ErrorAction no vaya a la del site sino a la de agencia,
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

    public function actionAlta_vehiculo_agencia() {
        $model = new PSFormularioAltaVehiculoModel();
        return $this->render("altaVehiculo", ['model' => $model]);
    }

    public function actionActualizar_vehiculo_agencia() {
        $model = new PSFormularioActualizacionVehiculoModel();
        return $this->render("actualizarVehiculo", ['model' => $model]);
    }

    public function actionNuevo_chofer_agencia() {
        $model = new PSFormularioNuevoEmpleadoModel();
        return $this->render("altaChofer", ['model' => $model]);
    }

    public function actionNuevo_telefonista_agencia() {
        $model = new PSFormularioNuevoTelefonistaModel();
        return $this->render("altaTelefonista", ['model' => $model]);
    }

}
