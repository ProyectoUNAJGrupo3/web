<?php

namespace app\models;

use Yii;
use yii\base\Model;

class RecuperarContraseniaModel extends Model {

    public $nombreUsuario;

    public function rules() {
        return [
            ['nombreUsuario', 'required','message'=>'Campo obligatorio'],
        ];
    }

}
