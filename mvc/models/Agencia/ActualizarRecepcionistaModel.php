<?php

namespace app\models\Agencia;

use yii;
use yii\base\Model;
use app\models\CapaServicio\PersonasModelo;

class ActualizarRecepcionistaModel extends Model {

    public $nombre;
    public $apellido;
    public $dni;
    public $telefono;
    public $direccion;
    public $usuario;
    public $contrasenia;
    public $confirmarContrasenia;

    public function rules() {
        return[
            //([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
            //(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])
            ['nombre', 'required', 'message' => 'Campo obligatorio'],
            ['nombre', 'match', 'pattern' => '/^[a-zA-Z_ ]*$/', 'message' => 'Ingrese solo letras'],
            ['nombre', 'match', 'pattern' => '/^.{3,50}$/', 'message' => 'Ingrese como mínimo 3 y como máximo 50 letras'],
            ['apellido', 'required', 'message' => 'Campo obligatorio'],
            ['apellido', 'match', 'pattern' => '/^[a-zA-Z_ ]*$/', 'message' => 'Ingrese solo letras'],
            ['apellido', 'match', 'pattern' => '/^.{3,50}$/', 'message' => 'Ingrese como mínimo 3 y como máximo 50 letras'],
            ['dni', 'required', 'message' => 'Campo obligatorio'],
            ['dni', 'match', 'pattern' => '/^[1-9]\d*$/', 'message' => 'Ingrese solo números'],
            ['dni', 'match', 'pattern' => '/^.{8,8}$/', 'message' => 'Documento inválido'],
            ['telefono', 'required', 'message' => 'Campo obligatorio'],
            ['telefono', 'match', 'pattern' => '/^[0-9]\d*$/', 'message' => 'Ingrese solo números'],
            ['telefono', 'match', 'pattern' => '/^\d{8,20}/', 'message' => 'Ingrese como mínimo 8 y como máximo 20 números'],
            ['direccion', 'required', 'message' => 'Campo obligatorio'],
            ['usuario', 'required', 'message' => 'Campo obligatorio'],
            ['contrasenia', 'required', 'message' => 'Campo obligatorio'],
            ['contrasenia', 'match', 'pattern' => '/^.{6,50}$/', 'message' => 'Ingrese como mínimo 6 caracteres y como máximo 50 caracteres'],
            ['confirmarContrasenia', 'required', 'message' => 'Campo obligatorio'],
            ['confirmarContrasenia', 'match', 'pattern' => '/^.{6,50}$/', 'message' => 'Ingrese como mínimo 6 y como máximo 50 caracteres'],
            ['contrasenia', 'compare', 'compareAttribute' => 'confirmarContrasenia', 'on' => 'register', 'message' => 'Las constraseñas deben Coincidir'],
        ];
    }

    public function setrecepcionista($parametro) {

        $this->nombre = $parametro['Nombre'];
        $this->apellido = $parametro['Apellido'];
        $this->dni = $parametro['Documento'];
        $this->telefono = $parametro['Telefono'];
        $this->usuario = $parametro['Usuario'];
        $this->contrasenia = $parametro['Password'];
        $this->confirmarContrasenia = $parametro['Password'];

    }
    public function modificarrecepcionista($id)
    {
        $model = new PersonasModelo();
        $app = Yii::$app->user->identity->AgenciaID;
        $model->ModificarPersona("'$id'","'$this->nombre'","'$this->apellido'","'$this->usuario'","'$this->contrasenia'","'$this->telefono'",null,"''","''","''","'0'","'0'","'2'","'$this->dni'","'$app'"); //genera la modificacion de la recepcionista y lo guarda
        return true;
    }

}
