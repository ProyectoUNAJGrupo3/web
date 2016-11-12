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
        $listachofer = [];
        $app = Yii::$app->user->identity->AgenciaID;
        $todo = $obj->GetInfoPersonas(null,null, null,null,null,null,null,null,null,null,null,null);
        foreach ($todo as $choferes){
            if ($choferes['RolID'] === "3" and $choferes['AgenciaID'] === "$app") {
                array_push ($listachofer, $choferes);

            }
            unset($choferes);
            unset($todo);
        }
        $this->dataProvider = new ArrayDataProvider([
        'allModels' => $listachofer
        ]);

        return true;
    }
    public function setDataProviderrecepcionista() {
        $obj = new PersonasModelo();
        $listarecepcionista = [];
        $app = Yii::$app->user->identity->AgenciaID;
        $todo = $obj->GetInfoPersonas(null,null, null,null,null,null,null,null,null,null,null,null);
        foreach ($todo as $recepcionista){
            if ($recepcionista['RolID'] === "2" and $recepcionista['AgenciaID'] === "$app") {
                array_push ($listarecepcionista, $recepcionista);

            }
            unset($recepcionista);
            unset($todo);
        }
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
}