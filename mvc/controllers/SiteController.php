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
use app\models\PSFormularioSolicitudRegistrarAgencia;

class SiteController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['login', 'logout', 'administrador', 'recepcionista', 'chofer', 'cliente','registro','contact','about','solicitud_registrar_agencia'], //solo debe aplicarse a las acciones login, logout , admin,recepcionista, chofer y cliente. Todas las demas acciones no estan sujetas al control de acceso
                'rules' => [                              //reglas
                    [
                        'actions' => ['login','registro','contact','about','solicitud_registrar_agencia'], //para la accion login
                        'allow' => true, //Todos los permisos aceptados
                        'roles' => ['?'], //Tienen acceso a esta accion todos los usuarios invitados
                    ],

                      [
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
        //En caso de que cierre el usuario cierre la pagina y haya cerrado sesion, al abrir la aplicacion la pagina que se le presente va a ser la de su home (la que depende de su rol)

        if (!Yii::$app->user->isGuest) {                                                                              //si el usuario esta logeado, o sea no es invitado
            if (TipoUsuario::usuarioAdministrador(Yii::$app->user->identity->RolID)) {         //Se evalua el tipo de usuario enviandole el rolID del usuario logueado, que se almaceno en una variable de sesion de yii y se accede de esta manera Yii::$app->user->identity->RolID
                return $this->redirect(['agencia/index']);
            } elseif (TipoUsuario::usuarioRecepcionista(Yii::$app->user->identity->RolID)) {
                return $this->redirect(['recepcionista/index']);
            } elseif (TipoUsuario::usuarioChofer(Yii::$app->user->identity->RolID)) {
                return $this->redirect(['chofer/index']);
            } elseif (TipoUsuario::usuarioCliente(Yii::$app->user->identity->RolID)) {
                return $this->redirect(['cliente/index']);
            } else {
                return $this->render('index');
            }
        } else {
            return $this->render('index');
        }
    }

    // funciones para las vistas dependiendo el tipo de usuario
    public function actionAdministrador() {
        return $this->redirect(['agencia/index']);
    }

    public function actionRecepcionista() {
        return $this->redirect(['recepcionista/index']);
    }

    public function actionChofer() {
        return $this->redirect(['chofer/index']);
    }

    public function actionCliente() {
        return $this->redirect(['cliente/index']);
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

    public function actionSolicitud_registrar_agencia() {
        $model = new PSFormularioSolicitudRegistrarAgencia();
        if ($model->load(Yii::$app->request->post()) && ($model->Registrar() === true)) {
            return $this->render('about');
        }
        return $this->render("solicitarAgencia", ['model' => $model]);
    }

}
