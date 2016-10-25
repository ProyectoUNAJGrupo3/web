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

class UsuarioController extends Controller {

    public $layout = 'mainUsuario';                           //se asocia al layout predeterminado

    public function actions() {                                 //Errores todavia no solucionado
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
