<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\TipoUsuario;
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

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'alta_vehiculo_agencia', 'actualizar_vehiculo_agencia', 'nuevo_chofer_agencia', 'nuevo_telefonista_agencia'], //solo debe aplicarse a las acciones login, logout , admin,recepcionista, chofer y cliente. Todas las demas acciones no estan sujetas al control de acceso
                'rules' => [                              //reglas
                        //el administrador tiene permisos sobre las siguientes acciones
                        ['actions' => ['index', 'alta_vehiculo_agencia', 'actualizar_vehiculo_agencia', 'nuevo_chofer_agencia', 'nuevo_telefonista_agencia'],
                        'allow' => true,
                        'roles' => ['@'], //El arroba es para el usuario autenticado
                        'matchCallback' => function ($rule, $action) {                    //permite escribir la l?gica de comprobaci?n de acceso arbitraria, las paginas que se intentan acceder solo pueden ser permitidas si es un...
                            return TipoUsuario::usuarioAdministrador(Yii::$app->user->identity->RolID);
                            //Llamada al m?todo que comprueba si es un administrador
                            //Retorno el metodo del modelo que comprueba el tipo de usuario que es por el rol (1,2,3,4) etc y que devuelve true o false
                        }
                                               ]
                    ]
                ]
             ];
    }

    public function actions() {

        if (!Yii::$app->user->isGuest) {                                                                              //si el usuario esta logeado, o sea no es invitado

            if (Yii::$app->user->identity->RolID==1) {                                                                //si el usuario es administrador
                Yii::$app->errorHandler->errorAction = 'agencia/error';                                               //se muestra la pantalla de error de agencia y su respectivo layout

            } elseif (Yii::$app->user->identity->RolID==2) {
                Yii::$app->errorHandler->errorAction = 'recepcionista/error';

            } elseif (Yii::$app->user->identity->RolID==3) {
                Yii::$app->errorHandler->errorAction = 'chofer/error';

            } elseif (Yii::$app->user->identity->RolID==4) {
                Yii::$app->errorHandler->errorAction = 'cliente/error';

            } else {
                Yii::$app->errorHandler->errorAction = 'site/error';
            }
        }else{                                                                                                      //sino (si el usuario es invitado) se muestra la pagina de error del site
            Yii::$app->errorHandler->errorAction = 'site/error';
        }
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
        if ($model->load(Yii::$app->request->post()) && ($model->registrarchofer() === true)) {
            Yii::$app->session->setFlash('Empleado creado con exito');

        }
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
