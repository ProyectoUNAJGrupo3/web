<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\TipoUsuario;
use app\models\Recepcionista\AltaViajeManualModel;
use app\models\Recepcionista\ActualizarViajeModel;
use app\models\Recepcionista\AutorizarSolicitudModel;
use app\models\Recepcionista\ListaSolicitudesServicioModel;
use app\models\Recepcionista\ListaSolicitudesOnlineModel;
use app\models\Recepcionista\AltaClienteModel;
use app\models\Recepcionista\ActualizarClienteModel;
use app\models\Recepcionista\AltaTarifaModel;
use app\models\Recepcionista\EliminarTarifaModel;
use app\models\Recepcionista\ActualizarTarifaModel;
use app\models\Recepcionista\AdministrarClienteModel;
use app\models\Recepcionista\AdministrarTarifaModel;
use yii\web\Response;
use yii\db\Query;
use yii\widgets\ActiveForm;

class RecepcionistaController extends Controller {

    public $layout = 'mainRecepcionista';                           //se asocia al layout predeterminado

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'], //solo debe aplicarse a las acciones login, logout , admin,recepcionista, chofer y cliente. Todas las demas acciones no estan sujetas al control de acceso
                'rules' => [                              //reglas
                    //el administrador tiene permisos sobre las siguientes acciones
                    ['actions' => ['index', 'alta_viaje_manual', 'actualizarviaje', 'listaviajes', 'listasolicitudes', 'autorizarsolicitud', 'clienteslist'],
                        'allow' => true,
                        'roles' => ['@'], //El arroba es para el usuario autenticado
                        'matchCallback' => function ($rule, $action) {                    //permite escribir la l?gica de comprobaci?n de acceso arbitraria, las paginas que se intentan acceder solo pueden ser permitidas si es un...
                    return TipoUsuario::usuarioRecepcionista(Yii::$app->user->identity->RolID);
                    //Llamada al m?todo que comprueba si es un administrador
                    //Retorno el metodo del modelo que comprueba el tipo de usuario que es por el rol (1,2,3,4) etc y que devuelve true o false
                }
                    ]
                ]
            ]
        ];
    }

    public function actions() {
        //Control de errores en caso de que se quiera acceder a las acciones de este controlador
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
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex() {
        return $this->redirect(['alta_viaje_manual']);
    }

    public function actionAlta_viaje_manual() {                      //renderiza el index de la carpeta agencia dentro de views
        $model = new AltaViajeManualModel();
        $model->setDataProvider();
        $model->setListChoferes();
        $model->setListVehiculos();
        $model->setTarifa();
        $info = $model->agenciaCoords();
        $canal = Yii::$app->user->identity->AgenciaID;
        if ($model->load(Yii::$app->request->post()) && ($model->registrarViaje() === true)) {
            Yii::$app->session->setFlash('viajeCreado');
            return $this->refresh();
        }
        return $this->render("altaViajeManual", ['model' => $model, 'info' => $info, 'canalAgencia' => $canal]);
    }

    public function actionActualizarviaje() {                      //renderiza el index de la carpeta agencia dentro de views
        $model = new ActualizarViajeModel();
        if (\Yii::$app->request->isPost) {
            $viajeSelected = Yii::$app->session['actualizar'];
            $model->setUpdateInfo($viajeSelected);
            if ($model->load(Yii::$app->request->post()) && ($model->actualizarViaje() === true)) {
                Yii::$app->session->setFlash('viajeActualizado', 'Viaje actualizado.');
                return $this->redirect(['listaviajes']);
            }
        } else {
            $model->setListChoferes();
            $model->setListVehiculos();
        }
        return $this->renderAjax("actualizarViaje", ['model' => $model]);
    }

    public function actionListaviajes() {                      //renderiza el index de la carpeta agencia dentro de views
        $model = new ListaSolicitudesServicioModel();
        $model->setDataProvider();
        if (\Yii::$app->request->isAjax) {
            if (\Yii::$app->request->isPost) {
                $selection = Yii::$app->request->post('keylist');
                $viajeSelected = $model->dataProvider->allModels[$selection];
                Yii::$app->session['actualizar'] = $viajeSelected; //CUANDO LA OPERACION ES ACTUALIZAR LE PASO LA SELECCION A LA OTRA VISTA (POPUP)
                switch (\Yii::$app->request->post('viajeoperacion')) { //TOMA EL VIAJEOPERACION QUE LE PASA EN EL DATA DEL AJAX
                    case 'cerrar':                                      //TOMA EL VALOR DEL VIAJEOPERACION SETEADO EN EL AJAX
                        $operacion = 3; //CERRAR
                        $model->ViajeOperacion($viajeSelected, $operacion);
                        Yii::$app->session['message'] = "Viaje cerrado correctamente"; //GUARDO EL MENSAJE FLASH Y LA OPERACION AQUI PARA UTILIZARLA ANTES DEL RENDER YA QUE DE LA FORMA NORMAL NO ME FUNCIONA EN ESTE CASO.
                        Yii::$app->session['operacion'] = "viajeCerrado";
                        break;
                    case 'cancelar':
                        $operacion = 2; //CANCELAR
                        $model->ViajeOperacion($viajeSelected, $operacion);
                        Yii::$app->session['message'] = "Viaje cancelado correctamente"; //GUARDO EL MENSAJE FLASH Y LA OPERACION AQUI PARA UTILIZARLA ANTES DEL RENDER YA QUE DE LA FORMA NORMAL NO ME FUNCIONA EN ESTE CASO.
                        Yii::$app->session['operacion'] = "viajeCancelado";
                        break;
                    case 'enviar':
                        $operacion = 0; //ENVIAR VIAJE
                        $model->ViajeOperacion($viajeSelected, $operacion);
                        Yii::$app->session['message'] = "Viaje enviado correctamente"; //GUARDO EL MENSAJE FLASH Y LA OPERACION AQUI PARA UTILIZARLA ANTES DEL RENDER YA QUE DE LA FORMA NORMAL NO ME FUNCIONA EN ESTE CASO.
                        Yii::$app->session['operacion'] = "viajeEnviado";
                        break;
                }
            }
        }
        Yii::$app->session->setFlash(Yii::$app->session['operacion'], Yii::$app->session['message']);
        return $this->render("listarSolicitudes", ['model' => $model]);
    }

    public function actionAutorizarsolicitud() {                      //renderiza el index de la carpeta agencia dentro de views
        $model = new AutorizarSolicitudModel();
        if (\Yii::$app->request->isPost) {
            $viajeSelected = Yii::$app->session['autorizar'];
            $model->setUpdateInfo($viajeSelected);
            if ($model->load(Yii::$app->request->post()) && ($model->autorizarSolicitud() === true)) {
                Yii::$app->session->setFlash('solicitudAutorizada', 'Solicitud autorizada.');
                Yii::$app->pusher->triggerEvent($viajeSelected['AgenciaID'], $viajeSelected['ClienteID'], 'Tu Remis Esta en Camino !');
                return $this->redirect(['listasolicitudes']);
            }
        } else {
            $model->setListChoferes();
            $model->setListVehiculos();
        }
        return $this->renderAjax("autorizarsolicitud", ['model' => $model]);
    }

    public function actionListasolicitudes() {
        $model = new ListaSolicitudesOnlineModel();
        $model->setDataProvider();
        if (\Yii::$app->request->isAjax) {
            if (\Yii::$app->request->isPost) {
                $selection = Yii::$app->request->post('keylist');
                $viajeSelected = $model->dataProvider->allModels[$selection];
                Yii::$app->session['autorizar'] = $viajeSelected; //CUANDO LA OPERACION ES ACTUALIZAR LE PASO LA SELECCION A LA OTRA VISTA (POPUP)
                switch (\Yii::$app->request->post('viajeoperacion')) { //TOMA EL VIAJEOPERACION QUE LE PASA EN EL DATA DEL AJAX
                    /* case 'cerrar':                                      //TOMA EL VALOR DEL VIAJEOPERACION SETEADO EN EL AJAX
                      $operacion = 3;//CERRAR
                      $model->ViajeOperacion($viajeSelected,$operacion);
                      Yii::$app->session['message'] = "Viaje cerrado correctamente"; //GUARDO EL MENSAJE FLASH Y LA OPERACION AQUI PARA UTILIZARLA ANTES DEL RENDER YA QUE DE LA FORMA NORMAL NO ME FUNCIONA EN ESTE CASO.
                      Yii::$app->session['operacion'] = "viajeCerrado";
                      break; */
                    case 'rechazar':
                        $operacion = 2; //CANCELAR
                        $model->ViajeOperacion($viajeSelected, $operacion);
                        Yii::$app->session['message'] = "Solicitud rechazada correctamente"; //GUARDO EL MENSAJE FLASH Y LA OPERACION AQUI PARA UTILIZARLA ANTES DEL RENDER YA QUE DE LA FORMA NORMAL NO ME FUNCIONA EN ESTE CASO.
                        Yii::$app->session['operacion'] = "solicitudRechazada";
                        break;
                }
            }
        }
        Yii::$app->session->setFlash(Yii::$app->session['operacion'], Yii::$app->session['message']);
        return $this->render('listaSolicitudesOnline', ['model' => $model]);
    }

    public function actionClienteslist($q = null, $id = null) {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            $query = new Query;
            $query->select(["PersonaID as id", "CONCAT(Apellido, ' ', Nombre) AS text"])
                    ->from('Personas')
                    ->where(['like', 'Apellido', $q])
                    ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        } elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => ''];
        }
        return $out;
    }

    public function actionAlta_cliente() {
        $model = new AltaClienteModel();
        if ($model->load(Yii::$app->request->post()) && ($model->altaCliente() === true)) {
            Yii::$app->session->setFlash('clienteCreado', 'Cliente creado correctamente.');
            return $this->redirect(['administrarcliente']);
        }
        else
        {
            if($model->hasErrors())
            {
                $errorMessage=$model->getErrors();
                Yii::$app->session->setFlash('agregar_ClienteError', $errorMessage['agregar_ClienteError'][0]);
                return $this->redirect(['administrarcliente']);
            }
        }
        return $this->renderAjax('altaCliente', ['model' => $model]);
    }
    public function actionActualizar_cliente() {
        $model = new ActualizarClienteModel();
        $clienteSelected = Yii::$app->session['actualizarCliente'];
        $model->setAtributos($clienteSelected);
        if ($model->load(Yii::$app->request->post()) && ($model->actualizarCliente($clienteSelected['PersonaID']) === true)) {
            Yii::$app->session->setFlash('clienteActualizado', 'Cliente actualizado correctamente.');
            return $this->redirect(['administrarcliente']);
        }
        else
        {
            if($model->hasErrors())
            {
                $errorMessage=$model->getErrors();
                Yii::$app->session->setFlash('actualizar_ClienteError', $errorMessage['actualizar_ClienteError'][0]);
                return $this->redirect(['administrarcliente']);
            }
        }
        return $this->renderAjax('actualizarCliente', ['model' => $model]);
    }

    public function actionAlta_tarifa() {
        $model = new AltaTarifaModel();
        if ($model->load(Yii::$app->request->post()) && ($model->altaTarifa() === true)) {
            Yii::$app->session->setFlash('tarifaCreada', 'Tarifa creada correctamente.');
            return $this->redirect(['administrartarifa']);
        }
        else
        {
            if($model->hasErrors())
            {
                $errorMessage=$model->getErrors();
                Yii::$app->session->setFlash('altaTarifaError', $errorMessage['altaTarifaError'][0]);
                return $this->redirect(['administrartarifa']);
            }
        }
        //$viajeSelected = Yii::$app->session['agregarTarifa'];
        return $this->renderAjax('altaTarifa', ['model' => $model]);
    }
    public function actionEliminar_tarifa() {
        $model = new EliminarTarifaModel();
        $tarifaSelected = Yii::$app->session['eliminarTarifa'];
        if ($model->load(Yii::$app->request->post()) && ($model->eliminarTarifa($tarifaSelected['TarifaID']) === true)) {
            Yii::$app->session->setFlash('tarifaEliminada', 'Tarifa eliminada correctamente.');
            return $this->redirect(['administrartarifa']);
        }
        else
        {
            if($model->hasErrors())
            {
                $errorMessage=$model->getErrors();
                Yii::$app->session->setFlash('eliminarTarifaError', $errorMessage['eliminarTarifaError'][0]);
                return $this->redirect(['administrartarifa']);
            }
        }
        return $this->render('administrarTarifa', ['model' => $model]);
    }
    public function actionActualizar_tarifa() {
        $model = new ActualizarTarifaModel();
        $tarifaSelected = Yii::$app->session['actualizarTarifa'];
        $model->setAtributos($tarifaSelected);
        if ($model->load(Yii::$app->request->post()) && ($model->actualizarTarifa($tarifaSelected['TarifaID']) === true)) {
            Yii::$app->session->setFlash('tarifaActualizada', 'Tarifa actualizada correctamente.');
            return $this->redirect(['administrartarifa']);
        }
        else
        {
            if($model->hasErrors())
            {
                $errorMessage=$model->getErrors();
                Yii::$app->session->setFlash('actualizar_TarifaError', $errorMessage['actualizar_TarifaError'][0]);
                return $this->redirect(['administrartarifa']);
            }
        }
        return $this->renderAjax('actualizarTarifa', ['model' => $model]);
    }

    public function actionAdministrarcliente() {
        $model = new AdministrarClienteModel();
        $model->setDataProvider();

        if (\Yii::$app->request->isAjax) {
            if (\Yii::$app->request->isPost) {
                $selection = Yii::$app->request->post('keylist');
                $clienteSelected = $model->dataProvider->allModels[$selection];

                switch (\Yii::$app->request->post('cliente_operacion')) { //TOMA EL VIAJEOPERACION QUE LE PASA EN EL DATA DEL AJAX
                    case 'eliminar':                                      //TOMA EL VALOR DEL VIAJEOPERACION SETEADO EN EL AJAX
                        if ($model->eliminarCliente($clienteSelected['PersonaID']) === true) {
                            Yii::$app->session->setFlash('clienteEliminado', 'Cliente eliminado correctamente.');
                            return $this->redirect(['administrarcliente']);
                        }
                        else
                        {
                            if($model->hasErrors())
                            {
                                $errorMessage=$model->getErrors();
                                Yii::$app->session->setFlash('eliminar_ClienteError', $errorMessage['eliminar_ClienteError'][0]);
                                return $this->redirect(['administrarcliente']);
                            }
                        }
                        break;
                    case 'actualizar':                                      //TOMA EL VALOR DEL VIAJEOPERACION SETEADO EN EL AJAX
                        Yii::$app->session['actualizarCliente'] = $clienteSelected;
                        break;
                }

            }
        }

        return $this->render('administrarCliente', ['model' => $model]);
    }
    public function actionAdministrartarifa() {
        $model = new AdministrarTarifaModel();
        $model->setDataProvider();
        if (\Yii::$app->request->isAjax) {
            if (\Yii::$app->request->isPost) {
                $selection = Yii::$app->request->post('keylist');
                $tarifaSelected = $model->dataProvider->allModels[$selection];

                switch (\Yii::$app->request->post('tarifa_operacion')) { //TOMA EL VIAJEOPERACION QUE LE PASA EN EL DATA DEL AJAX
                    case 'eliminar':                                      //TOMA EL VALOR DEL VIAJEOPERACION SETEADO EN EL AJAX
                        if ($model->eliminarTarifa($tarifaSelected['TarifaID']) === true) {
                            Yii::$app->session->setFlash('tarifaEliminada', 'Tarifa eliminada correctamente.');
                            return $this->redirect(['administrartarifa']);
                        }
                        else
                        {
                            if($model->hasErrors())
                            {
                                $errorMessage=$model->getErrors();
                                Yii::$app->session->setFlash('eliminarTarifaError', $errorMessage['eliminarTarifaError'][0]);
                                return $this->redirect(['administrartarifa']);
                            }
                        }
                        break;
                    case 'actualizar':                                      //TOMA EL VALOR DEL VIAJEOPERACION SETEADO EN EL AJAX
                        Yii::$app->session['actualizarTarifa'] = $tarifaSelected;
                        break;
                }

            }
        }

        return $this->render('administrarTarifa', ['model' => $model]);
    }

}
