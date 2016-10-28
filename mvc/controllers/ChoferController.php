<?php
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;


class ChoferController extends Controller{

    public $layout = 'mainChofer';                           //se asocia al layout predeterminado


    public function actions() {
        Yii::$app->errorHandler->errorAction = 'chofer/error';             //seteo la ruta de vista de error para que al llamar al ErrorAction no vaya a la del site sino a la de agencia,
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

}