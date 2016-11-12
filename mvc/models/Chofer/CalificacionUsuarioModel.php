<?php

namespace app\models\Chofer;

use yii\base\Model;

class CalificacionUsuarioModel extends Model {

    public $numeroViaje;
    public $nombreUsuario;
    public $nombreChofer;
    public $puntaje;
    public $fecha;
    //dropDownList tipo empleado
    public $comentario;

    public function rules() {
        return[
            //([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
            //(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])
            ['numeroViaje', 'required', 'message' => 'Campo obligatorio'],
            ['nombreUsuario', 'required', 'message' => 'Campo obligatorio'],
            ['nombreChofer', 'required', 'message' => 'Campo obligatorio'],
            ['puntaje', 'required', 'message' => 'Campo obligatorio'],
            ['fecha', 'required', 'message' => 'Campo obligatorio'],
            ['comentario', 'required', 'message' => 'Campo obligatorio'],
                //['comentario', 'match', 'pattern' => '/^[a-zA-Z_ 0-9]\d*$/', 'message' => 'Ingrese solo números'],
        ];
    }

}
