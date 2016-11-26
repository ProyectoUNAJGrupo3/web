<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Chofer\CalificacionUsuarioModel;
use app\models\Chofer\HistorialViajesModel;
use app\models\Chofer\HistorialCalificacionesModel;
use app\models\TipoUsuario;

class ChoferController extends Controller {

    public $layout = 'mainChofer';                           //se asocia al layout predeterminado

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'], //solo debe aplicarse a las acciones login, logout , admin,recepcionista, chofer y cliente. Todas las demas acciones no estan sujetas al control de acceso
                'rules' => [                              //reglas
                    //el administrador tiene permisos sobre las siguientes acciones
                    ['actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'], //El arroba es para el usuario autenticado
                        'matchCallback' => function ($rule, $action) {                    //permite escribir la l?gica de comprobaci?n de acceso arbitraria, las paginas que se intentan acceder solo pueden ser permitidas si es un...
                    return TipoUsuario::usuarioChofer(Yii::$app->user->identity->RolID);
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
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex() {                      //renderiza el index de la carpeta agencia dentro de views
        $model = new HistorialViajesModel();
        return $this->render('index', ['model' => $model]);
        //return $this->render('index');
    }

    public function actionListar_historial_viajes() {                      //renderiza el index de la carpeta agencia dentro de views
        $model = new HistorialViajesModel();
        return $this->render('listarHistorialViajes', ['model' => $model]);
        //return $this->render('index');
    }

    public function actionListar_historial_calificaciones() {                      //renderiza el index de la carpeta agencia dentro de views
        $model = new HistorialCalificacionesModel();
        return $this->render('listarHistorialCalificaciones', ['model' => $model]);
        //return $this->render('index');
    }

    public function actionCalificar_conducta_usuario() {                      //renderiza el index de la carpeta agencia dentro de views
        $model = new CalificacionUsuarioModel();
        return $this->renderAjax('calificarUsuario', ['model' => $model]);
    }

}
