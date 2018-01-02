<?php

namespace app\controllers;

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\ModelosHome\ContactForm;
use app\models\TipoUsuario;
use app\models\PSFormularioLoginModel;
use app\models\PSFormularioUsuarioModel;
use app\models\PSFormularioSolicitudRegistrarAgencia;
use app\models\InvalidoUsuarioModel;
use app\models\RecuperarContraseniaModel;
use app\models\NuevaContraseniaModel;

class SiteController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['login', 'logout', 'administrador', 'recepcionista', 'chofer', 'cliente', 'registro', 'contact', 'about', 'solicitud_registrar_agencia'], //solo debe aplicarse a las acciones login, logout , admin,recepcionista, chofer y cliente. Todas las demas acciones no estan sujetas al control de acceso
                'rules' => [                              //reglas
                    [
                        'actions' => ['login', 'registro', 'contact', 'about', 'solicitud_registrar_agencia'], //para la accion login
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
        if ($model->load(Yii::$app->request->post()) && $model->login()) {          //cuando el cliente ingresa los datos en el login
            if (Yii::$app->user->identity->Estado == 1) {                            //se evalua si la cuenta esta validada, si ==1 es invalidada
                Yii::$app->user->logout();                                          //se cierra la sesion y se muestra un mensaje
                return $this->render('VistaInvalidoUsuarioDesdeLogin');

            } else {
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
        }
        return $this->renderAjax('login', [
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

    public function actionConfirmar() {
        $model = new PSFormularioUsuarioModel();
        if (Yii::$app->request->get()) {

            $id = Html::encode($_GET["id"]);
            (int) $id;
            $model->validarRegistro($id);

            return $this->render('VistaConfirmacionNuevoUsuarioDesdeEmail');
        } else {
            return $this->redirect(['site/login']);
        }
    }

    public function actionRegistro() {
        $model = new PSFormularioUsuarioModel();


        if ($model->load(Yii::$app->request->post()) && ($model->AltaRegistro() === true)) {
            $authKey = urlencode(uniqid());         // codigo unico generado
            $id = urlencode((string) $model->getPersonaID());                          //Tomo el id de la persona registrada y lo transformo en codigo url
            $subject = "Confirmar registro";
            $body = "<h1>Haga click en el siguiente enlace para finalizar tu registro</h1>";
            $server = $_SERVER['SERVER_NAME'];
            if ($server === "localhost"){
                $link = "http://" . $server .":".$_SERVER['SERVER_PORT']. Url::toRoute("site/confirmar")."&id=" . $id."&key=".$authKey;     //url de enlace que direcciona al action Confirmar con el que habilito al usuario
            }
            else{
                $link = "http://" . $_SERVER['SERVER_NAME'] . Url::toRoute("site/confirmar")."&id=" . $id."&key=".$authKey;     //url de enlace que direcciona al action Confirmar con el que habilito al usuario
            }
            $body .= "<a href='" . $link . "'>Confirmar</a>";
            Yii::$app->mailer->compose()
                    ->setTo($model->correo)
                    ->setFrom(Yii::$app->params["adminEmail"])
                    ->setSubject($subject)
                    ->setHtmlBody($body)
                    ->send();
            Yii::$app->session->setFlash('MailEnviado');
            return $this->refresh();
        }
        return $this->render("PSFormularioUsuario", ['model' => $model]);
    }

    public function actionSolicitud_registrar_agencia() {
        $model = new PSFormularioSolicitudRegistrarAgencia();
        if ($model->load(Yii::$app->request->post()) && ($model->Registrar() === true)) {
            $subject = "Validar agencia y usuario";
            $body = "<h1>Datos de principales de Usuario: </h1>";
            $body.= "<p>Nombre: " . $model->nombre . "</p>";
            $body.= "<p>Apellido: " . $model->apellido . "</p>";
            $body.= "<p>Telefono personal: " . $model->telefono . "</p>";
            $body.= "<p>DNI: " . $model->dni . "</p>";
            $body.= "<p>Mail de usuario: " . $model->email . "</p>";
            $body.= "<p>Usuario: " . $model->usuario . "</p>";
            $body.= "<h1>Datos principales de la Agencia: </h1>";
            $body.= "<p>Nombre de la Agencia: " . $model->nombreAgencia . "</p>";
            $body.= "<p>Telefono de Agencia: " . $model->telefonoAgencia . "</p>";
            $body.= "<p>CUIT: " . $model->CUIT . "</p>";
            $body.= "<p>Mail de Agencia: " . $model->emailAgencia . "</p>";
            Yii::$app->mailer->compose()
                    ->setTo(Yii::$app->params["adminEmail"])
                    ->setFrom(Yii::$app->params["adminEmail"])
                    ->setSubject($subject)
                    ->setHtmlBody($body)
                    ->send();
            Yii::$app->session->setFlash('MailEnviado');
            return $this->refresh();
        }
        return $this->render("solicitarAgencia", ['model' => $model]);
    }

    public function actionInvalido_usuario() {
        $model = new InvalidoUsuarioModel();
        return $this->render("VistaInvalidoUsuarioDesdeLogin", ['model' => $model]);
    }

    public function actionRecuperar_contrasenia() {
        $model = new RecuperarContraseniaModel();
        if ($model->load(Yii::$app->request->post()) && ($model->buscarUsuario() === true)) {

            $authKey = urlencode(uniqid());         // codigo unico generado
            $id = urlencode((string) $model->personaID);                          //Tomo el id de la persona registrada y lo transformo en codigo url
            $subject = "Nueva contraseña";
            $body = "<h1>Haga click en el siguiente enlace para poder ingresar una contraseña nueva para su cuenta</h1>";
            $server = $_SERVER['SERVER_NAME'];
            if ($server === "localhost"){
                $link = "http://" . $server .":".$_SERVER['SERVER_PORT']. Url::toRoute("site/nueva_contrasenia")."&id=" . $id."&key=".$authKey;     //url de enlace que direcciona al action setear la nueva contrasenia
            }
            else{
                $link = "http://" . $_SERVER['SERVER_NAME'] . Url::toRoute("site/nueva_contrasenia")."&id=" . $id."&key=".$authKey;     //url de enlace que direcciona al action para setear la nueva contrasenia
            }
            $body .= "<a href='" . $link . "'>Ingrese nueva contraseña</a>";
            Yii::$app->mailer->compose()
                    ->setTo($model->correo)
                    ->setFrom(Yii::$app->params["adminEmail"])
                    ->setSubject($subject)
                    ->setHtmlBody($body)
                    ->send();
            Yii::$app->session->setFlash($model->msj);
            return $this->refresh();
        }

        return $this->render("RecuperarContrasenia", ['model' => $model]);
    }
    public function actionNueva_contrasenia(){
        $model = new NuevaContraseniaModel();
        if (Yii::$app->request->get()) {

            $id = Html::encode($_GET["id"]);
            (int) $id;
            if ($model->load(Yii::$app->request->post()) && ($model->ModificarRegistro($id) === true)) {
                Yii::$app->session->setFlash('SeteoExitoso');
            }
        }
        return $this->render("NuevaContrasenia", ['model'=>$model]);
    }

    private function actionAgregando() {
        return $this->redirect(['agencia/alta_chofer_agencia']); //llamada del boton encode agregar en vista listar chofer
    }

}
