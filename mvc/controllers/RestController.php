<?php

/**
 * RestController short summary.
 *
 * RestController description.
 *
 * @version 1.0
 * @author Ignacio
 */
namespace app\controllers;
use yii\filters\VerbFilter;
use yii\web\Controller;
use Yii;
use app\models\CapaServicio\AgenciaModelo;
use app\models\CapaServicio\TarifasModelo;

use yii\web\Response;
use yii\helpers\Json;
//use app\models\CapaServicio\ViajesModelo;
//use yii\rest\ActiveController;
class RestController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                     'search'=>['get'],
                     'flashcliente'=>['get'],
                     'flashrecepcion'=>['get'],
                     //'update'=>['post'],
                     //'delete' => ['delete'],
                     //'deleteall'=>['post'],
                ],
              
            ]
        ];
    }

    public function beforeAction($event)
    {
        // esta para verificar que no haga ningun get/post que no este permitido en el behaviours
        $action = $event->id;
        if (isset($this->actions[$action])) {
            $verbs = $this->actions[$action];
        } elseif (isset($this->actions['*'])) {
            $verbs = $this->actions['*'];
        } else {
            return $event->isValid;
        }
        $verb = Yii::$app->getRequest()->getMethod();
        
        $allowed = array_map('strtoupper', $verbs);
        
        if (!in_array($verb, $allowed)) {
            
            $this->setHeader(400);
            echo json_encode(array('status'=>0,'error_code'=>400,'message'=>'Method not allowed'),JSON_PRETTY_PRINT);
            exit;
            
        }  
        
        return true;  
    }
    public function actionSearch()
    {
        //en la variable $_GET tengo la data de lo que me tengo que venir a buscar, necesito hacer un metodo del modelo para pegarle con eso
        //el asunto esta en que no hay datos confiables en la base. Hay que tocar el modelo de registro para que guarde un par de cosas mas.
        $tarifa= new TarifasModelo();

        $agenciaModel= new AgenciaModelo();
        $result = $agenciaModel->GetInfoAgencia(null,null,null,null,null,null,null,null);
        //for ($i = 0; $i < $length; $i++)
        //{
        	
        //}
        $i=-1;
        foreach ($result as $value)
        {
            $i++;
        	if($value["DireccionCoordenada"] !=null){ // asi no vamos a buscar las tarifas de remiserias que no se van a mostrar
                //array_push($value,$tarifa->GetInfoTarifas(null,null,$value["AgenciaID"],null,null,null,null)) ;
                $result[$i]['Tarifa'] = $tarifa->GetInfoTarifas(null,null,$value["AgenciaID"],null,null,null,null)[0]; //casos en los que tienen mas de una tarifa, nose por que
            }
        }
        
        $this->setHeader(200);
        Yii::$app->response->format = Response::FORMAT_JSON;
        return Json::encode($result);
        
    }
    public function actionFlashcliente(){
        Yii::$app->session->setFlash('Se confirmo tu viaje, el remis estara llegando en pocos minutos.');
        
    }
    public function actionFlashrecepcion(){
        Yii::$app->session->setFlash('Hay una nueva solicitud web, por favor dirigase a la pestaña web para aceptar/rechazar.');
        
    }
   private function setHeader($status)
     {
         
         $status_header = 'HTTP/1.1 ' . $status . ' ' . $this->_getStatusCodeMessage($status);
         $content_type="application/json; charset=utf-8";
         
         header($status_header);
         header('Content-type: ' . $content_type);
         header('X-Powered-By: ' . "Nintriva <nintriva.com>");
     }

    private function _getStatusCodeMessage($status)
    {
        $codes = Array(
        200 => 'OK',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        );
        return (isset($codes[$status])) ? $codes[$status] : '';
    }

    
}