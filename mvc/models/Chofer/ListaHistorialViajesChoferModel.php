<?php

namespace app\models\Chofer;

use yii;
use yii\base\Model;
use app\models\CapaServicio\ViajesModelo;
use yii\helpers\ArrayHelper;
use yii\data\ArrayDataProvider;

class ListaHistorialViajesChoferModel extends Model {

    public $dataProvider;
    public $PersonaID;

    public function setDataProvider() {
        $this->PersonaID = Yii::$app->user->identity->PersonaID;

        $obj = new ViajesModelo();
        $this->dataProvider = new ArrayDataProvider([
        'allModels' => $obj->GetInfoViajes(NULL,$this->PersonaID,NULL,NULL,NULL,NULL,null,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
                'pagination' => [ 'pageSize' => 10 ],
        ]);

        return true;
    }



}