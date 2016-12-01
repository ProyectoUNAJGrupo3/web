<?php

namespace app\models\Agencia;

use yii\base\Model;
use app\models\CapaServicio\VehiculosModelo;
use yii;
class AltaVehiculoAgenciaModel extends Model {

    public $marca;
    public $modelo;
    public $patente;
    public $listaEstado;

    public function rules() {
        return[
            //([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
            //(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])
            ['marca', 'required', 'message' => 'Campo obligatorio'],
            ['marca', 'match', 'pattern' => '/^[a-zA-Z]*$/', 'message' => 'Ingrese solo letras'],
            ['marca', 'match', 'pattern' => '/^.{2,14}$/', 'message' => 'Ingrese como mínimo 2 y como máximo 14 letras'],
            ['modelo', 'required', 'message' => 'Campo obligatorio'],
            //falta validar espacios en blanco
            ['modelo', 'match', 'pattern' => '/^[a-zA-Z0-9]*$/', 'message' => 'Ingrese solo letras y números'],
            ['modelo', 'match', 'pattern' => '/^.{3,50}$/', 'message' => 'Ingrese como mínimo 3 y como máximo 50 letras'],
            ['patente', 'required', 'message' => 'Campo obligatorio'],
            ['patente', 'match', 'pattern' => '/^[a-zA-Z 0-9]*$/', 'message' => 'Ingrese solo letras y números'],
            ['patente', 'match', 'pattern' => '/^.{6,9}$/', 'message' => 'Patente inválida'],
            ['listaEstado', 'safe', 'message' => 'Campo obligatorio'],
        ];
    }
    public function registrarvehiculo()
    {
        $model = new VehiculosModelo(); //crea un nuevo modelo de vehiculomodelo
        $app = Yii::$app->user->identity->AgenciaID;
        $tiempo = date('Y-m-d H:i:s');
        $model->RegistrarVehiculo("'$this->patente'","'$this->modelo'","'$this->marca'","'$this->listaEstado'","'$tiempo'",null,"'$app'"); //genera el alta del vehiculo y lo guarda
        return true;
    }
}
