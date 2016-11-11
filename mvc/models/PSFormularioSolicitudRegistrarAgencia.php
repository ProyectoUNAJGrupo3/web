<?php

namespace app\models;

use yii\base\Model;

class PSFormularioSolicitudRegistrarAgencia extends Model {

    public $nombreAgencia;
    public $telefonoAgencia;
    //cuit de la agencia
    public $tipo;
    public $documento;
    public $digitoVerificador;
    //vaiable que contiene la estructura del cuit
    public $cuit;
    public $direccionAgencia;
    public $coordenadas;
    
    public $nombreDuenio;
    public $apellidoDuenio;
    public $dniDuenio;
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
            ['tipo', 'required', 'message' => 'Campo obligatorio'],
            ['tipo', 'match', 'pattern' => '/^[1-9]\d*$/', 'message' => 'Ingrese solo números'],
            ['tipo', 'match', 'pattern' => '/^\d{2,2}/', 'message' => 'Ingrese 2 números'],
            ['documento', 'required', 'message' => 'Campo obligatorio'],
            ['documento', 'match', 'pattern' => '/^[1-9]\d*$/', 'message' => 'Ingrese solo números'],
            ['documento', 'match', 'pattern' => '/^\d{2,2}/', 'message' => 'Ingrese 8 números'],
            ['digitoVerificador', 'required', 'message' => 'Campo obligatorio'],
            ['digitoVerificador', 'match', 'pattern' => '/^[1-9]\d*$/', 'message' => 'Ingrese solo números'],
            ['digitoVerificador', 'match', 'pattern' => '/^\d{2,2}/', 'message' => 'Ingrese 1 número'],
            ['direccionAgencia', 'required', 'message' => 'Campo obligatorio'],
            ['nombreDuenio', 'required', 'message' => 'Campo obligatorio'],
            ['nombreDuenio', 'match', 'pattern' => '/^[a-zA-Z]*$/', 'message' => 'Ingrese solo letras'],
            ['nombreDuenio', 'match', 'pattern' => '/^.{3,50}$/', 'message' => 'Ingrese como mínimo 3 y como máximo 50 letras'],
            ['apellidoDuenio', 'required', 'message' => 'Campo obligatorio'],
            ['apellidoDuenio', 'match', 'pattern' => '/^[a-zA-Z]*$/', 'message' => 'Ingrese solo letras'],
            ['apellidoDuenio', 'match', 'pattern' => '/^.{3,50}$/', 'message' => 'Ingrese como mínimo 3 y como máximo 50 letras'],
            ['dniDuenio', 'required', 'message' => 'Campo obligatorio'],
            ['dniDuenio', 'match', 'pattern' => '/^[1-9]\d*$/', 'message' => 'Ingrese solo números'],
            ['dniDuenio', 'match', 'pattern' => '/^\d{8,12}/', 'message' => 'Ingrese como mínimo 8 y como máximo 20 números'],
            ['email', 'email', 'message' => 'Email no válido'],
            ['usuario', 'required', 'message' => 'Campo obligatorio'],
            ['contrasenia', 'required', 'message' => 'Campo obligatorio'],
            ['contrasenia', 'match', 'pattern' => '/^.{6,50}$/', 'message' => 'Ingrese como mínimo 6 caracteres'],
            ['confirmarContrasenia', 'required', 'message' => 'Campo obligatorio'],
            ['confirmarContrasenia', 'match', 'pattern' => '/^.{6,50}$/', 'message' => 'Ingrese como mínimo 6 caracteres'],
            ['confirmarContrasenia', 'compare', 'compareAttribute' => 'contrasenia', 'message' => 'Las constraseñas deben Coincidir'],
            ['confirmarContrasenia', 'compare', 'compareAttribute' => 'contrasenia', 'message' => 'Las constraseñas deben Coincidir', 'on' => 'register'],
        ];
    }

}
