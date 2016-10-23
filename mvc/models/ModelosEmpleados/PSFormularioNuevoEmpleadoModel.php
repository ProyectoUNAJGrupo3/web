<?php

namespace app\models\ModelosEmpleados;

use yii\base\Model;

class PSFormularioNuevoEmpleadoModel extends Model {

    public $nombre;
    public $apellido;
    public $dni;
    public $telefono;
    public $direccion;
    //dropDownList tipo empleado
    public $listaTipoEmpleado;
    //checkbox para auto
    public $si;
    public $no;
    //datos auto
    public $modelo;
    public $patente;
    public $numeroSeguro;
    public $anio;
    public $listaEstadoAuto;

    public function rules() {
        return[
            //([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
            //(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])
            ['nombre', 'required', 'message' => 'Campo obligatorio'],
            ['nombre', 'match', 'pattern' => '/^[a-zA-Z_ ]*$/', 'message' => 'Ingrese solo letras'],
            ['nombre', 'match', 'pattern' => '/^.{3,50}$/', 'message' => 'Ingrese como mínimo 3 y como máximo 50 letras'],
            ['apellido', 'required', 'message' => 'Campo obligatorio'],
            ['apellido', 'match', 'pattern' => '/^[a-zA-Z_ ]*$/', 'message' => 'Ingrese solo letras'],
            ['apellido', 'match', 'pattern' => '/^.{3,50}$/', 'message' => 'Ingrese como mínimo 3 y como máximo 50 letras'],
            ['dni', 'required', 'message' => 'Campo obligatorio'],
            ['dni', 'match', 'pattern' => '/^[1-9]\d*$/', 'message' => 'Ingrese solo números'],
            ['dni', 'match', 'pattern' => '/^.{8,8}$/', 'message' => 'DNI inválido'],
            ['telefono', 'required', 'message' => 'Campo obligatorio'],
            ['telefono', 'match', 'pattern' => '/^[0-9]\d*$/', 'message' => 'Ingrese solo números'],
            ['telefono', 'match', 'pattern' => '/^\d{8,20}/', 'message' => 'Ingrese como mínimo 8 y como máximo 20 números'],
            ['direccion', 'required', 'message' => 'Campo obligatorio'],
        ];
    }

}
