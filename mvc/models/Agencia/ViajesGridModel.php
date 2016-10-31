<?php

namespace app\models\Agencia;

use yii;
use yii\base\Model;
use app\models\CapaServicio\ViajesModelo;
use app\models\CapaServicio\ChoferesModelo;
use app\models\CapaServicio\VehiculosModelo;
use app\models\CapaServicio\TarifasModelo;
use yii\data\ArrayDataProvider;

class ViajesGridModel extends Model {
    public $dataProvider;
    public $Origen;
    public $Destino;
    public $OrigenCoordenada;
    public $DestinoCoordenada;
    public $Distancia;
    public $ImporteTotal;
    public $Chofer;
    public $Vehiculo;
    public $coordenadas;

    public function setDataProvider() {
        $obj = new ViajesModelo();
        $this->dataProvider = new ArrayDataProvider([
        'allModels' => $obj->GetInfoViajes(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL)
        ]);

        $choferes = new ChoferesModelo();
        $this->Chofer = $choferes->GetInfoChoferes(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1);

        $vehiculos = new VehiculosModelo();
        $this->Vehiculo = $vehiculos->GetInfoVehiculos(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1);

        return true;
    }
    public function setTarifa()
    {
        if (!is_null($this->Distancia))
        {
            $tarifas = new TarifasModelo();
            $precios = $tarifas->GetInfoTarifas(NULL,NULL,NULL,NULL,NULL,NULL,1);
            $this->ImporteTotal = (floatval($precios[0]->PrecioKM) * floatval($this->Distancia));
        }
    }

}
