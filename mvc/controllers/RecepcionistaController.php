<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Recepcionista\AltaViajeManualModel;
use app\models\Recepcionista\ListaSolicitudesServicioModel;

class RecepcionistaController extends Controller {

    public $layout = 'mainRecepcionista';                           //se asocia al layout predeterminado

    public function actions() {
        Yii::$app->errorHandler->errorAction = 'recepcionista/error';             //seteo la ruta de vista de error para que al llamar al ErrorAction no vaya a la del site sino a la de agencia,
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

    public function actionAlta_viaje_manual() {                      //renderiza el index de la carpeta agencia dentro de views
        $model = new AltaViajeManualModel();
        return $this->render("altaViajeManual", ['model' => $model]);
    }
    
    public function actionListar_solcitudes_servicio() {                      //renderiza el index de la carpeta agencia dentro de views
        $model = new ListaSolicitudesServicioModel();
        return $this->render("listarSolicitudes", ['model' => $model]);
    }
    
    

}
