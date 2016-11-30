<?php

namespace app\models\Recepcionista;

use yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use app\models\CapaServicio\ViajesModelo;
use app\models\CapaServicio\ChoferesModelo;
use app\models\CapaServicio\VehiculosModelo;
use app\models\CapaServicio\TarifasModelo;
use app\models\CapaServicio\AgenciaModelo;
use app\models\CapaServicio\PersonasModelo;
use yii\data\ArrayDataProvider;

class AltaViajeManualModel extends Model {
    public $dataProvider;
    public $origenTexto;
    public $destinoTexto;
    public $origen;
    public $destino;
    public $Distancia;
    public $TarifaID;
    public $PrecioKM;
    public $ImporteTotal;
    public $Chofer;
    public $Choferes;
    public $Vehiculo;
    public $Vehiculos;
    public $coordenadas;
    public $AgenciaID;
    public $Comentario;
    public $CanalVenta;
    public $TipoViaje;
    public $ClienteID;
    public function rules() {
        return[
            //([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
            //(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])
            ['origenTexto', 'required', 'message' => 'Campo obligatorio'],
            ['destinoTexto', 'required', 'message' => 'Campo obligatorio'],
            ['origen', 'string'],
            ['destino','string'],
            ['Distancia', 'required', 'message' => 'Campo obligatorio'],
            ['ImporteTotal', 'required', 'message' => 'Campo obligatorio'],
            ['Chofer', 'string'],
            ['Vehiculo', 'string'],
            ['Comentario', 'string'],
            ['CanalVenta', 'required'],
            ['TipoViaje', 'required'],
            ['ClienteID', 'string'],

        ];
    }

    public function agenciaCoords() {
        $obj = new AgenciaModelo();
        $agencia=$obj->GetInfoAgencia($this->AgenciaID,null,null,null,null,null,null,null);
        if ($agencia != null ){
            return $agencia[0]["DireccionCoordenada"];
        }
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
        $tarifas = new TarifasModelo();
        $tarifasResult = $tarifas->GetInfoTarifas(NULL,NULL,$this->AgenciaID,NULL,NULL,NULL,1);
        $precios = array_shift($tarifasResult);
        $this->TarifaID = $precios['TarifaID'];
        $this->PrecioKM = $precios['PrecioKM'];
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
        $viajeCreado = $model->RegistrarViaje($this->Chofer,$this->Vehiculo,$this->TarifaID,$this->CanalVenta,$this->AgenciaID,$this->ClienteID,"'$fechaEmision'","'$fechaViaje'",1,"'$this->origen'","'$this->destino'","'$this->destinoTexto'", "'$this->origenTexto'","'$this->Comentario'",str_replace(" $","",$this->ImporteTotal), str_replace(" Km","",$this->Distancia), $this->TipoViaje);
        $viajeCreado = array_shift($viajeCreado);
        if (!is_null($viajeCreado['_Result']))
        {
            $this->Chofer = null;
            $this->Vehiculo = null;
            return true;
        }
        else return false;
    }
    public function pushToChannel(){
        $array['evento']='prueba';
        Yii::$app->pusher->trigger( 'canal1' , 'evento' , $array);

    }
}
