<?php
namespace app\models;
use Yii;
use Yii\base\Model;
class RegistroUsuario extends Model
{
    public $PersonaID;
    public $Usuario;
    public $Password;
    public $Nombre;
    public $Telefono;
    public $Email;
    public $RolID;
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // Usuario, Nombre , Password, Telefono, Mail son obligatorios para el registro
            [['Usuario', 'Nombre' , 'Password', 'Telefono', 'Mail'], 'required'],
            // el email debe ser una direccion valida
            ['email', 'email'],
        ];
    }
    public function AltaRegistro()
    {
        $connection = \Yii::$app->db;
        $model = $connection->prepare('CALL Cliente_ABM');
        $alta = $model->execute();
        return $alta;
    }
}
?>