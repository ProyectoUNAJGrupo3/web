<?php
namespace app\models;
include('Operaciones.php');
use Yii;
use yii\base\Model;

/**
 * AgenciaModelo short summary.
 *
 * AgenciaModelo description.
 *
 * @version 1.0
 * @author mende
 */
class AgenciaModelo extends Model
{
    const Operacion_Alta = 0, Operacion_Modificacion=1, Operacion_Baja=2, Operacion_GetInfo=3;  //CONSTANTES QUE SIRVEN PARA UTILIZARLAS COMO REFERENCIA A CADA OPERACION.
    const spABM='Agencia_ABM', spGetInfo='Agencia_GetInfo';                                     //NOMBRES DE STORED PROCEDURES QUE SE UTILIZARAN EN EL MODELO.
    private $Operacion=null;                                                                    //VARIABLE AUXILIAR PARA GUARDAR LA CONSTANTE DE OPERACION QUE SE UTILIZARA COMO REFERENCIA.
    private $OperacionState=null;                                                               //VARIABLE QUE GUARDARA EL ESTADO DE LA OPERACION ACTUAL (ALTA, BAJA, MODIFICACION o GETINFO).
    private $Agencias=null;                                                                     //VARIABLE QUE SERVIRA PARA GUARDAR LAS PERSONAS QUE DEVUELVA EL METODO GETINFO.
    private $Parametros=null;                                                                   //VARIABLE QUE GUARDARA LOS PARAMETROS DEL STORED PROCEDURE



    public function RegistrarAgencia($Nombre,$Direccion, $DireccionCoordenadas , $Telefono, $Email, $Estado)                                               //ESTE METODO RECIBE UN Lista COMO PARAMETRO, LA Lista DEBE CONTENER LA MISMA CANTIDAD DE PARAMETROS QUE SE UTILIZAN EN EL STORE PROCEDURE CON LOS MISMOS NOMBRES EXCEPTUANDO LOS PARAMETROS (operacion, AgenciaID y @result).
    {
        $this->Parametros = [
                'Nombre' => $Nombre,
                'Direccion' => $Direccion,
                'DireccionCoordenadas' => $DireccionCoordenadas,
                'Telefono' => $Telefono,
                'Email' => $Email,
                'Estado' =>$Estado,

                ];
        $this->setOperacion(self::Operacion_Alta);                                                      //LLAMA AL METODO setOperacion y SETEA LA VARIABLE $operacionState CON UN OBJETO Alta() DE LA CLASE OPERACIONES.
        $this->Agencia = $this->OperacionState->EjecutarOperacion($this->Parametros,self::spABM);      //EJECUTA EL METODO EjecutarOperacion() DEL OBJETO OperacionState (un objeto Alta()) Y LE PASA COMO PARAMETROS LA LISTA DE PARAMETROS Y LA CONSTANTE CON EL NOMBRE DEL STORED PROCEDURE DE ABM. GUARDA LA INFORMACION QUE DEVUELVE EN LA VARIABLE $Agencia QUE SERA UNA LISTA CON UN SOLO VALOR ($id de la Agencia insertada).
        return $this->Agencia;
    }
    public function EliminarAgencia($AgenciaID)
    {
        $this->Parametros = [
                'AgenciaID' => $AgenciaID,
                'Nombre' => "",
                'Direccion' => "",
                'DireccionCoordenadas' => "",
                'Telefono' => "",
                'Email' => "",
                'Estado' =>"",
                ];
        $this->setOperacion(self::Operacion_Baja);                                                    //LLAMA AL METODO setOperacion y SETEA LA VARIABLE $operacionState CON UN OBJETO Baja() DE LA CLASE OPERACIONES.
        $this->Agencia = $this->OperacionState->EjecutarOperacion($this->Parametros,self::spABM);    //EJECUTA EL METODO EjecutarOperacion() DEL OBJETO OperacionState (un objeto Baja()) Y LE PASA COMO PARAMETROS LA LISTA DE PARAMETROS Y LA CONSTANTE CON EL NOMBRE DEL STORED PROCEDURE DE ABM. GUARDA LA INFORMACION QUE DEVUELVE EN LA VARIABLE $Agencia QUE SERA UNA LISTA CON UN SOLO VALOR ($id de la Agencia eliminada).

        return $this->Agencia;
    }
    public function ModificarAgencia($AgenciaID, $Nombre,$Direccion, $DireccionCoordenadas,$Telefono, $Email,  $Estado )
    {
        $this->Parametros = [
                'AgenciaID' => $AgenciaID,
                'Nombre' => $Nombre,
                'Direccion' => $Direccion,
                'DireccionCoordenadas' => $DireccionCoordenadas,
                'Telefono' => $Telefono,
                'Email' => $Email,
                'Estado' => $Estado,
                ];
        $this->setOperacion(self::Operacion_Modificacion);                                              //LLAMA AL METODO setOperacion y SETEA LA VARIABLE $operacionState CON UN OBJETO Modificacion() DE LA CLASE OPERACIONES.
        $this->Agencia = $this->OperacionState->EjecutarOperacion($this->Parametros,self::spABM);      //EJECUTA EL METODO EjecutarOperacion() DEL OBJETO OperacionState (un objeto Modifcacion()) Y LE PASA COMO PARAMETROS LA LISTA DE PARAMETROS Y LA CONSTANTE CON EL NOMBRE DEL STORED PROCEDURE DE ABM. GUARDA LA INFORMACION QUE DEVUELVE EN LA VARIABLE $Agencia QUE SERA UNA LISTA CON UN SOLO VALOR ($id de la Agencia modificada).
        return $this->Agencia;
    }
    public function GetInfoAgencia($AgenciaID, $Nombre,$Direccion, $DireccionCoordenadas,$Telefono, $Email, $Estado)
    {
        $this->Parametros = [
               'AgenciaID' => $AgenciaID,
                'Nombre' => $Nombre,
                'Direccion' => $Direccion,
                'DireccionCoordenadas' => $DireccionCoordenadas,
                'Telefono' => $Telefono,
                'Email' => $Email,
                'Estado' => $Estado,
                ];
        $this->setOperacion(self::Operacion_GetInfo);                                                   //LLAMA AL METODO setOperacion y SETEA LA VARIABLE $operacionState CON UN OBJETO Getinfo() DE LA CLASE OPERACIONES.
        $this->Agencia = $this->OperacionState->EjecutarOperacion($this->Parametros,self::spGetInfo);  //EJECUTA EL METODO EjecutarOperacion() DEL OBJETO OperacionState (un objeto GetInfo()) Y LE PASA COMO PARAMETROS LA LISTA DE PARAMETROS Y LA CONSTANTE CON EL NOMBRE DEL STORED PROCEDURE DE GETINFO. GUARDA LA INFORMACION QUE DEVUELVE EN LA VARIABLE $Personas QUE SERA UNA LISTA CON USUARIOS CUYOS VALORES SON LOS MISMOS QUE DEVUELVE EL STORED PROCEDURE.
        return $this->Agencia;                                                                  //SE RETORNA LA LISTA DE PERSONAS.
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
    }                                                  //ESTE METODO RECIBE LA CONSTANTE DE OPERACION Y SETEA LA VARIABLE OperacionState CON UN OBJETO, EL OBJETO SE CREA A PARTIR DE LA CLASE Operaciones.php y PUEDE SER ALTA, BAJA, MODIFICACION o GETINFO.
}


$test = new AgenciaModelo();
/*TEST GET INFO
print_r($test->GetInfoAgencia(-1,"","","","","",""));
*/


/*TEST ALTA
if($test->RegistrarAgencia("'LilianSilva'","'25 de mayo'", "'{101}'", "'42870730'","'lili@silva.com'", 0)!=null) echo 'Agencia registrada correctamente!';
*/

/*TEST MODIFICACION
if($test->ModificarAgencia(14,"'LilianLeonorSilva'","'25 de mayo'", "'{101}'", "'42870730'","'lilian@silva.com'", 0)!=null) echo 'Agencia modificada correctamente!';
*/

/*TEST BAJA
if($test->EliminarAgencia(14)!=null) echo 'Agencia eliminada correctamente!';
 */
