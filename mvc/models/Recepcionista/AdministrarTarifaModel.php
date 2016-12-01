<?php

namespace app\models\Recepcionista;

use yii;
use yii\base\Model;
use app\models\CapaServicio\TarifasModelo;
use yii\helpers\ArrayHelper;
use yii\data\ArrayDataProvider;

class AdministrarTarifaModel extends Model {
    public $dataProvider;
    public $AgenciaID;
    public $eliminarTarifaError;

    public function setDataProvider() {
        $this->AgenciaID = Yii::$app->user->identity->AgenciaID;

        $tarifas = new TarifasModelo();
        $this->dataProvider = new ArrayDataProvider([
        'allModels' => $tarifas->GetInfoTarifas(NULL,NULL,$this->AgenciaID,NULL,NULL,NULL,NULL),
        'pagination' => [ 'pageSize' => 10 ],
        ]);

        return true;
    }

    public function eliminarTarifa($tarifaID)
    {
        $model = new TarifasModelo();
        try {
            $tarifaEliminada = $model->EliminarTarifa($tarifaID);
            $tarifaEliminada = array_shift($tarifaEliminada);
            if (!is_null($tarifaEliminada['_Result']))
            {
                return true;
            }
            else return false;
        }
        catch (\yii\db\Exception $e) {
            $messageError = $e->errorInfo[2];
            $this->addError('eliminarTarifaError',$messageError);
            return false;
        }

    }
}
