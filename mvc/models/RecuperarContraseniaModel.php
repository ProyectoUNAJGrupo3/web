<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\CapaServicio\PersonasModelo;


class RecuperarContraseniaModel extends Model {

    public $nombreUsuario;
    public $correo;
    public $verifyCode;
    public $personaID;
    public $msj;

    public function rules() {
        return [
            ['nombreUsuario', 'required','message'=>'Campo obligatorio'],
            ['verifyCode', 'captcha'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }

    public function buscarUsuario(){

        $model = new PersonasModelo();
        $listaPersona = $model->GetInfoPersonas("''","''","''","'$this->nombreUsuario'","''","''","''","''","''","''","''","''");
        $persona = [];
        //De la lista que obtuve del Getinfo tomo la lista de los parametros de la persona buscada (ya que el getinfo devuelve una lista dentro de otra lista)
        foreach($listaPersona as $atributo){
            $persona = $atributo;
        }
        //Si el usuario no existe, el array va a ser igual a 0, por ende se obliga al usuario a buscar un nuevo usuario
        if (count($persona)===0){
            $this->msj = "UsuarioNoEncontrado";
            return true;
        }
        else{
            $this->personaID = $persona['PersonaID'];
            $this->correo = $persona['Email'];
            $this->msj = "MailEnviado";
            return true;
        }

    }


}
