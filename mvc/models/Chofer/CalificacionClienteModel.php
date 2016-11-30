<?php

namespace app\models\Chofer;

use yii;
use yii\base\Model;
use app\models\CapaServicio\CalificacionesModelo;

class CalificacionClienteModel extends Model {

    public $puntaje;
    public $comentario;
    public $viajeSelected;

    public function rules() {
        return[
            //([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
            //(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])
            //['numeroViaje', 'required', 'message' => 'Campo obligatorio'],
            //['nombreUsuario', 'required', 'message' => 'Campo obligatorio'],
            //['nombreChofer', 'required', 'message' => 'Campo obligatorio'],
            ['puntaje', 'required', 'message' => 'Campo obligatorio'],
            ['comentario', 'required', 'message' => 'Campo obligatorio'],
        ];
    }
    public function setUpdateInfo($viajeSelected){
        $this->viajeSelected = $viajeSelected;
    }

    public function setCalificacion(){
        $calificacion = new CalificacionesModelo();
        $fechaCalificacion = date('Y-m-d H:i:s');
        //$IDpersona = Yii::$app->user->identity->PersonaID;
        // $IDagencia = Yii::$app->user->identity->AgenciaID;

        $calificacion->RegistrarCalificacion($this->viajeSelected['ViajeID'], $this->viajeSelected['ChoferID'], $this->viajeSelected['ClienteID'],"'$this->puntaje'","'$fechaCalificacion'", "'$this->comentario'", $this->viajeSelected['AgenciaID']);
        //RegistrarCalificacion($ViajeID, $Quien, $ParaQuien, $Puntaje, $Fecha, $Comentario, $AgenciaID)
    }

}
