<?php
namespace app\models;

use Yii;
use yii\base\Model;

/**
 * UsuariosModelo short summary.
 *
 * UsuariosModelo description.
 *
 * @version 1.0
 * @author mende
 */
class UsuariosModelo/* extends Model*/
{
    const Operacion_Alta = 0, Operacion_Modificacion=1, Operacion_Baja=2, Operacion_GetInfo=3, spABM='Cliente_ABM', spGetInfo='Cliente_GetInfo';
    private $Operacion=null;
    private $OperacionState=null;
    private $Usuarios=null;
    private $Parametros=null;

    public function setOperacion($Operacion) {
        $this->Operacion = $Operacion;

        if($this->Operacion==self::Operacion_Alta)
        {
            $this->OperacionState = new Alta();
        }
        else if($this->Operacion==self::Operacion_Baja)
        {
            $this->OperacionState = new Baja();
        }
        else if($this->Operacion==self::Operacion_Modificacion)
        {
            $this->OperacionState=new Modificacion();
        }
        else if($this->Operacion==self::Operacion_GetInfo)
        {
            $this->OperacionState =new GetInfo();
        }
    }

    public function RegistrarUsuario($parametros)
    {
        $this->setOperacion(self::Operacion_Alta);
        $this->Usuarios = $this->OperacionState->EjecutarOperacion($parametros,self::spABM);
        if($this->Usuarios!=null && $this->Usuarios!="")
        {return true;}
        else {return false;}
    }
    public function EliminarUsuario($parametros)
    {
        $this->setOperacion(self::Operacion_Baja);
        $this->Usuarios = $this->OperacionState->EjecutarOperacion($parametros,self::spABM);
        if($this->Usuarios!=null && $this->Usuarios!="")
        {return true;}
        else {return false;}
    }
    public function ModificarUsuario($parametros)
    {
        $this->setOperacion(self::Operacion_Modificacion);
        $this->Usuarios = $this->OperacionState->EjecutarOperacion($parametros,self::spABM);
        if($this->Usuarios!=null && $this->Usuarios!="")
        {return true;}
        else {return false;}
    }
    public function GetInfoPersonas($parametros)
    {
        $this->setOperacion(self::Operacion_GetInfo);
        $this->Usuarios = $this->OperacionState->EjecutarOperacion($parametros,self::spGetInfo);
        return $this->Usuarios;
    }
}

interface OperacionState
{
    public function EjecutarOperacion($parametros, $SP);
}

class Alta implements OperacionState
{
    private $parametros;
    public $stringParametros='';
    private $storeProcedureName;

    private function setParametros($parametros)
    {
        $ultimaPosicion = count($parametros);
        $posicionActual = 1;
        $this->stringParametros.='0,NULL,';
        foreach($parametros as $obj)
        {
            $this->stringParametros.= ($obj=="")?'""':$obj;
            $this->stringParametros.=($posicionActual==$ultimaPosicion)?',@result':',';
            $posicionActual++;
        }
    }

    private function EjecutarQuery()
    {
        /*
        $connection = \Yii::$app->db;
        $model = $connection->createCommand('CALL unaj_proyecto.Cliente_GetInfo(4,"", "", "", "", "", "");');
        $users = $model->queryAll();
         */

        $connection = mysqli_connect("192.99.203.134", "unaj_app", "u79l2vak9wh5AZ3219", "unaj_proyecto");
        $model = mysqli_query($connection,'CALL unaj_proyecto.'.$this->storeProcedureName.'('.$this->stringParametros.');') ;
        $info =  mysqli_fetch_array($model);
        return $info;
    }

    public function EjecutarOperacion($parametros, $SP)
    {
        $this->setParametros($parametros);
        $this->storeProcedureName=$SP;
        return $this->EjecutarQuery();
    }
}
class Modificacion implements OperacionState
{
    private $parametros;
    public $stringParametros='';
    private $storeProcedureName;

    private function setParametros($parametros)
    {
        $ultimaPosicion = count($parametros);
        $posicionActual = 1;
        $this->stringParametros.='1,';
        foreach($parametros as $obj)
        {
            $this->stringParametros.= ($obj=="")?'""':$obj;
            $this->stringParametros.=($posicionActual==$ultimaPosicion)?',@result':',';
            $posicionActual++;
        }
    }

    private function EjecutarQuery()
    {
        /*
        $connection = \Yii::$app->db;
        $model = $connection->createCommand('CALL unaj_proyecto.Cliente_GetInfo(4,"", "", "", "", "", "");');
        $users = $model->queryAll();
         */

        $connection = mysqli_connect("192.99.203.134", "unaj_app", "u79l2vak9wh5AZ3219", "unaj_proyecto");
        $model = mysqli_query($connection,'CALL unaj_proyecto.'.$this->storeProcedureName.'('.$this->stringParametros.');') ;
        $info =  mysqli_fetch_array($model);
        return $info;
    }

    public function EjecutarOperacion($parametros, $SP)
    {
        $this->setParametros($parametros);
        $this->storeProcedureName=$SP;
        return $this->EjecutarQuery();
    }
}
class Baja implements OperacionState
{
    private $parametros;
    public $stringParametros='';
    private $storeProcedureName;

    private function setParametros($parametros)
    {
        $ultimaPosicion = count($parametros);
        $posicionActual = 1;
        $this->stringParametros.='2,';
        foreach($parametros as $obj)
        {
            $this->stringParametros.= ($obj=="")?'""':$obj;
            $this->stringParametros.=($posicionActual==$ultimaPosicion)?',@result':',';
            $posicionActual++;
        }
    }

    private function EjecutarQuery()
    {
        /*
        $connection = \Yii::$app->db;
        $model = $connection->createCommand('CALL unaj_proyecto.Cliente_GetInfo(4,"", "", "", "", "", "");');
        $users = $model->queryAll();
         */

        $connection = mysqli_connect("192.99.203.134", "unaj_app", "u79l2vak9wh5AZ3219", "unaj_proyecto");
        $model = mysqli_query($connection,'CALL unaj_proyecto.'.$this->storeProcedureName.'('.$this->stringParametros.');') ;
        $info =  mysqli_fetch_array($model);
        return $info;
    }

    public function EjecutarOperacion($parametros, $SP)
    {
        $this->setParametros($parametros);
        $this->storeProcedureName=$SP;
        return $this->EjecutarQuery();
    }
}
class GetInfo implements OperacionState
{
    private $parametros;
    public $stringParametros='';
    private $storeProcedureName;

    private function setParametros($parametros)
    {
        $ultimaPosicion = count($parametros);
        $posicionActual = 1;
        foreach($parametros as $obj)
        {

            $this->stringParametros.= ($obj=="")?'""':$obj;
            $this->stringParametros.=($posicionActual==$ultimaPosicion)?'':',';
            $posicionActual++;
        }
    }

    private function EjecutarQuery()
    {

        /*
        $connection = \Yii::$app->db;
        $model = $connection->createCommand('CALL unaj_proyecto.'.$this->storeProcedureName.'('.$this->stringParametros.');');
        $info = $model->queryAll();
         */


        $connection = mysqli_connect("192.99.203.134", "unaj_app", "u79l2vak9wh5AZ3219", "unaj_proyecto");
        $model = mysqli_query($connection,'CALL unaj_proyecto.'.$this->storeProcedureName.'('.$this->stringParametros.');') ;
        $info =  mysqli_fetch_array($model);

        return $info;
    }

    public function EjecutarOperacion($parametros, $SP)
    {
        $this->setParametros($parametros);
        $this->storeProcedureName=$SP;
        return $this->EjecutarQuery();
    }
}


$test = new UsuariosModelo();
/* TEST GETINFO
print_r($test->GetInfoUsuarios([
                'PersonaID' => -1,
                'Nombre' => "",
                'Usuario' => "",
                'Telefono' => "",
                'Email' => "",
                'Direccion' => "",
                'DireccionCoordenadas' => "",
                'Estado' =>''
                ]));
 */


$test->RegistrarUsuario([
'Nombre' => '"Pepino Alejandro"',
'Usuario' => '"smendez"',
'Password' => '"smendez"',
'Telefono' => '"5422464"',
'Email' => '"santi@mendez.com.ar"',
'Direccion' => '"Calle falsa 123"',
'DireccionCoordenadas' => '"{Latitud:1234512315, Longitud:3435315}"',
'DireccionDefault' => 0,
'Estado' =>0
]);

/* TEST MODIFICACION
$test = new UsuariosModelo(1,[
'PersonaID' => 35,
'Nombre' => '"Pepino Alejandro"',
'Usuario' => '"smendez"',
'Password' => '"smendez"',
'Telefono' => '"5422464"',
'Email' => '"santi@mendez.com.ar"',
'Direccion' => '"Calle falsa 123"',
'DireccionCoordenadas' => '"{Latitud:1234512315, Longitud:3435315}"',
'DireccionDefault' => 0,
'Estado' =>1
]);
if($test->ModificarUsuario()) echo 'Cliente modificado correctamente!';
 */

/*TEST BORRAR
$test = new UsuariosModelo(2,[
'PersonaID' => 35,
'Nombre' => '"Pepino Alejandro"',
'Usuario' => '"smendez"',
'Password' => '"smendez"',
'Telefono' => '"5422464"',
'Email' => '"santi@mendez.com.ar"',
'Direccion' => '"Calle falsa 123"',
'DireccionCoordenadas' => '"{Latitud:1234512315, Longitud:3435315}"',
'DireccionDefault' => 0,
'Estado' =>1
]);
if($test->EliminarUsuario()) echo 'Cliente eliminado correctamente!';*/