<?php
namespace app\models\CapaServicio;
use Yii;
use yii\base\Model;
use app\models\CapaServicio\ServicioBD\GetInfo;
use app\models\CapaServicio\ServicioBD\Alta;
use app\models\CapaServicio\ServicioBD\Baja;
use app\models\CapaServicio\ServicioBD\Modificacion;

/**
 * VehiculosModelo short summary.
 *
 * VehiculosModelo description.
 *
 * @version 1.0
 * @author mende
 */
class VehiculosModelo extends Model
{
    const Operacion_Alta = 0, Operacion_Modificacion=1, Operacion_Baja=2, Operacion_GetInfo=3;  //CONSTANTES QUE SIRVEN PARA UTILIZARLAS COMO REFERENCIA A CADA OPERACION.
    const spABM='Vehiculo_ABM', spGetInfo='Vehiculo_GetInfo';                                   //NOMBRES DE STORED PROCEDURES QUE SE UTILIZARAN EN EL MODELO.
    private $Operacion=null;                                                                    //VARIABLE AUXILIAR PARA GUARDAR LA CONSTANTE DE OPERACION QUE SE UTILIZARA COMO REFERENCIA.
    private $OperacionState=null;                                                               //VARIABLE QUE GUARDARA EL ESTADO DE LA OPERACION ACTUAL (ALTA, BAJA, MODIFICACION o GETINFO).
    private $Vehiculos=null;                                                                     //VARIABLE QUE SERVIRA PARA GUARDAR LAS VehiculoS QUE DEVUELVA EL METODO GETINFO.
    private $Parametros=null;                                                                   //VARIABLE QUE GUARDARA LOS PARAMETROS DEL STORED PROCEDURE



    public function RegistrarVehiculo($Matricula, $Modelo,$Marca, $Estado, $FechaAlta, $FechaBaja, $AgenciaID)                                               //ESTE METODO RECIBE UN Lista COMO PARAMETRO, LA Lista DEBE CONTENER LA MISMA CANTIDAD DE PARAMETROS QUE SE UTILIZAN EN EL STORE PROCEDURE CON LOS MISMOS NOMBRES EXCEPTUANDO LOS PARAMETROS (operacion, VehiculoID y @result).
    {
        $this->Parametros = [
            'Matricula'=> $Matricula,
            'Modelo'=> $Modelo,
            'Marca'=> $Marca,
            'Estado'=> $Estado,
            'FechaAlta'=> $FechaAlta,
            'FechaBaja'=> $FechaBaja,
            'AgenciaID'=> $AgenciaID,
              ];
        $this->setOperacion(self::Operacion_Alta);                                                      //LLAMA AL METODO setOperacion y SETEA LA VARIABLE $operacionState CON UN OBJETO Alta() DE LA CLASE OPERACIONES.
        $this->Vehiculos = $this->OperacionState->EjecutarOperacion($this->Parametros,self::spABM);      //EJECUTA EL METODO EjecutarOperacion() DEL OBJETO OperacionState (un objeto Alta()) Y LE PASA COMO PARAMETROS LA LISTA DE PARAMETROS Y LA CONSTANTE CON EL NOMBRE DEL STORED PROCEDURE DE ABM. GUARDA LA INFORMACION QUE DEVUELVE EN LA VARIABLE $Vehiculos QUE SERA UNA LISTA CON UN SOLO VALOR ($id de la Vehiculo insertada).
        return $this->Vehiculos;
    }
    public function EliminarVehiculo($VehiculoID)
    {
        $this->Parametros = [
            'VehiculoID'=> $VehiculoID,
            'Matricula'=> "",
            'Modelo'=> "",
            'Marca'=> "",
            'Estado'=> "",
            'FechaAlta'=> "",
            'FechaBaja'=> "",
            'AgenciaID'=> "",
              ];
        $this->setOperacion(self::Operacion_Baja);                                                    //LLAMA AL METODO setOperacion y SETEA LA VARIABLE $operacionState CON UN OBJETO Baja() DE LA CLASE OPERACIONES.
        $this->Vehiculos = $this->OperacionState->EjecutarOperacion($this->Parametros,self::spABM);    //EJECUTA EL METODO EjecutarOperacion() DEL OBJETO OperacionState (un objeto Baja()) Y LE PASA COMO PARAMETROS LA LISTA DE PARAMETROS Y LA CONSTANTE CON EL NOMBRE DEL STORED PROCEDURE DE ABM. GUARDA LA INFORMACION QUE DEVUELVE EN LA VARIABLE $Vehiculos QUE SERA UNA LISTA CON UN SOLO VALOR ($id de la Vehiculo eliminada).

        return $this->Vehiculos;
    }
    public function ModificarVehiculo($VehiculoID, $Matricula, $Modelo,$Marca, $Estado, $FechaAlta, $FechaBaja, $AgenciaID)
    {
        $this->Parametros = [
            'VehiculoID'=> $VehiculoID,
            'Matricula'=> $Matricula,
            'Modelo'=> $Modelo,
            'Marca'=> $Marca,
            'Estado'=> $Estado,
            'FechaAlta'=> $FechaAlta,
            'FechaBaja'=> $FechaBaja,
            'AgenciaID'=> $AgenciaID,
              ];
        $this->setOperacion(self::Operacion_Modificacion);                                              //LLAMA AL METODO setOperacion y SETEA LA VARIABLE $operacionState CON UN OBJETO Modificacion() DE LA CLASE OPERACIONES.
        $this->Vehiculos = $this->OperacionState->EjecutarOperacion($this->Parametros,self::spABM);      //EJECUTA EL METODO EjecutarOperacion() DEL OBJETO OperacionState (un objeto Modifcacion()) Y LE PASA COMO PARAMETROS LA LISTA DE PARAMETROS Y LA CONSTANTE CON EL NOMBRE DEL STORED PROCEDURE DE ABM. GUARDA LA INFORMACION QUE DEVUELVE EN LA VARIABLE $Vehiculos QUE SERA UNA LISTA CON UN SOLO VALOR ($id de la Vehiculo modificada).
        return $this->Vehiculos;
    }
    public function GetInfoVehiculos($VehiculoID, $Matricula, $Modelo,$Marca, $Estado, $FechaAltaDesde, $FechaAltaHasta, $AgenciaID, $SoloDisponibles)
    {
        $this->Parametros = [
            'VehiculoID'=> $VehiculoID,
            'Matricula'=> $Matricula,
            'Modelo'=> $Modelo,
            'Marca'=> $Marca,
            'Estado'=> $Estado,
            'FechaAltaDesde'=> $FechaAltaDesde,
            'FechaAltaHasta'=> $FechaAltaHasta,
            'AgenciaID'=> $AgenciaID,
            'SoloDisponibles'=> $SoloDisponibles,
              ];

        $this->setOperacion(self::Operacion_GetInfo);                                                   //LLAMA AL METODO setOperacion y SETEA LA VARIABLE $operacionState CON UN OBJETO Getinfo() DE LA CLASE OPERACIONES.
        $this->Vehiculos = $this->OperacionState->EjecutarOperacion($this->Parametros,self::spGetInfo);  //EJECUTA EL METODO EjecutarOperacion() DEL OBJETO OperacionState (un objeto GetInfo()) Y LE PASA COMO PARAMETROS LA LISTA DE PARAMETROS Y LA CONSTANTE CON EL NOMBRE DEL STORED PROCEDURE DE GETINFO. GUARDA LA INFORMACION QUE DEVUELVE EN LA VARIABLE $Vehiculos QUE SERA UNA LISTA CON USUARIOS CUYOS VALORES SON LOS MISMOS QUE DEVUELVE EL STORED PROCEDURE.
        return $this->Vehiculos;                                                                         //SE RETORNA LA LISTA DE VehiculoS.
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
$test = new VehiculosModelo();
TEST GET INFO
print_r($test->GetInfoVehiculos("","","","","","","","",""));
 */



/*TEST REGISTRAR
if($test->RegistrarVehiculo(1,1,1,1,1,1,"'2010-01-01'","'2020-01-01'",0,"'{}'","'{}'","''","''","'nada'",100,20,0,1)!=null) echo 'Cliente registrado correctamente!';
 */

/*TEST MODIFICACION
if($test->RegistrarVehiculo(4,2,2,1,1,1,1,"'2010-01-01'","'2020-01-01'",0,"'{}'","'{}'","''","''","'nada'",100,20,0,1)!=null) echo 'Cliente modificado correctamente!';
 */

/*TEST ELIMINAR
if($test->EliminarVehiculo(4)!=null) echo 'Cliente eliminado correctamente!';
 */
