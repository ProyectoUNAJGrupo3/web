<?php

namespace app\models\Agencia;

use yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use app\models\CapaServicio\ViajesModelo;
use app\models\CapaServicio\ChoferesModelo;
use app\models\CapaServicio\VehiculosModelo;
use app\models\CapaServicio\TarifasModelo;
use yii\data\ArrayDataProvider;

class ViajesGridModel extends Model {
    public $dataProvider;
    public $origenTexto;
    public $destinoTexto;
    public $origen;
    public $destino;
    public $Distancia;
    public $TarifaID;
    public $ImporteTotal;
    public $Chofer;
    public $Choferes;
    public $Vehiculo;
    public $Vehiculos;
    public $coordenadas;
    public $AgenciaID;
    public function rules() {
        return[
            //([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
            //(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])
            ['origenTexto', 'required', 'message' => 'Campo obligatorio'],
            ['destinoTexto', 'required', 'message' => 'Campo obligatorio'],
            ['origen', 'required', 'message' => 'Campo obligatorio'],
            ['destino', 'required', 'message' => 'Campo obligatorio'],
            ['Distancia', 'required', 'message' => 'Campo obligatorio'],
            ['ImporteTotal', 'required', 'message' => 'Campo obligatorio'],
            ['Chofer', 'required', 'message' => 'Campo obligatorio'],
            ['Vehiculo', 'required', 'message' => 'Campo obligatorio'],
        ];
    }
    public function setDataProvider() {
        $this->AgenciaID = Yii::$app->user->identity->AgenciaID;


        $obj = new ViajesModelo();
        $this->dataProvider = new ArrayDataProvider([
        'allModels' => $obj->GetInfoViajes(NULL,NULL,NULL,NULL,NULL,$this->AgenciaID,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL)
        ]);

        return true;
    }
    public function setTarifa()
    {
        if (!is_null($this->Distancia))
        {
            $tarifas = new TarifasModelo();
            $precios = array_shift($tarifas->GetInfoTarifas(NULL,NULL,$this->AgenciaID,NULL,NULL,NULL,1));
            $this->TarifaID = $precios['TarifaID'];
            $this->ImporteTotal = (floatval($precios['PrecioKM']) * floatval($this->Distancia));
        }

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
    public function registrarViaje()
    {
        $model = new ViajesModelo(); //crea un nuevo modelo de personamodelo
        $this->setTarifa();

            $fechaEmision = date('Y-m-d H:i:s');
            $fechaViaje = date('Y-m-d H:i:s');
            $viajeCreado = $model->RegistrarViaje($this->Chofer,$this->Vehiculo,$this->TarifaID,1,$this->AgenciaID,NULL,"'$fechaEmision'","'$fechaViaje'",1,"'$this->origen'","'$this->destino'","'$this->destinoTexto'", "'$this->origenTexto'","'COMENTARIO PRUEBA'", $this->ImporteTotal, $this->Distancia, 0);
            $viajeCreado = array_shift($viajeCreado);
            if (!is_null($viajeCreado['_Result']))
            {
                $this->Chofer = null;
                $this->Vehiculo = null;
                return true;
            }
            else return false;
    }
}
