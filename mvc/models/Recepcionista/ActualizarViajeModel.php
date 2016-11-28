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

class ActualizarViajeModel extends Model {
    public $dataProvider;
    public $viajeSelected;
    public $Chofer;
    public $test;
    public $Choferes;
    public $Vehiculos;
    public $Vehiculo;
    public $AgenciaID;
    public function rules() {
        return[
            //([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
            //(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])
            ['test', 'required', 'message' => 'Campo obligatorio'],

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
    public function actualizarViaje()
    {
        $pepe = $this->Chofer;
        $t = $this->test;
        $viaje = $this->viajeSelected;
        /*$model = new ViajesModelo(); //crea un nuevo modelo de personamodelo

        $fechaEmision = date('Y-m-d H:i:s');
        $fechaViaje = date('Y-m-d H:i:s');
        $viajeCreado = $model->RegistrarViaje($this->Chofer,$this->Vehiculo,$this->TarifaID,1,$this->AgenciaID,NULL,"'$fechaEmision'","'$fechaViaje'",1,"'$this->origen'","'$this->destino'","'$this->destinoTexto'", "'$this->origenTexto'","'$this->Comentario'",str_replace(" $","",$this->ImporteTotal), str_replace(" Km","",$this->Distancia), 0);
        $viajeCreado = array_shift($viajeCreado);
        if (!is_null($viajeCreado['_Result']))
        {
            $this->Chofer = null;
            $this->Vehiculo = null;*/
            return true;
        /*}
        else return false;*/
    }
    public function setUpdateInfo($viajeSelected)
    {
        $this->viajeSelected = $viajeSelected;
    }
}
