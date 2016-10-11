<?php

namespace app\models;

use Yii;
use yii\base\Model;

class PSFormularioLoginModel extends Model {

    public $usuario;
    public $contrasenia;
    public $recordarMe = true;
    public $_user = false;
    public $rememberMe = true;

    public function rules() {
        return [
            // username and password are both required
            [['usuario', 'contrasenia'], 'required'],
            // rememberMe must be a boolean value
            ['recordarMe', 'boolean'],
            // password is validated by validatePassword()
        ];
    }

    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->contrasenia)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            User::setUser();
            $this->_user = User::findByUserName($this->usuario);
        }

        return $this->_user;
    }
    //metodo agregado

    public function getUsuario(){
        return $this->usuario;

    }
}
