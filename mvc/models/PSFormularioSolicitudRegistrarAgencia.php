<?php

namespace app\models;

use yii\base\Model;

class PSFormularioSolicitudRegistrarAgencia extends Model {

    public $nombreAgencia;
    public $telefonoAgencia;
    public $numeroClienteServcio;
    public $direccionAgencia;
    public $nombreDuenio;
    public $apellidoDuenio;
    public $dniDuenio;
    public $email;

    public function rules() {
        return[
            //([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
            //(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])


            ['nombreAgencia', 'required', 'message' => 'Campo obligatorio'],
            ['telefonoAgencia', 'required', 'message' => 'Campo obligatorio'],
            ['numeroClienteServcio', 'required', 'message' => 'Campo obligatorio'],
            ['nombreDuenio', 'required', 'message' => 'Campo obligatorio'],
            ['apellidoDuenio', 'required', 'message' => 'Campo obligatorio'],
            ['dniDuenio', 'required', 'message' => 'Campo obligatorio'],
            ['nombreAgencia', 'match', 'pattern' => '/^[a-zA-Z0-9_ ]*$/', 'message' => 'Ingrese solo letras'],
            ['nombreAgencia', 'match', 'pattern' => '/^.{3,50}$/', 'message' => 'Ingrese como mínimo 3 y como máximo 50 letras'],
            ['telefonoAgencia', 'match', 'pattern' => '/^[1-9]\d*$/', 'message' => 'Ingrese solo números'],
            ['telefonoAgencia', 'match', 'pattern' => '/^\d{8,20}/', 'message' => 'Ingrese como mínimo 8 y como máximo 20 números'],
            ['direccionAgencia', 'required', 'message' => 'Campo obligatorio'],
            ['nombreDuenio', 'match', 'pattern' => '/^[a-zA-Z]*$/', 'message' => 'Ingrese solo letras'],
            ['nombreDuenio', 'match', 'pattern' => '/^.{3,50}$/', 'message' => 'Ingrese como mínimo 3 y como máximo 50 letras'],
            ['apellidoDuenio', 'match', 'pattern' => '/^[a-zA-Z]*$/', 'message' => 'Ingrese solo letras'],
            ['apellidoDuenio', 'match', 'pattern' => '/^.{3,50}$/', 'message' => 'Ingrese como mínimo 3 y como máximo 50 letras'],
            ['dniDuenio', 'match', 'pattern' => '/^[1-9]\d*$/', 'message' => 'Ingrese solo números'],
            ['dniDuenio', 'match', 'pattern' => '/^\d{8,12}/', 'message' => 'Ingrese como mínimo 8 y como máximo 20 números'],
            ['email', 'email', 'message' => 'Email no válido'],
        ];
    }

}
