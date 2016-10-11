<?php

namespace app\models;

use yii\base\Model;

class PSFormularioUsuarioModel extends Model {

    public $nombre;
    public $apellido;
    public $correo;
    public $telefono;
    public $direccion;
    public $usuario;
    public $contrasenia;
    public $confirmarContrasenia;

    public function rules() {
        return[
            //([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
            ['nombre', 'required'],
            ['nombre', 'match','pattern'=>'/^.{3,50}$/','message'=>'Ingrese como mínimo 3 y como máximo 50 letras'],
            //['nombre', 'match','pattern'=>'/^[0-9a-z]+$i/','message'=>'Ingrese solo letras'],

            ['apellido', 'required'],
            ['apellido', 'match','pattern'=>'/^.{3,50}$/','message'=>'Ingrese como mínimo 3 y como máximo 50 letras'],
            //['apellido', 'match','pattern'=>'/^[a-z]+$i/','message'=>'Ingrese solo letras'],

            ['correo', 'required'],
            ['correo', 'email','message'=>'Formato inválido'],


            ['telefono', 'required'],
            //['telefono', 'match','pattern'=>'/^[0-9]+$i/','message'=>'Ingrese solo números'],
            //['telefono', 'match','pattern'=>'/^.{8,20}$i/','message'=>'Ingrese como mínimo 8 y como máximo 20 números'],

            //['direccion', 'required'],

            ['usuario', 'required'],

            ['contrasenia', 'required'],
            //['cotrasenia', 'match','pattern'=>'/^.{6,50}$/','message'=>'Ingrese como mínimo 3 caracteres'],

            ['confirmarContrasenia', 'required'],
            //['confirmarContrasenia', 'match','pattern'=>'/^.{6,50}$/','message'=>'Ingrese como mínimo 3 caracteres'],
        ];
    }
    public function AltaRegistro()
    {
        $model = new PersonasModelo(); //crea un nuevo modelo de personamodelo
        $model->RegistrarPersona("'$this->nombre'","'$this->apellido'","'$this->usuario'","'$this->contrasenia'","'$this->telefono'","'$this->correo'","'$this->direccion'","'{asdfagasd}'","'0'","'0'","'4'"); //genera el alta del usuario y lo guarda
    }
}

