<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\CapaServicio\PersonasModelo;
use app\models\CapaServicio\AgenciaModelo;


class PSFormularioSolicitudRegistrarAgencia extends Model {
    //datos de agencia
    public $nombreAgencia;
    public $telefonoAgencia;
    public $CUIT;
    public $emailAgencia;
    public $direccionAgencia;
    public $direccionCoordenadas;


    //variables de usuario
    public $nombre;
    public $apellido;
    public $telefono;
    public $dni;
    public $email;
    public $usuario;
    public $contrasenia;
    public $confirmarContrasenia;



    public function rules() {
        return[
//([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
//(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])
            ['nombreAgencia', 'required', 'message' => 'Campo obligatorio'],
            ['nombreAgencia', 'match', 'pattern' => '/^[a-zA-Z0-9_ ]*$/', 'message' => 'Ingrese solo letras'],
            ['nombreAgencia', 'match', 'pattern' => '/^.{3,50}$/', 'message' => 'Ingrese como mínimo 3 y como máximo 50 letras'],
            ['telefonoAgencia', 'required', 'message' => 'Campo obligatorio'],
            ['telefonoAgencia', 'match', 'pattern' => '/^[1-9]\d*$/', 'message' => 'Ingrese solo números'],
            ['telefonoAgencia', 'match', 'pattern' => '/^\d{8,20}/', 'message' => 'Ingrese como mínimo 8 y como máximo 20 números'],
            ['CUIT', 'required', 'message' => 'Campo obligatorio'],
            ['emailAgencia', 'email', 'message' => 'Email no válido'],
            ['nombre', 'required', 'message' => 'Campo obligatorio'],
            ['nombre', 'match', 'pattern' => '/^[a-zA-Z]*$/', 'message' => 'Ingrese solo letras'],
            ['nombre', 'match', 'pattern' => '/^.{3,50}$/', 'message' => 'Ingrese como mínimo 3 y como máximo 50 letras'],
            ['apellido', 'required', 'message' => 'Campo obligatorio'],
            ['apellido', 'match', 'pattern' => '/^[a-zA-Z]*$/', 'message' => 'Ingrese solo letras'],
            ['apellido', 'match', 'pattern' => '/^.{3,50}$/', 'message' => 'Ingrese como mínimo 3 y como máximo 50 letras'],
            ['telefono', 'required', 'message' => 'Campo obligatorio'],
            ['telefono', 'match', 'pattern' => '/^[1-9]\d*$/', 'message' => 'Ingrese solo números'],
            ['telefono', 'match', 'pattern' => '/^\d{8,20}/', 'message' => 'Ingrese como mínimo 8 y como máximo 20 números'],
            ['dni', 'required', 'message' => 'Campo obligatorio'],
            ['dni', 'match', 'pattern' => '/^[1-9]\d*$/', 'message' => 'Ingrese solo números'],
            ['dni', 'match', 'pattern' => '/^\d{8,12}/', 'message' => 'Ingrese como mínimo 8 y como máximo 20 números'],
            ['email', 'email', 'message' => 'Email no válido'],
            ['usuario', 'required', 'message' => 'Campo obligatorio'],
            ['contrasenia', 'required', 'message' => 'Campo obligatorio'],
            ['contrasenia', 'match', 'pattern' => '/^.{6,50}$/', 'message' => 'Ingrese como mínimo 6 caracteres'],
            ['confirmarContrasenia', 'required', 'message' => 'Campo obligatorio'],
            ['confirmarContrasenia', 'match', 'pattern' => '/^.{6,50}$/', 'message' => 'Ingrese como mínimo 6 caracteres'],
    //        ['confirmarContrasenia', 'compare', 'compareAttribute'=>'contrasenia' , 'message'=>'Las constraseñas deben Coincidir'],

        ];
    }


    public function Registrar()
    {
        $model = new PersonasModelo(); //crea un nuevo modelo de personamodelo
        $model2 = new AgenciaModelo();
        $password = crypt($this->contrasenia,Yii::$app->params["salt"]);
        $model2->RegistrarAgencia("'$this->nombreAgencia'","'$this->direccionAgencia'", "'$this->direccionCoordenadas'" , "'$this->telefonoAgencia'", "'$this->emailAgencia'", "'1'","'$this->CUIT'");
        $model->RegistrarPersona("'$this->nombre'","'$this->apellido'","'$this->usuario'","'$password'","'$this->telefono'","'$this->email'",NULL,NULL,"'0'","'1'","'1'","'$this->dni'","''"); //genera el alta del usuario y lo guarda

        return true;
    }


}