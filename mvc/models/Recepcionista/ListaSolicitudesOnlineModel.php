<?php

namespace app\models\Recepcionista;

use yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use app\models\CapaServicio\ViajesModelo;
use app\models\CapaServicio\ChoferesModelo;
use app\models\CapaServicio\VehiculosModelo;
use app\models\CapaServicio\TurnosModelo;
use yii\data\ArrayDataProvider;

class ListaSolicitudesOnlineModel extends Model {
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
    public $Canal;
    public $ViajeTipo;
    public $coordenadas;
    public $AgenciaID;

    public function setDataProvider() {
        $this->AgenciaID = Yii::$app->user->identity->AgenciaID;

        $obj = new ViajesModelo();
        $this->dataProvider = new ArrayDataProvider([
        'allModels' => $obj->GetInfoViajes(NULL,NULL,NULL,NULL,NULL,$this->AgenciaID,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),
        'pagination' => [ 'pageSize' => 10 ],

        ]);

        return true;
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

    public function ViajeOperacion($viajeSelected,$operacion)
    {
        $model = new ViajesModelo(); //crea un nuevo modelo de personamodelo
        $ViajeEstado = $operacion;
        $PersonaID = Yii::$app->user->identity->PersonaID;
        $this->AgenciaID = Yii::$app->user->identity->AgenciaID;
        $TurnosModels = new TurnosModelo();

        $ListaTurnos = $TurnosModels->GetInfoTurno(NULL,$PersonaID,NULL,NULL,NULL,NULL,NULL,0);
        $turnoID= array_shift($ListaTurnos)['TurnoID'];

        $model->ModificarViaje($viajeSelected['ViajeID'],$viajeSelected['ChoferID'],$viajeSelected['VehiculoID'],$viajeSelected['TarifaID'],$turnoID,$this->AgenciaID, $viajeSelected['ClienteID'],"'$viajeSelected[FechaEmision]'",
            "'$viajeSelected[FechaSalida]'",$viajeSelected['ViajeTipoID'],"'$viajeSelected[OrigenCoordenadas]'","'$viajeSelected[DestinoCoordenadas]'"
            ,"'$viajeSelected[OrigenDireccion]'","'$viajeSelected[DestinoDireccion]'","'$viajeSelected[Comentario]'",$viajeSelected['ImporteTotal'],$viajeSelected['Distancia'],$ViajeEstado);
        return true;
    }
}
