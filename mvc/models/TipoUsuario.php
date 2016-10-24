<?php

namespace app\models;
use Yii;
use yii\base\Model;


class TipoUsuario
{
    public $rolID;

    public static function usuarioAdministrador($rolID){
        if ($rolID == 1){
            return true;
        }
        else{
            return false;
        }
    }
    public static function usuarioRecepcionista($rolID){
        if($rolID ==2){
            return true;
        }
        else{
            return false;
        }

    }
    public static function usuarioChofer($rolID){
        if($rolID ==3){
            return true;
        }
        else{
            return false;
        }
    }
    public static function usuarioCliente($rolID){
        if($rolID == 4){
            return true;
        }
        else{
            return false;
        }

    }
}