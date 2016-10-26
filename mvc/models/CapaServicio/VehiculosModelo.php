<?php
namespace app\models;
include('ServicioBD/Operaciones.php');
use Yii;
use yii\base\Model;

/**
 * ViajesModelo short summary.
 *
 * ViajesModelo description.
 *
 * @version 1.0
 * @author mende
 */
class ViajesModelo extends Model
{
    const Operacion_Alta = 0, Operacion_Modificacion=1, Operacion_Baja=2, Operacion_GetInfo=3;  //CONSTANTES QUE SIRVEN PARA UTILIZARLAS COMO REFERENCIA A CADA OPERACION.
    const spABM='Viaje_ABM', spGetInfo='Viaje_GetInfo';                                   //NOMBRES DE STORED PROCEDURES QUE SE UTILIZARAN EN EL MODELO.
    private $Operacion=null;                                                                    //VARIABLE AUXILIAR PARA GUARDAR LA CONSTANTE DE OPERACION QUE SE UTILIZARA COMO REFERENCIA.
    private $OperacionState=null;                                                               //VARIABLE QUE GUARDARA EL ESTADO DE LA OPERACION ACTUAL (ALTA, BAJA, MODIFICACION o GETINFO).
    private $Viajes=null;                                                                     //VARIABLE QUE SERVIRA PARA GUARDAR LAS ViajeS QUE DEVUELVA EL METODO GETINFO.
    private $Parametros=null;                                                                   //VARIABLE QUE GUARDARA LOS PARAMETROS DEL STORED PROCEDURE



    public function RegistrarViaje($ChoferID, $VehiculoID,$TarifaID, $TurnoID, $AgenciaID, $PersonaID, $FechaEmision,$FechaSalida, $ViajeTipo, $OrigenCoordenadas, $DestinoCoordenadas, $OrigenDireccion, $DestinoDireccion, $Comentario, $ImporteTotal, $Distancia, $Estado)                                               //ESTE METODO RECIBE UN Lista COMO PARAMETRO, LA Lista DEBE CONTENER LA MISMA CANTIDAD DE PARAMETROS QUE SE UTILIZAN EN EL STORE PROCEDURE CON LOS MISMOS NOMBRES EXCEPTUANDO LOS PARAMETROS (operacion, ViajeID y @result).
    {
        $this->Parametros = [
    'ChoferID'=> $ChoferID,
    'VehiculoID'=> $VehiculoID,
    'TarifaID'=> $TarifaID,
    'TurnoID'=> $TurnoID,
    'AgenciaID'=> $AgenciaID,
    'PersonaID'=> $PersonaID,
    'FechaEmision'=> $FechaEmision,
    'FechaSalida'=> $FechaSalida,
    'ViajeTipo'=> $ViajeTipo,
    'OrigenCoordenadas'=> $OrigenCoordenadas,
    'DestinoCoordenadas'=> $DestinoCoordenadas,
    'OrigenDireccion'=> $OrigenDireccion,
    'DestinoDireccion'=> $DestinoDireccion,
    'Comentario'=> $Comentario,
    'ImporteTotal'=> $ImporteTotal,
    'Distancia'=> $Distancia,
    'Estado'=> $Estado
      ];
        $this->setOperacion(self::Operacion_Alta);                                                      //LLAMA AL METODO setOperacion y SETEA LA VARIABLE $operacionState CON UN OBJETO Alta() DE LA CLASE OPERACIONES.
        $this->Viajes = $this->OperacionState->EjecutarOperacion($this->Parametros,self::spABM);      //EJECUTA EL METODO EjecutarOperacion() DEL OBJETO OperacionState (un objeto Alta()) Y LE PASA COMO PARAMETROS LA LISTA DE PARAMETROS Y LA CONSTANTE CON EL NOMBRE DEL STORED PROCEDURE DE ABM. GUARDA LA INFORMACION QUE DEVUELVE EN LA VARIABLE $Viajes QUE SERA UNA LISTA CON UN SOLO VALOR ($id de la Viaje insertada).
        return $this->Viajes;
    }
    public function EliminarViaje($ViajeID)
    {
        $this->Parametros = [
    'ViajeID'=> $ViajeID,
    'ChoferID'=> "",
    'VehiculoID'=> "",
    'TarifaID'=> "",
    'TurnoID'=> "",
    'AgenciaID'=> "",
    'PersonaID'=> "",
    'FechaEmision'=> "",
    'FechaSalida'=> "",
    'ViajeTipo'=> "",
    'OrigenCoordenadas'=> "",
    'DestinoCoordenadas'=> "",
    'OrigenDireccion'=> "",
    'DestinoDireccion'=> "",
    'Comentario'=> "",
    'ImporteTotal'=> "",
    'Distancia'=> "",
    'Estado'=> ""
      ];
        $this->setOperacion(self::Operacion_Baja);                                                    //LLAMA AL METODO setOperacion y SETEA LA VARIABLE $operacionState CON UN OBJETO Baja() DE LA CLASE OPERACIONES.
        $this->Viajes = $this->OperacionState->EjecutarOperacion($this->Parametros,self::spABM);    //EJECUTA EL METODO EjecutarOperacion() DEL OBJETO OperacionState (un objeto Baja()) Y LE PASA COMO PARAMETROS LA LISTA DE PARAMETROS Y LA CONSTANTE CON EL NOMBRE DEL STORED PROCEDURE DE ABM. GUARDA LA INFORMACION QUE DEVUELVE EN LA VARIABLE $Viajes QUE SERA UNA LISTA CON UN SOLO VALOR ($id de la Viaje eliminada).

        return $this->Viajes;
    }
    public function ModificarViaje($ViajeID, $ChoferID, $VehiculoID,$TarifaID, $TurnoID, $AgenciaID, $PersonaID, $FechaEmision,$FechaSalida, $ViajeTipo, $OrigenCoordenadas, $DestinoCoordenadas, $OrigenDireccion, $DestinoDireccion, $Comentario, $ImporteTotal, $Distancia, $Estado)
    {
        $this->Parametros = [
            'ViajeID'=> $ViajeID,
            'ChoferID'=> $ChoferID,
            'VehiculoID'=> $VehiculoID,
            'TarifaID'=> $TarifaID,
            'TurnoID'=> $TurnoID,
            'AgenciaID'=> $AgenciaID,
            'PersonaID'=> $PersonaID,
            'FechaEmision'=> $FechaEmision,
            'FechaSalida'=> $FechaSalida,
            'ViajeTipo'=> $ViajeTipo,
            'OrigenCoordenadas'=> $OrigenCoordenadas,
            'DestinoCoordenadas'=> $DestinoCoordenadas,
            'OrigenDireccion'=> $OrigenDireccion,
            'DestinoDireccion'=> $DestinoDireccion,
            'Comentario'=> $Comentario,
            'ImporteTotal'=> $ImporteTotal,
            'Distancia'=> $Distancia,
            'Estado'=> $Estado
        ];
        $this->setOperacion(self::Operacion_Modificacion);                                              //LLAMA AL METODO setOperacion y SETEA LA VARIABLE $operacionState CON UN OBJETO Modificacion() DE LA CLASE OPERACIONES.
        $this->Viajes = $this->OperacionState->EjecutarOperacion($this->Parametros,self::spABM);      //EJECUTA EL METODO EjecutarOperacion() DEL OBJETO OperacionState (un objeto Modifcacion()) Y LE PASA COMO PARAMETROS LA LISTA DE PARAMETROS Y LA CONSTANTE CON EL NOMBRE DEL STORED PROCEDURE DE ABM. GUARDA LA INFORMACION QUE DEVUELVE EN LA VARIABLE $Viajes QUE SERA UNA LISTA CON UN SOLO VALOR ($id de la Viaje modificada).
        return $this->Viajes;
    }
    public function GetInfoViajes($ViajeID, $ChoferID, $VehiculoID,$TarifaID, $TurnoID, $AgenciaID, $PersonaID, $FechaEmisionDesde, $FechaEmisionHasta, $FechaSalidaDesde, $FechaSalidaHasta, $ViajeTipo, $OrigenCoordenadas, $DestinoCoordenadas, $OrigenDireccion, $DestinoDireccion, $Comentario, $ImporteTotal, $Distancia, $Estado)
    {
        $this->Parametros = [
            'ViajeID'=> $ViajeID,
            'ChoferID'=> $ChoferID,
            'VehiculoID'=> $VehiculoID,
            'TarifaID'=> $TarifaID,
            'TurnoID'=> $TurnoID,
            'AgenciaID'=> $AgenciaID,
            'PersonaID'=> $PersonaID,
            'FechaEmisionDesde'=> $FechaEmisionDesde,
            'FechaEmisionHasta'=> $FechaEmisionHasta,
            'FechaSalidaDesde'=> $FechaSalidaDesde,
            'FechaSalidaHasta'=> $FechaSalidaHasta,
            'ViajeTipo'=> $ViajeTipo,
            'OrigenCoordenadas'=> $OrigenCoordenadas,
            'DestinoCoordenadas'=> $DestinoCoordenadas,
            'OrigenDireccion'=> $OrigenDireccion,
            'DestinoDireccion'=> $DestinoDireccion,
            'Comentario'=> $Comentario,
            'ImporteTotal'=> $ImporteTotal,
            'Distancia'=> $Distancia,
            'Estado'=> $Estado
              ];

        $this->setOperacion(self::Operacion_GetInfo);                                                   //LLAMA AL METODO setOperacion y SETEA LA VARIABLE $operacionState CON UN OBJETO Getinfo() DE LA CLASE OPERACIONES.
        $this->Viajes = $this->OperacionState->EjecutarOperacion($this->Parametros,self::spGetInfo);  //EJECUTA EL METODO EjecutarOperacion() DEL OBJETO OperacionState (un objeto GetInfo()) Y LE PASA COMO PARAMETROS LA LISTA DE PARAMETROS Y LA CONSTANTE CON EL NOMBRE DEL STORED PROCEDURE DE GETINFO. GUARDA LA INFORMACION QUE DEVUELVE EN LA VARIABLE $Viajes QUE SERA UNA LISTA CON USUARIOS CUYOS VALORES SON LOS MISMOS QUE DEVUELVE EL STORED PROCEDURE.
        return $this->Viajes;                                                                         //SE RETORNA LA LISTA DE ViajeS.
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
$test = new ViajesModelo();
TEST GET INFO
print_r($test->GetInfoViajes(-1,-1,-1,-1,-1,-1,-1,"","","","",-1,"","","","","",-1,-1,-1));
 */



/*TEST REGISTRAR
if($test->RegistrarViaje(1,1,1,1,1,1,"'2010-01-01'","'2020-01-01'",0,"'{}'","'{}'","''","''","'nada'",100,20,0)!=null) echo 'Cliente registrado correctamente!';
 */

/*TEST MODIFICACION
if($test->RegistrarViaje(4,2,2,1,1,1,1,"'2010-01-01'","'2020-01-01'",0,"'{}'","'{}'","''","''","'nada'",100,20,0)!=null) echo 'Cliente modificado correctamente!';
 */

/*TEST ELIMINAR
if($test->EliminarViaje(4)!=null) echo 'Cliente eliminado correctamente!';
 */
