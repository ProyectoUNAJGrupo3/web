<?php

namespace app\models;

use Yii;
use Yii\base\Model;


/**
 * Usuario_Modelo short summary.
 *
 * Usuario_Modelo description.
 *
 * @version 1.0
 * @author mende
 */
class Usuario_Modelo extends Model
{
    public function GetInfo()
    {
        $connection = \Yii::$app->db;
        $model = $connection->createCommand('SELECT * FROM Personas WHERE PersonaID=1');
        $users = $model->queryAll();

        //$calluser = YII::app()->db->CreateComman('SELECT * FROM Personas;');
        return $users;
    }
}