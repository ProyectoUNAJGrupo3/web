<?php

namespace app\models\Recepcionista;

use yii;
use yii\base\Model;
use app\models\CapaServicio\PersonasModelo;

class AltaClienteModel extends Model {

    public $nombre;
    public $apellido;
    public $correo;
    public $telefono;
    public $documento;
    public $direccion;
    public $coordenadas;
    public $usuario;
    public $estado;
    public $contrasenia;
    public $confirmarContrasenia;

    //Atributo que obtiene el id de la persona una vez que se setea
    public $PersonaID;


    public function rules() {
        return[
            //([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
            //(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])
            ['nombre', 'required','message'=>'Campo obligatorio'],
            ['nombre', 'match','pattern'=>'/^[a-zA-Z ]*$/','message'=>'Ingrese solo letras'],

            ['apellido', 'required','message'=>'Campo obligatorio'],
            ['apellido', 'match','pattern'=>'/^[a-zA-Z ]*$/','message'=>'Ingrese solo letras'],
            ['apellido', 'match','pattern'=>'/^.{3,50}$/','message'=>'Ingrese como minimo 3 y como maximo 50 letras'],

            ['correo', 'email'],

            ['documento', 'string'],
            ['documento', 'match','pattern'=>'/^[1-9]\d*$/','message'=>'Ingrese solo numeros'],

            ['telefono', 'required','message'=>'Campo obligatorio'],
            ['telefono', 'match','pattern'=>'/^[1-9]\d*$/','message'=>'Ingrese solo numeros'],
            ['telefono', 'match','pattern'=>'/^\d{8,20}/','message'=>'Ingrese como minimo 8 y como maximo 20 numeros'],

            ['direccion', 'required','message'=>'Campo obligatorio'],
            ['coordenadas', 'string'],
            ['usuario', 'string'],

            ['contrasenia', 'string'],
            ['contrasenia', 'match','pattern'=>'/^.{6,50}$/','message'=>'Ingrese como minimo 6 caracteres'],

            ['confirmarContrasenia', 'string'],
            ['confirmarContrasenia', 'match','pattern'=>'/^.{6,50}$/','message'=>'Ingrese como minimo 6 caracteres'],
            ['confirmarContrasenia', 'compare', 'compareAttribute'=>'contrasenia' , 'message'=>'Las constrasenias deben coincidir'],
        ];
    }
    public function altaCliente()
    {
        try {
            $model = new PersonasModelo(); //crea un nuevo modelo de personamodelo
            //$password = crypt($this->contrasenia,Yii::$app->params["salt"]);
            $agenciaID = yii::$app->user->identity->AgenciaID;
            $persona = $model->RegistrarPersona("'$this->nombre'","'$this->apellido'","'$this->usuario'","'$this->contrasenia'","'$this->telefono'","'$this->correo'","'$this->direccion'","'$this->coordenadas'",1,1,4,"'$this->documento'",$agenciaID); //genera el alta del usuario y lo guarda
            $persona = array_shift($persona);          //setea la variable PersonaID con el personaID de la persona registrada (el store devuelve mediante el _result el personaID
            if (!is_null($persona['_Result']))
            {
                return true;
            }
            else return false;
        }
        catch (\yii\db\Exception $e) {
            $messageError = $e->errorInfo[2];
            $this->addError('agregar_ClienteError',$messageError);
            return false;
        }
    }

}



