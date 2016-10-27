<?php

namespace app\models;

use yii\base\Model;

class ActualizacionDatosRecepcionistaModel extends Model {

    public $nombre;
    public $apellido;
    public $dni;
    public $direccion;
    public $telefono;
    public $fechaDeIngreso;
    public $turno;
    public $fechaDeEgreso;

    public function rules() {
        return[
            //([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
            //(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])
            ['nombre', 'required', 'message' => 'Campo obligatorio'],
            ['apellido', 'required', 'message' => 'Campo obligatorio'],
            ['dni', 'required', 'message' => 'Campo obligatorio'],
            ['direccion', 'required', 'message' => 'Campo obligatorio'],
            ['telefono', 'required', 'message' => 'Campo obligatorio'],
            ['fechaDeIngreso', 'required', 'message' => 'Campo obligatorio'],
            ['turno', 'required', 'message' => 'Campo obligatorio'],
            ['fechaDeEgreso', 'required', 'message' => 'Campo obligatorio'],
            ['fechaDeAlta', 'required', 'message' => 'Campo obligatorio'],
        ];
    }

}
