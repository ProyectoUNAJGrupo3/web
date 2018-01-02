<?php

namespace app\models\Recepcionista;

use yii;
use yii\base\Model;
use app\models\CapaServicio\TarifasModelo;

class EliminarTarifaModel extends Model {

    public $eliminarTarifaError;

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
