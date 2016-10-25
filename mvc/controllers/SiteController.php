<?php

namespace app\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

use app\models\ModelosHome\ContactForm;

use app\models\TipoUsuario;
use app\models\PSFormularioLoginModel;
use app\models\PSFormularioUsuarioModel;
use app\models\PSFormularioSolictudServicioUsuarioModel;

class SiteController extends Controller {

    public $rolID;

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['login', 'logout', 'administrador', 'recepcionista', 'chofer', 'cliente'], //solo debe aplicarse a las acciones login, logout , admin,recepcionista, chofer y cliente. Todas las demas acciones no estan sujetas al control de acceso
                'rules' => [                              //reglas
                    [
                        'actions' => ['login'], //para la accion login
                        'allow' => true, //Todos los permisos aceptados
                        'roles' => ['?'], //Tienen acceso a esta accion todos los usuarios invitados
                    ],
                    //se coloca por el momento este permiso        **********************************************
                    /* /                [
                      'actions' => ['login','logout'],
                      'allow' => true,
                      'roles' => ['@'],

                      ],
                      / */ [
                        //el administrador tiene permisos sobre las siguientes acciones
                        'actions' => ['logout', 'administrador'],
                        'allow' => true,
                        'roles' => ['@'], //El arroba es para el usuario autenticado
                        'matchCallback' => function ($rule, $action) {                    //permite escribir la l?gica de comprobaci?n de acceso arbitraria, las paginas que se intentan acceder solo pueden ser permitidas si es un...
                    return TipoUsuario::usuarioAdministrador(Yii::$app->user->identity->RolID);
                    //Llamada al m?todo que comprueba si es un administrador
                    //Retorno el metodo del modelo que comprueba el tipo de usuario que es por el rol (1,2,3,4) etc y que devuelve true o false
                },
                    ],
                    [
                        //el recepcionista tiene permisos sobre las siguientes acciones
                        'actions' => ['logout', 'recepcionista'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                    return TipoUsuario::usuarioRecepcionista(Yii::$app->user->identity->RolID);
                    //Llamada al m?todo que comprueba si es un recepcionista
                },
                    ],
                    [
                        //el chofer tiene permisos sobre las siguientes acciones
                        'actions' => ['logout', 'chofer'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                    return TipoUsuario::usuarioChofer(Yii::$app->user->identity->RolID);
                    //Llamada al m?todo que comprueba si es un chofer
                },
                    ],
                    [
                        //el cliente tiene permisos sobre las siguientes acciones
                        'actions' => ['logout', 'cliente'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                    return TipoUsuario::usuarioCliente(Yii::$app->user->identity->RolID);
                    //Llamada al m?todo que comprueba si es un cliente
                },
                    ],
                ],
            ],
            //Controla el modo en que se accede a las acciones, en este caso a la acci?n logout
            //s?lo se puede acceder a trav?s del m?todo post
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex() {
        return $this->render('index');
    }

    // funciones para las vistas dependiendo el tipo de usuario
    public function actionAdministrador() {
        return $this->redirect(['agencia/index']);
    }

    public function actionRecepcionista() {
        return $this->render('index');
    }

    public function actionChofer() {
        return $this->render('index');
    }

    public function actionCliente() {
        return $this->render("index");
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new PSFormularioLoginModel();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {

            if (TipoUsuario::usuarioAdministrador(Yii::$app->user->identity->RolID)) {         //Se evalua el tipo de usuario enviandole el rolID del usuario logueado, que se almaceno en una variable de sesion de yii y se accede de esta manera Yii::$app->user->identity->RolID
                return $this->redirect(['site/administrador']);
            } elseif (TipoUsuario::usuarioRecepcionista(Yii::$app->user->identity->RolID)) {
                return $this->redirect(['site/recepcionista']);
            } elseif (TipoUsuario::usuarioChofer(Yii::$app->user->identity->RolID)) {
                return $this->redirect(['site/chofer']);
            } elseif (TipoUsuario::usuarioCliente(Yii::$app->user->identity->RolID)) {
                return $this->redirect(['site/cliente']);
            } else {
                return $this->goBack();
            }
        }
        return $this->render('login', [
                    'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
                    'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout() {
        return $this->render('about');
    }

    public function actionRegistro() {
        $model = new PSFormularioUsuarioModel();

        if ($model->load(Yii::$app->request->post()) && ($model->AltaRegistro() === true)) {
            return $this->render('about');
        }
        return $this->render("PSFormularioUsuario", ['model' => $model]);
    }

    public function actionAbrir_solictud_servicio() {
        $model = new PSFormularioSolictudServicioUsuarioModel();
        return $this->render("solicitarServicioFormulario", ['model' => $model]);
    }

}
