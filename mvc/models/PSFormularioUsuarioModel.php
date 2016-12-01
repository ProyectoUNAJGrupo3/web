<?php

namespace app\models;
use Yii;
use yii\base\Model;
use app\models\CapaServicio\PersonasModelo;


class PSFormularioUsuarioModel extends Model {

    public $nombre;
    public $apellido;
    public $correo;
    public $telefono;
    public $direccion;
    public $coordenadas;
    public $usuario;
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
            ['nombre', 'match','pattern'=>'/^.{3,50}$/','message'=>'Ingrese como mínimo 3 y como máximo 50 letras'],

            ['coordenadas', 'required'],

            ['apellido', 'required','message'=>'Campo obligatorio'],
            ['apellido', 'match','pattern'=>'/^[a-zA-Z ]*$/','message'=>'Ingrese solo letras'],
            ['apellido', 'match','pattern'=>'/^.{3,50}$/','message'=>'Ingrese como mínimo 3 y como máximo 50 letras'],

            ['correo', 'required','message'=>'Campo obligatorio'],
            //['correo', 'match','pattern'=>'/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$./','message'=>'Correo No Válido'],
            ['correo', 'email','message'=>'Formato inválido'],


            ['telefono', 'required','message'=>'Campo obligatorio'],
            ['telefono', 'match','pattern'=>'/^[1-9]\d*$/','message'=>'Ingrese solo números'],
            ['telefono', 'match','pattern'=>'/^\d{8,20}/','message'=>'Ingrese como mínimo 8 y como máximo 20 números'],

            ['direccion', 'required','message'=>'Campo obligatorio'],

            ['usuario', 'required','message'=>'Campo obligatorio'],

            ['contrasenia', 'required','message'=>'Campo obligatorio'],
            ['contrasenia', 'match','pattern'=>'/^.{6,50}$/','message'=>'Ingrese como mínimo 6 caracteres'],

            ['confirmarContrasenia', 'required','message'=>'Campo obligatorio'],
            ['confirmarContrasenia', 'match','pattern'=>'/^.{6,50}$/','message'=>'Ingrese como mínimo 6 caracteres'],

            ['confirmarContrasenia', 'compare', 'compareAttribute'=>'contrasenia' , 'message'=>'Las constraseñas deben Coincidir'],
        ];
    }
    public function AltaRegistro()
    {
        $model = new PersonasModelo(); //crea un nuevo modelo de personamodelo
        $password = crypt($this->contrasenia,Yii::$app->params["salt"]);
        $persona = $model->RegistrarPersona("'$this->nombre'","'$this->apellido'","'$this->usuario'","'$password'","'$this->telefono'","'$this->correo'","'$this->direccion'","'$this->coordenadas'","'0'","'1'","'4'",null,"''"); //genera el alta del usuario y lo guarda
        $this->PersonaID = array_shift($persona)['_Result'];          //setea la variable PersonaID con el personaID de la persona registrada (el store devuelve mediante el _result el personaID
        return true;
    }

    public function getPersonaID(){          //devuelvo el PersonaID
        return $this->PersonaID;
    }

    public function validarRegistro($id){
        $model = new PersonasModelo();
        $listaPersona = $model->GetInfoPersonas("'$id'","''","''","''","''","''","''","''","''","''","''","''");
        $persona = [];
        //De la lista que obtuve del Getinfo tomo la lista de los parametros de la persona buscada (ya que el getinfo devuelve una lista dentro de otra lista)
        foreach($listaPersona as $atributo){
            $persona = $atributo;
        }
        //Se toman los datos de la lista y se setean en variables para poder pasarselo al store ModificarPersona
        $personaID = $persona['PersonaID'];
        $nombre = $persona['Nombre'];
        $apellido = $persona['Apellido'];
        $usuario = $persona['Usuario'];
        $password = $persona['Password'];
        $telefono = $persona['Telefono'];
        $email = $persona['Email'];
        $direccion = $persona['Direccion'];
        $direccionCoordenada = $persona['DireccionCoordenada'];
        $estado = $persona['Estado'];
        $rolID = $persona['RolID'];
        $documento = $persona['Documento'];
        $agenciaID = $persona['AgenciaID'];

        //En el store los int se pasan sin comillas al igual que los que van en null, es sabido que $personaID, $rolID son int y que documento en el registro es null ya que no es un campo necesario
        $model->ModificarPersona($personaID,"'$nombre'","'$apellido'","'$usuario'","'$password'","'$telefono'","'$email'","'$direccion'","'$direccionCoordenada'",null,null,"'0'",$rolID,$documento,"'$agenciaID'");

        return true;
    }
}


