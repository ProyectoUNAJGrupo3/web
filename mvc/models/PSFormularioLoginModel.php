<?php

namespace app\models;

use Yii;
use yii\base\Model;

class PSFormularioLoginModel extends Model {

    public $usuario;
    public $contrasenia;
    public $recordarMe = true;

    public function rules() {
        return [
            // username and password are both required
            [['usuario', 'contrasenia'], 'required'],
            // rememberMe must be a boolean value
            ['recordarMe', 'boolean'],
            // password is validated by validatePassword()
        ];
    }

}
