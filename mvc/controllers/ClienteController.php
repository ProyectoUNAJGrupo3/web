<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

class ClienteController extends Controller {

    public $layout = 'mainCliente';                                             //se asocia al layout predeterminado

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
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex() {                      //renderiza el index de la carpeta agencia dentro de views
        return $this->render('index');
    }

}
