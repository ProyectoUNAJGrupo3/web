<?php

namespace app\models\Agencia;

use yii;
use yii\base\Model;
use app\models\CapaServicio\ViajesModelo;
use yii\data\ArrayDataProvider;

class ListaViajesTotalesModel extends Model {

    public $dataProvider;

    public function getDataProvider() {
                $obj = new ViajesModelo();
        $this->dataProvider = new ArrayDataProvider([
    'allModels' => $obj->GetInfoViajes(-1,-1,-1,-1,-1,-1,-1,"","","","",-1,"","","","","",-1,-1,-1)
]);
        return true;
    }

}
