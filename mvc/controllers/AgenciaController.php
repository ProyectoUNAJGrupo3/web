<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
//************actualizar***************
use app\models\Agencia\ActualizarChoferModel;
use app\models\Agencia\PSActualizacionDatosRecepcionistaModel;
use app\models\Agencia\ActualizarVehiculoAgenciaModel;
//************alta***************
use app\models\Agencia\AltaVehiculoAgenciaModel;
use app\models\Agencia\AltaRecepcionistaAgenciaModel;
use app\models\Agencia\AltaChoferAgenciaModel;
//************listar***************
use app\models\Agencia\ListaChoferesModel;
use app\models\Agencia\ListaRecepcionistasModel;
use app\models\Agencia\ListaVehiculoModel;
use app\models\Agencia\ListaViajesTurnoManianaModel;
use app\models\Agencia\ListaViajesTurnoTardeModel;
use app\models\Agencia\ListaViajesTurnoNocheModel;
use app\models\Agencia\ListaViajesTotalesModel;      

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

    //*************************************************************************//
    //******************************Alta**************************************//

    public function actionAlta_vehiculo_agencia() {
        $model = new AltaVehiculoAgenciaModel();
        return $this->render("altaVehiculo", ['model' => $model]);
    }

    public function actionAlta_chofer_agencia() {
        $model = new AltaChoferAgenciaModel();
        return $this->render("altaChofer", ['model' => $model]);
    }

    public function actionAlta_telefonista_agencia() {
        $model = new AltaRecepcionistaAgenciaModel();
        return $this->render("altaTelefonista", ['model' => $model]);
    }

    //**************************************************************************//
    //******************************Actualizacion**************************************//

    public function actionActualizar_vehiculo_agencia() {
        $model = new ActualizarVehiculoAgenciaModel();
        return $this->render("actualizarVehiculo", ['model' => $model]);
    }

    /* Date Picker
     * public function actionActualizar_chofer_agencia() {
      $model = new ActualizarChoferModel();
      return $this->render("PSActualizacionDatosChofer", ['model' => $model]);
      } */

    /* DatePicker
     * public function actionActualizar_recepcionista_agencia() {
      $model = new PSActualizacionDatosRecepcionistaModel();
      return $this->render("PSActualizacionDatosRecepcionista", ['model' => $model]);
      } */

    //**************************************************************************//
    //******************************Listar**************************************//

    public function actionListar_choferes_agencia() {
        $model = new ListaChoferesModel();
        return $this->render("listaChoferes", ['model' => $model]);
    }

    public function actionListar_recepcionistas_agencia() {
        $model = new ListaRecepcionistasModel();
        return $this->render("listaRecepcionistas", ['model' => $model]);
    }

    public function actionListar_vehiculo_agencia() {
        $model = new ListaVehiculoModel();
        return $this->render("listaVehiculos", ['model' => $model]);
    }

    public function actionListar_viajes_turno_maniana_agencia() {
        $model = new ListaViajesTurnoManianaModel();
        return $this->render("listaViajesTurnoManiana", ['model' => $model]);
    }

    public function actionListar_viajes_turno_tarde_agencia() {
        $model = new ListaViajesTurnoTardeModel();
        return $this->render("listaViajesTurnoTarde", ['model' => $model]);
    }

    public function actionListar_viajes_turno_noche_agencia() {
        $model = new ListaViajesTurnoNocheModel();
        return $this->render("listaViajesTurnoNoche", ['model' => $model]);
    }

    public function actionListar_viajes_totales_agencia() {
        $model = new ListaViajesTotalesModel();
        return $this->render("listaViajesTotales", ['model' => $model]);
    }

}
