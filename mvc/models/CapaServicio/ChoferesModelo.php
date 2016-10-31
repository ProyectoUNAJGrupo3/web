<?php
namespace app\models\CapaServicio;
use Yii;
use yii\base\Model;
use app\models\CapaServicio\ServicioBD\GetInfo;
use app\models\CapaServicio\ServicioBD\Alta;
use app\models\CapaServicio\ServicioBD\Baja;
use app\models\CapaServicio\ServicioBD\Modificacion;

/**
 * ChoferesModelo short summary.
 *
 * ChoferesModelo description.
 *
 * @version 1.0
 * @author mende
 */
class ChoferesModelo extends Model
{
    const Operacion_Alta = 0, Operacion_Modificacion=1, Operacion_Baja=2, Operacion_GetInfo=3;  //CONSTANTES QUE SIRVEN PARA UTILIZARLAS COMO REFERENCIA A CADA OPERACION.
    const spABM='Chofer_ABM', spGetInfo='Chofer_GetInfo';                                   //NOMBRES DE STORED PROCEDURES QUE SE UTILIZARAN EN EL MODELO.
    private $Operacion=null;                                                                    //VARIABLE AUXILIAR PARA GUARDAR LA CONSTANTE DE OPERACION QUE SE UTILIZARA COMO REFERENCIA.
    private $OperacionState=null;                                                               //VARIABLE QUE GUARDARA EL ESTADO DE LA OPERACION ACTUAL (ALTA, BAJA, MODIFICACION o GETINFO).
    private $Choferes=null;                                                                     //VARIABLE QUE SERVIRA PARA GUARDAR LAS ChofereS QUE DEVUELVA EL METODO GETINFO.
    private $Parametros=null;                                                                   //VARIABLE QUE GUARDARA LOS PARAMETROS DEL STORED PROCEDURE



    public function RegistrarChofer($Nombre,$Apellido,$Documento,$Usuario,$Password, $Telefono,$Email,$Estado, $AgenciaID/*, $VehiculoID*/)                                               //ESTE METODO RECIBE UN Lista COMO PARAMETRO, LA Lista DEBE CONTENER LA MISMA CANTIDAD DE PARAMETROS QUE SE UTILIZAN EN EL STORE PROCEDURE CON LOS MISMOS NOMBRES EXCEPTUANDO LOS PARAMETROS (operacion, ChofereID y @result).
    {
        $this->Parametros = [
                'Nombre'=>$Nombre         ,
                'Apellido'=>$Apellido       ,
                'Documento'=>$Documento      ,
	            'Usuario'=>$Usuario        ,
                'Password'=>$Password,
                'Telefono'=>$Telefono       ,
                'Email'=>$Email          ,
                'Estado'=>$Estado         ,
                'AgenciaID'=>$AgenciaID      ,
                /*'VehiculoID'=>$VehiculoID     ,*/
                ];
        $this->setOperacion(self::Operacion_Alta);                                                      //LLAMA AL METODO setOperacion y SETEA LA VARIABLE $operacionState CON UN OBJETO Alta() DE LA CLASE OPERACIONES.
        $this->Choferes = $this->OperacionState->EjecutarOperacion($this->Parametros,self::spABM);      //EJECUTA EL METODO EjecutarOperacion() DEL OBJETO OperacionState (un objeto Alta()) Y LE PASA COMO PARAMETROS LA LISTA DE PARAMETROS Y LA CONSTANTE CON EL NOMBRE DEL STORED PROCEDURE DE ABM. GUARDA LA INFORMACION QUE DEVUELVE EN LA VARIABLE $Choferes QUE SERA UNA LISTA CON UN SOLO VALOR ($id de la Chofere insertada).
        return $this->Choferes;
    }
    public function EliminarChofer($PersonaID)
    {
        $this->Parametros = [
                'PersonaID'=>$PersonaID      ,
                'Nombre'=>NULL,
                'Apellido'=>NULL,
                'Documento'=>NULL,
	            'Usuario'=>NULL,
                'Password'=>NULL,
                'Telefono'=>NULL,
                'Email'=>NULL ,
                'Estado'=>NULL ,
                'AgenciaID'=>NULL,
                /*'VehiculoID'=>NULL,*/
                ];
        $this->setOperacion(self::Operacion_Baja);                                                    //LLAMA AL METODO setOperacion y SETEA LA VARIABLE $operacionState CON UN OBJETO Baja() DE LA CLASE OPERACIONES.
        $this->Choferes = $this->OperacionState->EjecutarOperacion($this->Parametros,self::spABM);    //EJECUTA EL METODO EjecutarOperacion() DEL OBJETO OperacionState (un objeto Baja()) Y LE PASA COMO PARAMETROS LA LISTA DE PARAMETROS Y LA CONSTANTE CON EL NOMBRE DEL STORED PROCEDURE DE ABM. GUARDA LA INFORMACION QUE DEVUELVE EN LA VARIABLE $Choferes QUE SERA UNA LISTA CON UN SOLO VALOR ($id de la Chofere eliminada).

        return $this->Choferes;
    }
    public function ModificarChofer($PersonaID, $Nombre,$Apellido,$Documento,$Usuario,$Password, $Telefono,$Email,$Estado, $AgenciaID/*, $VehiculoID*/)
    {
        $this->Parametros = [
                'PersonaID'=>$PersonaID      ,
                'Nombre'=>$Nombre         ,
                'Apellido'=>$Apellido       ,
                'Documento'=>$Documento      ,
	            'Usuario'=>$Usuario        ,
                'Password'=>$Password,
                'Telefono'=>$Telefono       ,
                'Email'=>$Email          ,
                'Estado'=>$Estado         ,
                'AgenciaID'=>$AgenciaID      ,
                /*'VehiculoID'=>$VehiculoID     ,*/
                ];
        $this->setOperacion(self::Operacion_Modificacion);                                              //LLAMA AL METODO setOperacion y SETEA LA VARIABLE $operacionState CON UN OBJETO Modificacion() DE LA CLASE OPERACIONES.
        $this->Choferes = $this->OperacionState->EjecutarOperacion($this->Parametros,self::spABM);      //EJECUTA EL METODO EjecutarOperacion() DEL OBJETO OperacionState (un objeto Modifcacion()) Y LE PASA COMO PARAMETROS LA LISTA DE PARAMETROS Y LA CONSTANTE CON EL NOMBRE DEL STORED PROCEDURE DE ABM. GUARDA LA INFORMACION QUE DEVUELVE EN LA VARIABLE $Choferes QUE SERA UNA LISTA CON UN SOLO VALOR ($id de la Chofere modificada).
        return $this->Choferes;
    }
    public function GetInfoChoferes($PersonaID,$Nombre,$Apellido,$Documento,$Usuario,$Telefono,$Email,$Estado, $AgenciaID/*, $VehiculoID*/, $SoloDisponibles)
    {
        $this->Parametros = [
                'PersonaID'=>$PersonaID      ,
                'Nombre'=>$Nombre         ,
                'Apellido'=>$Apellido       ,
                'Documento'=>$Documento      ,
	            'Usuario'=>$Usuario        ,
                'Telefono'=>$Telefono       ,
                'Email'=>$Email          ,
                'Estado'=>$Estado         ,
                'AgenciaID'=>$AgenciaID      ,
                /*'VehiculoID'=>$VehiculoID     ,*/
                'SoloDisponibles'=>$SoloDisponibles
                ];

        $this->setOperacion(self::Operacion_GetInfo);                                                   //LLAMA AL METODO setOperacion y SETEA LA VARIABLE $operacionState CON UN OBJETO Getinfo() DE LA CLASE OPERACIONES.
        $this->Choferes = $this->OperacionState->EjecutarOperacion($this->Parametros,self::spGetInfo);  //EJECUTA EL METODO EjecutarOperacion() DEL OBJETO OperacionState (un objeto GetInfo()) Y LE PASA COMO PARAMETROS LA LISTA DE PARAMETROS Y LA CONSTANTE CON EL NOMBRE DEL STORED PROCEDURE DE GETINFO. GUARDA LA INFORMACION QUE DEVUELVE EN LA VARIABLE $Choferes QUE SERA UNA LISTA CON USUARIOS CUYOS VALORES SON LOS MISMOS QUE DEVUELVE EL STORED PROCEDURE.
        return $this->Choferes;                                                                         //SE RETORNA LA LISTA DE ChofereS.
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
$test = new ChoferesModelo();
TEST GET INFO
print_r($test->GetInfoChoferes(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL));
 */



/*TEST REGISTRAR
if($test->RegistrarChofer(0,NULL, 'J Fangio', 'Fangio', 'fanngio', 'fanngio', '4422331122', 'jgjgfancio@hotmail.com', 0, '413215434532', 2)!=null) echo 'Cliente registrado correctamente!';
 */

/*TEST MODIFICACION
if($test->ModificarChofere(72,"'Santino Alejandro'","'pempin'", "'pempin'","'2543654'", "'prueba@pepe.com'", "'Calle appsp'","'{fjdsi}'",0,0,4)!=null) echo 'Cliente modificado correctamente!';
 */

/*TEST ELIMINAR
if($test->EliminarChofere(72)!=null) echo 'Cliente eliminado correctamente!';
 */
