<?php
namespace app\models;

namespace app\models;

use Yii;
use Yii\base\Model;

class CallStore extends Model
{
    public function getUser()
    {
        $connection = \Yii::$app->db;
        $model = $connection->createCommand('SELECT * FROM Personas');
        $users = $model->queryAll();

        //$calluser = YII::app()->db->CreateComman('SELECT * FROM Personas;');
        return $users;
        //return ['emendez','emendez'];
    }
}