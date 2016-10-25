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
            ['direccionAgencia', 'required', 'message' => 'Campo obligatorio'],
            ['noombreDuenio', 'required', 'message' => 'Campo obligatorio'],
            ['apellidoDuenio', 'required', 'message' => 'Campo obligatorio'],
            ['dniDuenio', 'required', 'message' => 'Campo obligatorio'],
            ['email', 'required', 'message' => 'Campo obligatorio'],
            
        ];
    }

}
