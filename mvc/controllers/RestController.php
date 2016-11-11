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
                     //'view'=>['get'],
                     //'create'=>['post'],
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
        //el asunto esta en que no hay datos confiables en la base. Hay que tocar el modelo de registro para que guarde un par de cosas más.


        ////$model=$this->findModel($id);
        
        //$this->setHeader(200);
        //echo json_encode(array('status'=>1,'data'=>array_filter($model->attributes)),JSON_PRETTY_PRINT);
        
    } 
    /* debería crearme el modelo de agencias, pasarle como parametro la que estoy buscando y hacer la gilada */
    protected function findModel()
    {
        //$request= $_POST;
        //$url= $id;
        //if (($model = User::findOne($id)) !== null) {
        //    return $model;
        //} else {
            
        //    $this->setHeader(400);
        //    echo json_encode(array('status'=>0,'error_code'=>400,'message'=>'Bad request'),JSON_PRETTY_PRINT);
        //    exit;
        //}
    }

    
}