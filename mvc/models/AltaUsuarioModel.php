<?php

namespace app\models;

use yii\base\Model;

class AltaUsuarioModel extends Model {

    public $nombre;
    public $apellido;
    public $correo;
    public $telefono;
    public $direccion;
    public $coordenadas;
    public $usuario;
    public $contrasenia;
    public $confirmarContrasenia;

    public function rules() {
        return[
            //([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
            //(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])
            ['nombre', 'required','message'=>'Campo obligatorio'],
            ['nombre', 'match','pattern'=>'/^[a-zA-Z ]*$/','message'=>'Ingrese solo letras'],
            ['nombre', 'match','pattern'=>'/^.{3,50}$/','message'=>'Ingrese como mínimo 3 y como máximo 50 letras'],
            

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
        ];
    }
    public function AltaRegistro()
    {
        $model = new PersonasModelo(); //crea un nuevo modelo de personamodelo
        $model->RegistrarPersona("'$this->nombre'","'$this->apellido'","'$this->usuario'","'$this->contrasenia'","'$this->telefono'","'$this->correo'","'$this->direccion'","'{asdfagasd}'","'0'","'0'","'4'"); //genera el alta del usuario y lo guarda
        return true;
    }
}

