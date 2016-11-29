<?php

namespace app\models\Agencia;

use yii\base\Model;
use app\models\CapaServicio\VehiculosModelo;
use yii;

class ActualizacionVehiculoModel extends Model {

    public $marca;
    public $modelo;
    public $patente;
    public $anio;
    public $estado;

    public function rules() {
        return[
            //([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
            //(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])
            ['marca', 'required', 'message' => 'Campo obligatorio'],
            ['marca', 'match', 'pattern' => '/^[a-zA-Z_ ]*$/', 'message' => 'Ingrese solo letras'],
            ['marca', 'match', 'pattern' => '/^.{3,20}$/', 'message' => 'Ingrese como mínimo 3 y como máximo 20 letras'],

            ['modelo', 'required', 'message' => 'Campo obligatorio'],
            ['modelo', 'match', 'pattern' => '/^[a-zA-Z0-9_ ]*$/', 'message' => 'Ingrese solo letras'],
            ['modelo', 'match', 'pattern' => '/^.{3,50}$/', 'message' => 'Ingrese como mínimo 3 y como máximo 50 letras'],

            ['patente', 'required', 'message' => 'Campo obligatorio'],
            ['patente', 'match', 'pattern' => '/^[a-zA-Z0-9_ ]*$/', 'message' => 'Ingrese solo letras y números'],
            ['patente', 'match', 'pattern' => '/^.{6,20}$/', 'message' => 'Ingrese como mínimo 6 y como máximo 20 letras'],

            ['anio', 'required', 'message' => 'Campo obligatorio'],
            ['anio', 'match', 'pattern' => '/^[0-9]*$/', 'message' => 'Ingrese solo números'],
            ['anio', 'match', 'pattern' => '/^.{4,4}$/', 'message' => 'Ingrese un año válico'],

            //D00-1-1-4275
            //armar bien la expresión para número seguro
            ['numeroSeguro', 'required', 'message' => 'Campo obligatorio'],
            ['numeroSeguro', 'match', 'pattern' => '/^[1-9]\d*$/', 'message' => 'Ingrese solo números'],
            ['numeroSeguro', 'match', 'pattern' => '/^.{8,20}$/', 'message' => 'Ingrese como mínimo 8 y como máximo 20 números'],

            ['listaEstado', 'safe', 'message' => 'Campo obligatorio'],
            ['lsitaConductor', 'safe', 'message' => 'Campo obligatorio'],
        ];
    }
    public function setvehiculo($parametro) {

        $this->marca = $parametro['Nombre'];
        $this->modelo  = $parametro['Apellido'];
        $this->patente = $parametro['Documento'];
        $this->anio  = $parametro['Telefono'];
        $this->estado = $parametro['Usuario'];

    }
    public function modificarrecepcionista($id)
    {
        $model = new VehiculosModelo();
        $app = Yii::$app->user->identity->AgenciaID;
        $model->ModificarVehiculo("'$id'","'$this->patente'","'$this->modelo'","'$this->marca'","'$this->listaEstado'",null,null,"'$app'"); //genera el alta del chofer y lo guarda
        return true;
    }

}
