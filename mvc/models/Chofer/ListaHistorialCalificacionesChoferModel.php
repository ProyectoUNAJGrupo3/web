<?php

namespace app\models\Chofer;

use yii;
use yii\base\Model;
use app\models\CapaServicio\CalificacionesModelo;
use yii\helpers\ArrayHelper;
use yii\data\ArrayDataProvider;

class ListaHistorialCalificacionesChoferModel extends Model {
    //GetInfoCalificacion($CalificacionID, $ViajeID, $Quien, $ParaQuien, $Puntaje, $AgenciaID)
    public $dataProvider;
    public $PersonaID;
    public $viajeSelected;
    /*
    public function setUpdateInfo($viajeSelected){
        $this->viajeSelected = $viajeSelected;
    }*/

    public function setDataProvider() {
        $this->PersonaID = Yii::$app->user->identity->PersonaID;
        $obj = new CalificacionesModelo();
        $this->dataProvider = new ArrayDataProvider([
        'allModels' => $obj->GetInfoCalificacion(null, null, $this->PersonaID, null, null, null),
                'pagination' => [ 'pageSize' => 10 ],
        ]);

        return true;
    }
    /*
    public function setDataProviderActualizado() { //prueba
        $this->PersonaID = $this->viajeSelected['ChoferID'];
        //$this->PersonaID = Yii::$app->user->identity->PersonaID;
        $obj = new CalificacionesModelo();
        $this->dataProvider = new ArrayDataProvider([
        'allModels' => $obj->GetInfoCalificacion(null, null, $this->PersonaID, null, null, null)
        ]);

        return true;
    }*/


}