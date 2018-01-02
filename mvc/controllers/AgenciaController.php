<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\TipoUsuario;
//************actualizar***************
use app\models\Agencia\ActualizarChoferModel;
use app\models\Agencia\ActualizarRecepcionistaModel;
use app\models\Agencia\ActualizarVehiculoAgenciaModel;
//use app\models\Agencia\ActualizarVehiculoAgenciaModel;
//use app\models\Agencia\ActualizarVehiculoAgenciaModel;
//************alta***************
use app\models\Agencia\AltaVehiculoAgenciaModel;
use app\models\Agencia\AltaRecepcionistaAgenciaModel;
use app\models\Agencia\AltaChoferAgenciaModel;
//************listar***************
use app\models\Agencia\ListaChoferesModel;
use app\models\Agencia\ListaRecepcionistasModel;
use app\models\Agencia\ListaVehiculoModel;
use app\models\Agencia\ListaViajesTurnoManianaModel;
use app\models\Agencia\ListadoCalificacionesModel;
use app\models\Agencia\ListadoViajesModel;
use app\models\Agencia\ViajesGridModel;
use app\models\Agencia\GridModel;

class AgenciaController extends Controller {

    public $layout = 'mainAgencia';                           //se asocia al layout predeterminado

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'alta_vehiculo_agencia','alta_vehiculo_agencia', 'alta_chofer_agencia', 'alta_telefonista_agencia', 'actualizar_vehiculo_agencia','actualizar_chofer_agencia','actualizar_recepcionista_agencia','listar_choferes_agencia','listar_recepcionistas_agencia','listar_vehiculo_agencia','listado_calificaciones','listado_viajes'], //solo debe aplicarse a las acciones login, logout , admin,recepcionista, chofer y cliente. Todas las demas acciones no estan sujetas al control de acceso
                'rules' => [                              //reglas
                    //el administrador tiene permisos sobre las siguientes acciones
                    ['actions' => ['index', 'alta_vehiculo_agencia','alta_vehiculo_agencia', 'alta_chofer_agencia', 'alta_telefonista_agencia', 'actualizar_vehiculo_agencia','actualizar_chofer_agencia','actualizar_recepcionista_agencia','listar_choferes_agencia','listar_recepcionistas_agencia','listar_vehiculo_agencia','listado_calificaciones','listado_viajes'],
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
            if (Yii::$app->user->identity->RolID == 1) {                                                                //si el usuario es administrador
                Yii::$app->errorHandler->errorAction = 'agencia/error';                                               //se muestra la pantalla de error de agencia y su respectivo layout
            } elseif (Yii::$app->user->identity->RolID == 2) {
                Yii::$app->errorHandler->errorAction = 'recepcionista/error';
            } elseif (Yii::$app->user->identity->RolID == 3) {
                Yii::$app->errorHandler->errorAction = 'chofer/error';
            } elseif (Yii::$app->user->identity->RolID == 4) {
                Yii::$app->errorHandler->errorAction = 'cliente/error';
            } else {
                Yii::$app->errorHandler->errorAction = 'site/error';
            }
        } else {                                                                                                      //sino (si el usuario es invitado) se muestra la pagina de error del site
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
        if ($model->load(Yii::$app->request->post()) && ($model->registrarvehiculo() === true)) {
            Yii::$app->session->setFlash('vehiculo creado con exito');
            return $this->redirect(['agencia/listar_vehiculo_agencia']);
        }
        return $this->renderAjax("altaVehiculo", ['model' => $model]);
    }

    public function actionAlta_chofer_agencia() {
        $model = new AltaChoferAgenciaModel();
        if ($model->load(Yii::$app->request->post()) && ($model->registrarchofer() === true)) {
            Yii::$app->session->setFlash('Chofer creado con exito');
            return $this->redirect(['agencia/listar_choferes_agencia']);
        }
        return $this->renderAjax("altaChofer", ['model' => $model]);
    }

    public function actionAlta_telefonista_agencia() {
        $model = new AltaRecepcionistaAgenciaModel();
        if ($model->load(Yii::$app->request->post()) && ($model->registrarrecepcionista() === true)) {
            Yii::$app->session->setFlash('Recepcionista creado con exito');
            return $this->redirect(['agencia/listar_recepcionistas_agencia']);
        }
        return $this->renderAjax("altaTelefonista", ['model' => $model]);
    }

    //**************************************************************************//
    //******************************Actualizacion**************************************//

    public function actionActualizar_vehiculo_agencia() {
        if (isset(Yii::$app->session['actualizar'])) {
            $param = Yii::$app->session['actualizar'];
        }
        else {
            $param = null;
        }

        $model = new ActualizarVehiculoAgenciaModel();
        if ($model->load(Yii::$app->request->post()) && ($model->modificarvehiculo($param['VehiculoID']) === true)) {
            Yii::$app->session->setFlash('Vehiculo actualizado con exito');
            return $this->redirect(['agencia/listar_vehiculo_agencia']);
        }
        $model->setvehiculo($param);
        return $this->renderAjax("actualizarVehiculo", ['model' => $model]);
    }

    public function actionActualizar_chofer_agencia() {
        if (isset(Yii::$app->session['actualizar'])) {
            $param = Yii::$app->session['actualizar'];
        }
        else {
            $param = null;
        }
        $model = new ActualizarChoferModel();

        if ($model->load(Yii::$app->request->post()) && ($model->modificarchofer($param['PersonaID']) === true)) {
            Yii::$app->session->setFlash('Chofer actualizado con exito');
            return $this->redirect(['agencia/listar_choferes_agencia']);
        }
        $model->setchofer($param);
        return $this->renderAjax("actualizarChofer", ['model' => $model]);
    }

    public function actionActualizar_recepcionista_agencia() {
        if (isset(Yii::$app->session['actualizar'])) {
            $param = Yii::$app->session['actualizar'];
        }
        else {
            $param = null;
        }
        $model = new ActualizarRecepcionistaModel();
        if ($model->load(Yii::$app->request->post()) && ($model->modificarrecepcionista($param['PersonaID']) === true)) {
            Yii::$app->session->setFlash('Recepcionista actualizado con exito');
            return $this->redirect(['agencia/listar_recepcionistas_agencia']);
        }
        $model->setrecepcionista($param);
        return $this->render("actualizarRecepcionista", ['model' => $model]);
    }
    //**************************************************************************//
    //******************************Listar**************************************//

    public function actionListar_choferes_agencia() {
        $model = new GridModel();
        $model->setDataProviderChofer();
        if (\Yii::$app->request->isPost)  {
            if (\Yii::$app->request->isAjax) {
            switch (\Yii::$app->request->post('operaciones')){
                case 'actualizar':
                $selection=(array)Yii::$app->request->post('keylist');
                $personaselected=$model->dataProvider->allModels[$selection[0]];
                Yii::$app->session['actualizar'] = $personaselected;
                break;

                case 'eliminar':
                $selection =(array)Yii::$app->request->post('keylist');
                $personaSelected = $model->dataProvider->allModels[$selection[0]];
                $model->eliminarEmpleado($personaSelected);
                Yii::$app->session->setFlash('Chofer eliminado con exito');
                return $this->refresh();
            }
          }
        }
        return $this->render("listaChoferes", ['model' => $model]);
    }

    public function actionListar_recepcionistas_agencia() {
        $model = new GridModel();
        $model->setDataProviderrecepcionista();
        if (\Yii::$app->request->isPost)  {
            if (\Yii::$app->request->isAjax) {
                switch (\Yii::$app->request->post('operaciones')){
                    case 'actualizar':
                        $selection=(array)Yii::$app->request->post('keylist');
                        $personaselected=$model->dataProvider->allModels[$selection[0]];
                        Yii::$app->session['actualizar'] = $personaselected;
                        break;

                    case 'eliminar':
                        $selection =(array)Yii::$app->request->post('selection');
                        $personaSelected = $model->dataProvider->allModels[$selection[0]];
                        $model->eliminarEmpleado($personaSelected);
                        Yii::$app->session->setFlash('Recepcionista eliminado con exito');
                        return $this->refresh();
                }
            }
        }
        return $this->render("listaRecepcionistas", ['model' => $model]);
    }

    public function actionListar_vehiculo_agencia() {
        $model = new GridModel();
        $model->setDataProvidervehiculo();
        if (\Yii::$app->request->isPost)  {
            if (\Yii::$app->request->isAjax) {
                switch (\Yii::$app->request->post('operaciones')){
                    case 'actualizar':
                        $selection=(array)Yii::$app->request->post('keylist');
                        $personaselected=$model->dataProvider->allModels[$selection[0]];
                        Yii::$app->session['actualizar'] = $personaselected;
                        break;

                    case 'eliminar':
                        $selection=(array)Yii::$app->request->post('keylist');
                        $personaselected=$model->dataProvider->allModels[$selection[0]];
                        $model->eliminarvehiculo($personaselected['VehiculoID']);
                        Yii::$app->session->setFlash('Vehiculo eliminado con exito');
                        return $this->refresh();
                }
            }
        }
        return $this->render("listaVehiculos", ['model' => $model]);
    }

 //   public function actionListar_viajes_turno_maniana_agencia() {
 //       $model = new ListaViajesTurnoManianaModel();
 //       return $this->render("listaViajesTurnoManiana", ['model' => $model]);
 //   }

    public function actionListado_calificaciones() {
        $model = new ListadoCalificacionesModel();
        $model->setDataProvider();
        return $this->render("listadoCalificaciones", ['model' => $model]);
    }

    public function actionListado_viajes() {
        $model = new ViajesGridModel();
        $model->setDataProvider();
        return $this->render("listadoViajes", ['model' => $model]);
    }
/*    public function actionListar_viajes_totales_agencia() {

        $model = new ViajesGridModel();
        $model->setDataProvider();
        $model->setListChoferes();
        $model->setListVehiculos();
        if ($model->load(Yii::$app->request->post()) && ($model->registrarViaje() === true)) {
            Yii::$app->session->setFlash('Viaje creado con exito');
        }
        return $this->render("listaViajesTotales", ['model' => $model]);
    }

//    public function actionGetTarifa() {
//        $model = new ViajesGridModel();
//        $model->setDataProvider();
//        return $this->render("listaViajesTotales", ['model' => $model]);
//    }
*/
}
