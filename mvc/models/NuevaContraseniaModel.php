<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\CapaServicio\PersonasModelo;


class NuevaContraseniaModel extends Model {

    public $contrasenia;
    public $confirmarContrasenia;
    public $verifyCode;

    //Atributo que obtiene el id de la persona una vez que se setea
    public $PersonaID;


    public function rules() {
        return[

            ['contrasenia', 'required','message'=>'Campo obligatorio'],
            ['contrasenia', 'match','pattern'=>'/^.{6,50}$/','message'=>'Ingrese como minimo 6 caracteres'],
            ['confirmarContrasenia', 'required','message'=>'Campo obligatorio'],
            ['confirmarContrasenia', 'match','pattern'=>'/^.{6,50}$/','message'=>'Ingrese como minimo 6 caracteres'],

            ['confirmarContrasenia', 'compare', 'compareAttribute'=>'contrasenia' , 'message'=>'Las constrasenias deben Coincidir'],
            ['verifyCode', 'captcha'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }


    public function getPersonaID(){          //devuelvo el PersonaID
        return $this->PersonaID;
    }

    public function ModificarRegistro($id){
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
        if ($persona['RolID']===4){                                                   //si es un usuario cliente se encripta la contrasenia sino no
            $password = crypt($this->contrasenia,Yii::$app->params["salt"]); 
        }
        else{
            $password = $this->contrasenia;
        }
        $telefono = $persona['Telefono'];
        $email = $persona['Email'];
        $direccion = $persona['Direccion'];
        $direccionCoordenada = $persona['DireccionCoordenada'];
        $estado = $persona['Estado'];
        $rolID = $persona['RolID'];
        $documento = $persona['Documento'];
        $agenciaID = $persona['AgenciaID'];

        //En el store los int se pasan sin comillas al igual que los que van en null, es sabido que $personaID, $rolID son int y que documento en el registro es null ya que no es un campo necesario
        $model->ModificarPersona($personaID,"'$nombre'","'$apellido'","'$usuario'","'$password'","'$telefono'","'$email'","'$direccion'","'$direccionCoordenada'",null,null,"'$estado'",$rolID,$documento,"'$agenciaID'");

        return true;
    }
}


