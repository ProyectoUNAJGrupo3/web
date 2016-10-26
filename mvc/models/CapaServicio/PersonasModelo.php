<?php
namespace app\models;
include('ServicioBD/Operaciones.php');
use Yii;
use yii\base\Model;

/**
 * PersonasModelo short summary.
 *
 * PersonasModelo description.
 *
 * @version 1.0
 * @author mende
 */
class PersonasModelo extends Model
{
    const Operacion_Alta = 0, Operacion_Modificacion=1, Operacion_Baja=2, Operacion_GetInfo=3;  //CONSTANTES QUE SIRVEN PARA UTILIZARLAS COMO REFERENCIA A CADA OPERACION.
    const spABM='Personas_ABM', spGetInfo='Personas_GetInfo';                                   //NOMBRES DE STORED PROCEDURES QUE SE UTILIZARAN EN EL MODELO.
    private $Operacion=null;                                                                    //VARIABLE AUXILIAR PARA GUARDAR LA CONSTANTE DE OPERACION QUE SE UTILIZARA COMO REFERENCIA.
    private $OperacionState=null;                                                               //VARIABLE QUE GUARDARA EL ESTADO DE LA OPERACION ACTUAL (ALTA, BAJA, MODIFICACION o GETINFO).
    private $Personas=null;                                                                     //VARIABLE QUE SERVIRA PARA GUARDAR LAS PERSONAS QUE DEVUELVA EL METODO GETINFO.
    private $Parametros=null;                                                                   //VARIABLE QUE GUARDARA LOS PARAMETROS DEL STORED PROCEDURE



    public function RegistrarPersona($Nombre, $Apellido,$Usuario,$Password, $Telefono, $Email, $Direccion, $DireccionCoordenadas, $DireccionDefault, $Estado, $RolID, $Documento, $AgenciaID)                                               //ESTE METODO RECIBE UN Lista COMO PARAMETRO, LA Lista DEBE CONTENER LA MISMA CANTIDAD DE PARAMETROS QUE SE UTILIZAN EN EL STORE PROCEDURE CON LOS MISMOS NOMBRES EXCEPTUANDO LOS PARAMETROS (operacion, PersonaID y @result).
    {
        $this->Parametros = [
                'Nombre' => $Nombre,
                'Apellido' => $Apellido,
                'Usuario' => $Usuario,
                'Password' => $Password,
                'Telefono' => $Telefono,
                'Email' => $Email,
                'Direccion' => $Direccion,
                'DireccionCoordenadas' => $DireccionCoordenadas,
                'DireccionDefault' => $DireccionDefault,
                'Estado' =>$Estado,
                'RolID' =>$RolID,
                'Documento' =>$Documento,
                'AgenciaID' =>$AgenciaID,
                ];
        $this->setOperacion(self::Operacion_Alta);                                                      //LLAMA AL METODO setOperacion y SETEA LA VARIABLE $operacionState CON UN OBJETO Alta() DE LA CLASE OPERACIONES.
        $this->Personas = $this->OperacionState->EjecutarOperacion($this->Parametros,self::spABM);      //EJECUTA EL METODO EjecutarOperacion() DEL OBJETO OperacionState (un objeto Alta()) Y LE PASA COMO PARAMETROS LA LISTA DE PARAMETROS Y LA CONSTANTE CON EL NOMBRE DEL STORED PROCEDURE DE ABM. GUARDA LA INFORMACION QUE DEVUELVE EN LA VARIABLE $Personas QUE SERA UNA LISTA CON UN SOLO VALOR ($id de la persona insertada).
        return $this->Personas;
    }
    public function EliminarPersona($PersonaID)
    {
        $this->Parametros = [
                'PersonaID' => $PersonaID,
                'Nombre' => "",
                'Apellido' => "",
                'Usuario' => "",
                'Password' => "",
                'Telefono' => "",
                'Email' => "",
                'Direccion' => "",
                'DireccionCoordenadas' => "",
                'DireccionDefault' => "",
                'Estado' =>"",
                'RolID' =>"",
                'Documento' =>"",
                'AgenciaID' =>"",
                ];
        $this->setOperacion(self::Operacion_Baja);                                                    //LLAMA AL METODO setOperacion y SETEA LA VARIABLE $operacionState CON UN OBJETO Baja() DE LA CLASE OPERACIONES.
        $this->Personas = $this->OperacionState->EjecutarOperacion($this->Parametros,self::spABM);    //EJECUTA EL METODO EjecutarOperacion() DEL OBJETO OperacionState (un objeto Baja()) Y LE PASA COMO PARAMETROS LA LISTA DE PARAMETROS Y LA CONSTANTE CON EL NOMBRE DEL STORED PROCEDURE DE ABM. GUARDA LA INFORMACION QUE DEVUELVE EN LA VARIABLE $Personas QUE SERA UNA LISTA CON UN SOLO VALOR ($id de la persona eliminada).

        return $this->Personas;
    }
    public function ModificarPersona($PersonaID, $Nombre, $Apellido, $Usuario,$Password, $Telefono, $Email, $Direccion, $DireccionCoordenadas, $DireccionDefault, $DireccionTipo, $Estado, $RolID, $Documento, $AgenciaID)
    {
        $this->Parametros = [
                'PersonaID' => $PersonaID,
                'Nombre' => $Nombre,
                'Apellido' => $Apellido,
                'Usuario' => $Usuario,
                'Password' => $Password,
                'Telefono' => $Telefono,
                'Email' => $Email,
                'Direccion' => $Direccion,
                'DireccionCoordenadas' => $DireccionCoordenadas,
                'DireccionDefault' => $DireccionDefault,
                'Estado' =>$Estado,
                'RolID' =>$RolID,
                'Documento' =>$Documento,
                'AgenciaID' =>$AgenciaID,
                ];
        $this->setOperacion(self::Operacion_Modificacion);                                              //LLAMA AL METODO setOperacion y SETEA LA VARIABLE $operacionState CON UN OBJETO Modificacion() DE LA CLASE OPERACIONES.
        $this->Personas = $this->OperacionState->EjecutarOperacion($this->Parametros,self::spABM);      //EJECUTA EL METODO EjecutarOperacion() DEL OBJETO OperacionState (un objeto Modifcacion()) Y LE PASA COMO PARAMETROS LA LISTA DE PARAMETROS Y LA CONSTANTE CON EL NOMBRE DEL STORED PROCEDURE DE ABM. GUARDA LA INFORMACION QUE DEVUELVE EN LA VARIABLE $Personas QUE SERA UNA LISTA CON UN SOLO VALOR ($id de la persona modificada).
        return $this->Personas;
    }
    public function GetInfoPersonas($PersonaID, $Nombre, $Apellido,$Usuario, $Telefono, $Email, $Direccion, $DireccionCoordenadas, $Estado, $RolID, $Documento, $AgenciaID)
    {
        $this->Parametros = [
                'PersonaID' => $PersonaID,
                'Nombre' => $Nombre,
                'Apellido' => $Apellido,
                'Usuario' => $Usuario,
                'Telefono' => $Telefono,
                'Email' => $Email,
                'Direccion' => $Direccion,
                'DireccionCoordenadas' => $DireccionCoordenadas,
                'Estado' =>$Estado,
                'RolID' =>$RolID,
                'Documento' =>$Documento,
                'AgenciaID' =>$AgenciaID,
                ];
        $this->setOperacion(self::Operacion_GetInfo);                                                   //LLAMA AL METODO setOperacion y SETEA LA VARIABLE $operacionState CON UN OBJETO Getinfo() DE LA CLASE OPERACIONES.
        $this->Personas = $this->OperacionState->EjecutarOperacion($this->Parametros,self::spGetInfo);  //EJECUTA EL METODO EjecutarOperacion() DEL OBJETO OperacionState (un objeto GetInfo()) Y LE PASA COMO PARAMETROS LA LISTA DE PARAMETROS Y LA CONSTANTE CON EL NOMBRE DEL STORED PROCEDURE DE GETINFO. GUARDA LA INFORMACION QUE DEVUELVE EN LA VARIABLE $Personas QUE SERA UNA LISTA CON USUARIOS CUYOS VALORES SON LOS MISMOS QUE DEVUELVE EL STORED PROCEDURE.
        return $this->Personas;                                                                         //SE RETORNA LA LISTA DE PERSONAS.
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

/*
$test = new PersonasModelo();
TEST GET INFO
print_r($test->GetInfoPersonas(-1,"","","","","","","","",""));
 */



/*TEST REGISTRAR
if($test->RegistrarPersona("'Son'","'Goku'","'ssj3'", "'ssj3'","'42134213'", "'supersaiyan@tierra.com'", "'Monta?a paos'","'{fjdsi}'",0,0,4)!=null) echo 'Cliente registrado correctamente!';
 */

/*TEST MODIFICACION
if($test->ModificarPersona(72,"'Santino Alejandro'","'pempin'", "'pempin'","'2543654'", "'prueba@pepe.com'", "'Calle appsp'","'{fjdsi}'",0,0,4)!=null) echo 'Cliente modificado correctamente!';
 */

/*TEST ELIMINAR
if($test->EliminarPersona(72)!=null) echo 'Cliente eliminado correctamente!';
 */
