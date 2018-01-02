<?php

namespace app\models\Agencia;

use yii;
use yii\base\Model;
use app\models\CapaServicio\PersonasModelo;
use app\models\CapaServicio\VehiculosModelo;
use yii\data\ArrayDataProvider;


class GridModel extends Model {

    public $dataProvider;

    public function setDataProviderChofer() {
        $obj = new PersonasModelo();
        $app = Yii::$app->user->identity->AgenciaID;
        $listachofer = $obj->GetInfoPersonas(null,null, null,null,null,null,null,null,null,'3',null,"$app");

        $this->dataProvider = new ArrayDataProvider([
        'allModels' => $listachofer
        ]);

        return true;
    }
    public function setDataProviderrecepcionista() {
        $obj = new PersonasModelo();
        $app = Yii::$app->user->identity->AgenciaID;
        $listarecepcionista = $obj->GetInfoPersonas(null,null, null,null,null,null,null,null,null,'2',null,"$app");

        $this->dataProvider = new ArrayDataProvider([
        'allModels' => $listarecepcionista
        ]);

        return true;
    }
    public function setDataProvidervehiculo() {
        $obj = new VehiculosModelo();
        $app = Yii::$app->user->identity->AgenciaID;
        $autos = $obj->GetInfoVehiculos(null, null, null,null, null, null, null, "$app", null);
        $this->dataProvider = new ArrayDataProvider([
        'allModels' => $autos
        ]);
        return true;
    }
    public function eliminarEmpleado($persona)
    {
        $obj = new PersonasModelo();
        $obj->EliminarPersona($persona['PersonaID']);
        return true;
    }
    public function eliminarvehiculo($vehiculoid)
    {
        $obj = new VehiculosModelo();
        $obj->EliminarVehiculo($vehiculoid);
        return true;
    }
}