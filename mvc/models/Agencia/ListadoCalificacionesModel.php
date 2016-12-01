<?php

namespace app\models\Agencia;

use yii;
use yii\base\Model;
use app\models\CapaServicio\CalificacionesModelo;
use app\models\CapaServicio\PersonasModelo;
use yii\helpers\ArrayHelper;
use yii\data\ArrayDataProvider;

class ListadoCalificacionesModel extends Model {
   //GetInfoCalificacion($CalificacionID, $ViajeID, $Quien, $ParaQuien, $Puntaje, $AgenciaID)
    public $dataProvider;

    public function setDataProvider() {
        $agenciaID = Yii::$app->user->identity->AgenciaID;
        $cliente = new PersonasModelo();
        $listadoclientes = $cliente->GetInfoPersonas(null,null,null,null,null,null,null,null,null,'4',null,null);
        $obj = new CalificacionesModelo();
        $mostrar= [];
        $calificaciones = $obj->GetInfoCalificacion(null, null, null, null, null, $agenciaID);

        foreach ($listadoclientes as $client){
            foreach ($calificaciones as $lista){
                if ($lista['Calificante'] === $client['Nombre'] ){
                        if (ArrayHelper::isIn($lista,$mostrar)=== false){
                            $mostrar[] = $lista;
                        }

                }
            }
        }
        unset($cliente);
        unset($listadoclientes);
        unset($calificaciones);
        $this->dataProvider = new ArrayDataProvider([
        'allModels' => $mostrar
        ]);

        return true;
    }

}
