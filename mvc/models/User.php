<?php

namespace app\models;

class User extends \yii\base\Object implements \yii\web\IdentityInterface
{
    public $PersonaID;
    public $Nombre;
    public $Apellido;
    public $Usuario;
    public $Password;
    public $Telefono;
    public $Email;
    public $Direccion;
    public $DireccionCoordenada;
    public $Estado;
    public $RolID;

    public $authKey = 'test1key';
    public $accessToken='1-token';

    private static $users;



    /**
     * @inheritdoc
     */
    public static function findIdentity($PersonaID)
    {
        return isset(self::$users[$PersonaID]) ? new static(self::$users[$PersonaID]) : null;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $Usuario
     * @return static|null
     */
    public static function findByUserName($Usuario)
    {
        foreach (self::$users as $user) {
            if (strcasecmp($user['Usuario'], $Usuario) === 0) {
                return new static($user);
            }
        }

        return null;
    }
    public static function setUser()
    {
        $test = new PersonasModelo();
        self::$users = $test->GetInfoPersonas(-1,"","","","","","","","","");
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->PersonaID;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $Password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($Password)
    {
        return $this->Password === $Password;
    }


}
