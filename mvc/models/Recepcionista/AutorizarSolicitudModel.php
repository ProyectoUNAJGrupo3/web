<?php

namespace app\models\Recepcionista;

use yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use app\models\CapaServicio\ViajesModelo;
use app\models\CapaServicio\ChoferesModelo;
use app\models\CapaServicio\VehiculosModelo;
use app\models\CapaServicio\TarifasModelo;
use yii\data\ArrayDataProvider;
 
class AutorizarSolicitudModel extends Model {
    public $dataProvider;
    public $viajeSelected;
    public $Chofer;
    public $Choferes;
    public $Vehiculos;
    public $Vehiculo;
    public $AgenciaID;
    public function rules() {
        return[
            //([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
            //(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])
            ['Chofer', 'required', 'message' => 'Campo obligatorio'],
            ['Vehiculo', 'required', 'message' => 'Campo obligatorio'],

        ];
    }
    public function setListChoferes()
    {
        $choferes = new ChoferesModelo();
        $this->Choferes = $choferes->GetInfoChoferes(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,$this->AgenciaID,1);
        $data = array();
        foreach ($this->Choferes as $model)
            $data[$model['PersonaID']] = $model['Nombre'] . ' '. $model['Apellido'];
        $this->Choferes = $data;

    }
    public function setListVehiculos()
    {
        $vehiculos = new VehiculosModelo();
        $this->Vehiculos = $vehiculos->GetInfoVehiculos(NULL,NULL,NULL,NULL,NULL,NULL,NULL,$this->AgenciaID,1);
        $data = array();
        foreach ($this->Vehiculos as $model)
            $data[$model['VehiculoID']] = $model['Marca'] . ' '. $model['Modelo'];
        $this->Vehiculos = $data;

    }
    public function autorizarSolicitud()
    {
         //crea un nuevo modelo de personamodelo

        if(is_null($this->Chofer) && is_null($this->Vehiculo)){
            return false;
        }
        else
        {
            $fechaViaje = date('Y-m-d H:i:s');
            $model = new ViajesModelo();
            $viajeModificado = $model->ModificarViaje($this->viajeSelected['ViajeID'],is_null($this->Chofer)?$this->viajeSelected['ChoferID']:$this->Chofer,is_null($this->Vehiculo)?$this->viajeSelected['VehiculoID']:$this->Vehiculo,$this->viajeSelected['TarifaID'],1,$this->viajeSelected['AgenciaID'],$this->viajeSelected['ClienteID'],'"'.$this->viajeSelected['FechaEmision'].'"',"'$fechaViaje'",$this->viajeSelected['ViajeTipoID'],'"'.$this->viajeSelected['OrigenCoordenadas'].'"','"'.$this->viajeSelected['DestinoCoordenadas'].'"','"'.$this->viajeSelected['DestinoDireccion'].'"', '"'.$this->viajeSelected['OrigenDireccion'].'"','"'.$this->viajeSelected['Comentario'].'"',str_replace(" $","",$this->viajeSelected['ImporteTotal']), str_replace(" Km","",$this->viajeSelected['Distancia']),0);
            $viajeModificado = array_shift($viajeModificado);
            if (!is_null($viajeModificado['_Result']))
            {
           /*     $this->Chofer = null;
                $this->Vehiculo = null;*/
                return true;
            }
            else return false;
        }
    }
    public function setUpdateInfo($viajeSelected)
    {
        $this->viajeSelected = $viajeSelected;
    }
}
