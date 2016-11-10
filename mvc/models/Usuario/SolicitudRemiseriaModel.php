<?php

namespace app\models\Usuario;
use app\models\CapaServicio\ViajesModelo;
use yii;
use yii\base\Model;

class SolicitudRemiseriaModel extends Model {

    public $idAgencia;
    public $idTarifa;
    public $importeTotal;
    public $origen;
    public $destino;
    public $OrigenTexto;
    public $DestinoTexto;
    public $Distancia;

    public function rules() {
        return[
            //([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
            //(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])
            ['idAgencia', 'string'],
            ['Distancia', 'string'],
            ['idTarifa', 'string'],
            ['importeTotal', 'string'],
            ['OrigenTexto', 'string'],
            ['DestinoTexto', 'string'],
            ['origen', 'required', 'message' => 'Campo obligatorio'],
            ['destino', 'required', 'message' => 'Campo obligatorio'],
        ];
    }

    public function GuardarViaje(){
        $Viaje= new ViajesModelo();
        $app = Yii::$app->user->identity->PersonaID;
        $time = new \DateTime('now', new \DateTimeZone('UTC'));
        $formatedTime= $time->format('Y-m-d H:i:s');
        $importeParsed= str_replace('$', '', $this->importeTotal);
        $Viaje->RegistrarViaje(null,null,"'$this->idTarifa'","'2'","'$this->idAgencia'","'$app'","'$formatedTime'",null,"'0'","'$this->origen'","'$this->destino'","'$this->OrigenTexto'","'$this->DestinoTexto'",null,"'$importeParsed'","'$this->Distancia'","'1'");
        return true;

    }

}

