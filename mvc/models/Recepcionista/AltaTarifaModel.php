<?php

namespace app\models\Recepcionista;

use yii;
use yii\base\Model;
use app\models\CapaServicio\TarifasModelo;

class AltaTarifaModel extends Model {
    public $AgenciaID;
    public $TarifaID;
    public $Comision;
    public $PrecioKM;
    public $KmMinimo;
    public $ViajeMinimo;
    public $Estado;
    public $altaTarifaError;

    public function rules() {
        return[
            //([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
            //(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])
            ['PrecioKM', 'required', 'message' => 'Campo obligatorio'],
            ['KmMinimo', 'required', 'message' => 'Campo obligatorio'],
            ['ViajeMinimo', 'required', 'message' => 'Campo obligatorio'],
            ['Estado', 'required', 'message' => 'Campo obligatorio'],
            ['Comision', 'string'],
            ['Estado', 'string'],
        ];
    }
    public function altaTarifa()
    {
        $this->AgenciaID = Yii::$app->user->identity->AgenciaID;
        $model = new TarifasModelo();
        try {
            $tarifaCreada = $model->RegistrarTarifa($this->Comision,$this->AgenciaID,$this->ViajeMinimo,$this->KmMinimo,$this->PrecioKM,$this->Estado);
            $tarifaCreada = array_shift($tarifaCreada);
            if (!is_null($tarifaCreada['_Result']))
            {
                return true;
            }
            else return false;
        }
        catch (\yii\db\Exception $e) {
            $messageError = $e->errorInfo[2];
            $this->addError('altaTarifaError',$messageError);
            return false;
        }

    }
}
