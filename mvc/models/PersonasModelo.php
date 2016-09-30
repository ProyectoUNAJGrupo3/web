<?php
namespace app\models;
include('Operaciones.php');
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
class PersonasModelo /*extends Model*/
{
    const Operacion_Alta = 0, Operacion_Modificacion=1, Operacion_Baja=2, Operacion_GetInfo=3;  //CONSTANTES QUE SIRVEN PARA UTILIZARLAS COMO REFERENCIA A CADA OPERACION.
    const spABM='Personas_ABM', spGetInfo='Personas_GetInfo';                                   //NOMBRES DE STORED PROCEDURES QUE SE UTILIZARAN EN EL MODELO.
    private $Operacion=null;                                                                    //VARIABLE AUXILIAR PARA GUARDAR LA CONSTANTE DE OPERACION QUE SE UTILIZARA COMO REFERENCIA.
    private $OperacionState=null;                                                               //VARIABLE QUE GUARDARA EL ESTADO DE LA OPERACION ACTUAL (ALTA, BAJA, MODIFICACION o GETINFO).
    private $Personas=null;                                                                     //VARIABLE QUE SERVIRA PARA GUARDAR LAS PERSONAS QUE DEVUELVA EL METODO GETINFO.



    public function RegistrarPersona($parametros)                                               //ESTE METODO RECIBE UN Lista COMO PARAMETRO, LA Lista DEBE CONTENER LA MISMA CANTIDAD DE PARAMETROS QUE SE UTILIZAN EN EL STORE PROCEDURE CON LOS MISMOS NOMBRES EXCEPTUANDO LOS PARAMETROS (operacion, PersonaID y @result).
    {
        $this->setOperacion(self::Operacion_Alta);                                              //LLAMA AL METODO setOperacion y SETEA LA VARIABLE $operacionState CON UN OBJETO Alta() DE LA CLASE OPERACIONES.
        $this->Personas = $this->OperacionState->EjecutarOperacion($parametros,self::spABM);    //EJECUTA EL METODO EjecutarOperacion() DEL OBJETO OperacionState (un objeto Alta()) Y LE PASA COMO PARAMETROS LA LISTA DE PARAMETROS Y LA CONSTANTE CON EL NOMBRE DEL STORED PROCEDURE DE ABM. GUARDA LA INFORMACION QUE DEVUELVE EN LA VARIABLE $Personas QUE SERA UNA LISTA CON UN SOLO VALOR ($id de la persona insertada).
        return $this->Personas;
    }
    public function EliminarPersona($parametros)                                                //ESTE METODO RECIBE UN Lista COMO PARAMETRO, LA Lista DEBE CONTENER LA MISMA CANTIDAD DE PARAMETROS QUE SE UTILIZAN EN EL STORE PROCEDURE CON LOS MISMOS NOMBRES EXCEPTUANDO LOS PARAMETROS (operacion y @result).
    {
        $this->setOperacion(self::Operacion_Baja);                                              //LLAMA AL METODO setOperacion y SETEA LA VARIABLE $operacionState CON UN OBJETO Baja() DE LA CLASE OPERACIONES.
        $this->Personas = $this->OperacionState->EjecutarOperacion($parametros,self::spABM);    //EJECUTA EL METODO EjecutarOperacion() DEL OBJETO OperacionState (un objeto Baja()) Y LE PASA COMO PARAMETROS LA LISTA DE PARAMETROS Y LA CONSTANTE CON EL NOMBRE DEL STORED PROCEDURE DE ABM. GUARDA LA INFORMACION QUE DEVUELVE EN LA VARIABLE $Personas QUE SERA UNA LISTA CON UN SOLO VALOR ($id de la persona eliminada).

        return $this->Personas;
    }
    public function ModificarPersona($parametros)                                               //ESTE METODO RECIBE UN Lista COMO PARAMETRO, LA Lista DEBE CONTENER LA MISMA CANTIDAD DE PARAMETROS QUE SE UTILIZAN EN EL STORE PROCEDURE CON LOS MISMOS NOMBRES EXCEPTUANDO LOS PARAMETROS (operacion y @result).
    {
        $this->setOperacion(self::Operacion_Modificacion);                                      //LLAMA AL METODO setOperacion y SETEA LA VARIABLE $operacionState CON UN OBJETO Modificacion() DE LA CLASE OPERACIONES.
        $this->Personas = $this->OperacionState->EjecutarOperacion($parametros,self::spABM);    //EJECUTA EL METODO EjecutarOperacion() DEL OBJETO OperacionState (un objeto Modifcacion()) Y LE PASA COMO PARAMETROS LA LISTA DE PARAMETROS Y LA CONSTANTE CON EL NOMBRE DEL STORED PROCEDURE DE ABM. GUARDA LA INFORMACION QUE DEVUELVE EN LA VARIABLE $Personas QUE SERA UNA LISTA CON UN SOLO VALOR ($id de la persona modificada).
        return $this->Personas;
    }
    public function GetInfoPersonas($parametros)                                                //ESTE METODO RECIBE UN Lista COMO PARAMETRO, LA Lista DEBE CONTENER LA MISMA CANTIDAD DE PARAMETROS QUE SE UTILIZAN EN EL STORE PROCEDURE CON LOS MISMOS NOMBRES.
    {
        $this->setOperacion(self::Operacion_GetInfo);                                           //LLAMA AL METODO setOperacion y SETEA LA VARIABLE $operacionState CON UN OBJETO Getinfo() DE LA CLASE OPERACIONES.
        $this->Personas = $this->OperacionState->EjecutarOperacion($parametros,self::spGetInfo);//EJECUTA EL METODO EjecutarOperacion() DEL OBJETO OperacionState (un objeto GetInfo()) Y LE PASA COMO PARAMETROS LA LISTA DE PARAMETROS Y LA CONSTANTE CON EL NOMBRE DEL STORED PROCEDURE DE GETINFO. GUARDA LA INFORMACION QUE DEVUELVE EN LA VARIABLE $Personas QUE SERA UNA LISTA CON USUARIOS CUYOS VALORES SON LOS MISMOS QUE DEVUELVE EL STORED PROCEDURE.
        return $this->Personas;                                                                 //SE RETORNA LA LISTA DE PERSONAS.
    }

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
    }                                                   //ESTE METODO RECIBE LA CONSTANTE DE OPERACION Y SETEA LA VARIABLE OperacionState CON UN OBJETO, EL OBJETO SE CREA A PARTIR DE LA CLASE Operaciones.php y PUEDE SER ALTA, BAJA, MODIFICACION o GETINFO.
}


//CLASE TEST GET INFO
/*$test = new PersonasModelo();                               //SE CREA UNA INSTANCIA DE LA CLASE PesonasModelo
print_r($test->GetInfoPersonas([                            //SE LLAMA AL METODO GetInfoPersonas PASANDO COMO PARAMETRO LA LISTA DE PARAMETROS QUE RECIBIRA LA CLASE GetInfo en Operaciones.php, A PARTIR DE ESTA INFORMACION LA CLASE GetInfo REALIZARA LA LOGICA DE LA CONSULTA A LA BD Y DEVOLVERA LA LISTA DE PERSONAS.
                'PersonaID' => -1,
                'Nombre' => "",
                'Usuario' => "",
                'Telefono' => "",
                'Email' => "",
                'Direccion' => "",
                'DireccionCoordenadas' => "",
                'Estado' =>'',
                'RolID' =>''
                ]));*/

/* TEST ALTA
$test = new PersonasModelo();
if($test->RegistrarPersona([
'Nombre' => '"Pepino Alejandro"',
'Usuario' => '"pempin"',
'Password' => '"pempin"',
'Telefono' => '"5422464"',
'Email' => '"santi@mendez.com.ar"',
'Direccion' => '"Calle falsa 123"',
'DireccionCoordenadas' => '"{Latitud:1234512315, Longitud:3435315}"',
'DireccionDefault' => 0,
'DireccionTipo' => 1,
'Estado' =>0,
'RolID' =>4
])!=null) echo 'Cliente registrado correctamente!';
*/

/* TEST MODIFICACION
$test = new PersonasModelo();
if($test->ModificarPersona([
'PersonaID' => 35,
'Nombre' => '"Pepino Alejandro"',
'Usuario' => '"pempin"',
'Password' => '"pempin"',
'Telefono' => '"5422464"',
'Email' => '"santi@mendez.com.ar"',
'Direccion' => '"Calle falsa 123"',
'DireccionCoordenadas' => '"{Latitud:1234512315, Longitud:3435315}"',
'DireccionDefault' => 0,
'DireccionTipo' => 1,
'Estado' =>0,
'RolID' =>4
])!=null) echo 'Cliente modificado correctamente!';
 */

/* TEST BAJA
$test = new PersonasModelo();
if($test->EliminarPersona([
'PersonaID' => 69,
'Nombre' => '""',
'Usuario' => '""',
'Password' => '""',
'Telefono' => '""',
'Email' => '""',
'Direccion' => '""',
'DireccionCoordenadas' => '""',
'DireccionDefault' => "",
'DireccionTipo' => 1,
'Estado' =>"",
'RolID' =>""
])!=null) echo 'Cliente eliminado correctamente!';
*/