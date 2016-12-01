<?php

namespace app\models\Recepcionista;

use yii;
use yii\base\Model;
use app\models\CapaServicio\PersonasModelo;
use yii\data\ArrayDataProvider;

class AdministrarClienteModel extends Model {
    public $dataProvider;
    public $AgenciaID;
    public $eliminar_ClienteError;

    public function setDataProvider() {
        $obj = new PersonasModelo();
        $this->AgenciaID = Yii::$app->user->identity->AgenciaID;
        $listaClientes = $obj->GetInfoPersonas(NULL,NULL, NULL,NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,$this->AgenciaID);

        $this->dataProvider = new ArrayDataProvider([
        'allModels' => $listaClientes,
        'pagination' => [ 'pageSize' => 10 ],
        ]);

        return true;
    }
    public function eliminarCliente($ClienteID)
    {
        $model = new PersonasModelo();
        try {
            $clienteEliminado = $model->EliminarPersona($ClienteID);
            $clienteEliminado = array_shift($clienteEliminado);
            if (!is_null($clienteEliminado['_Result']))
            {
                return true;
            }
            else return false;
        }
        catch (\yii\db\Exception $e) {
            $messageError = $e->errorInfo[2];
            $this->addError('eliminar_ClienteError',$messageError);
            return false;
        }

    }
}
