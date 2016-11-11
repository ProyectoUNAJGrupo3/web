<?php
namespace app\models\CapaServicio;
use Yii;
use yii\base\Model;
use app\models\CapaServicio\ServicioBD\GetInfo;
use app\models\CapaServicio\ServicioBD\Alta;
use app\models\CapaServicio\ServicioBD\Baja;
use app\models\CapaServicio\ServicioBD\Modificacion;

/**
 * TarifasModelo short summary.
 *
 * TarifasModelo description.
 *
 * @version 1.0
 * @author mende
 */
class TarifasModelo extends Model
{
    const Operacion_Alta = 0, Operacion_Modificacion=1, Operacion_Baja=2, Operacion_GetInfo=3;  //CONSTANTES QUE SIRVEN PARA UTILIZARLAS COMO REFERENCIA A CADA OPERACION.
    const spABM='Tarifa_ABM', spGetInfo='Tarifa_GetInfo';                                   //NOMBRES DE STORED PROCEDURES QUE SE UTILIZARAN EN EL MODELO.
    private $Operacion=null;                                                                    //VARIABLE AUXILIAR PARA GUARDAR LA CONSTANTE DE OPERACION QUE SE UTILIZARA COMO REFERENCIA.
    private $OperacionState=null;                                                               //VARIABLE QUE GUARDARA EL ESTADO DE LA OPERACION ACTUAL (ALTA, BAJA, MODIFICACION o GETINFO).
    private $Tarifas=null;                                                                     //VARIABLE QUE SERVIRA PARA GUARDAR LAS TarifaS QUE DEVUELVA EL METODO GETINFO.
    private $Parametros=null;                                                                   //VARIABLE QUE GUARDARA LOS PARAMETROS DEL STORED PROCEDURE



    public function RegistrarTarifa($Comision, $AgenciaID,$ViajeMinimo, $KmMinimo, $PrecioKM, $Estado)                                               //ESTE METODO RECIBE UN Lista COMO PARAMETRO, LA Lista DEBE CONTENER LA MISMA CANTIDAD DE PARAMETROS QUE SE UTILIZAN EN EL STORE PROCEDURE CON LOS MISMOS NOMBRES EXCEPTUANDO LOS PARAMETROS (operacion, TarifaID y @result).
    {
        $this->Parametros = [
            'Comision'=> $Comision,
            'AgenciaID'=> $AgenciaID,
            'ViajeMinimo'=> $ViajeMinimo,
            'KmMinimo'=> $KmMinimo,
            'PrecioKM'=> $PrecioKM,
            'Estado'=> $Estado,
      ];
        $this->setOperacion(self::Operacion_Alta);                                                      //LLAMA AL METODO setOperacion y SETEA LA VARIABLE $operacionState CON UN OBJETO Alta() DE LA CLASE OPERACIONES.
        $this->Tarifas = $this->OperacionState->EjecutarOperacion($this->Parametros,self::spABM);      //EJECUTA EL METODO EjecutarOperacion() DEL OBJETO OperacionState (un objeto Alta()) Y LE PASA COMO PARAMETROS LA LISTA DE PARAMETROS Y LA CONSTANTE CON EL NOMBRE DEL STORED PROCEDURE DE ABM. GUARDA LA INFORMACION QUE DEVUELVE EN LA VARIABLE $Tarifas QUE SERA UNA LISTA CON UN SOLO VALOR ($id de la Tarifa insertada).
        return $this->Tarifas;
    }
    public function EliminarTarifa($TarifaID)
    {
        $this->Parametros = [
            'TarifaID'=> $TarifaID,
            'Comision'=> NULL,
            'AgenciaID'=> NULL,
            'ViajeMinimo'=> NULL,
            'KmMinimo'=> NULL,
            'PrecioKM'=> NULL,
            'Estado'=> NULL,
              ];
        $this->setOperacion(self::Operacion_Baja);                                                    //LLAMA AL METODO setOperacion y SETEA LA VARIABLE $operacionState CON UN OBJETO Baja() DE LA CLASE OPERACIONES.
        $this->Tarifas = $this->OperacionState->EjecutarOperacion($this->Parametros,self::spABM);    //EJECUTA EL METODO EjecutarOperacion() DEL OBJETO OperacionState (un objeto Baja()) Y LE PASA COMO PARAMETROS LA LISTA DE PARAMETROS Y LA CONSTANTE CON EL NOMBRE DEL STORED PROCEDURE DE ABM. GUARDA LA INFORMACION QUE DEVUELVE EN LA VARIABLE $Tarifas QUE SERA UNA LISTA CON UN SOLO VALOR ($id de la Tarifa eliminada).

        return $this->Tarifas;
    }
    public function ModificarTarifa($TarifaID, $Comision, $AgenciaID,$ViajeMinimo, $KmMinimo, $PrecioKM, $Estado)
    {
        $this->Parametros = [
            'TarifaID'=> $TarifaID,
            'Comision'=> $Comision,
            'AgenciaID'=> $AgenciaID,
            'ViajeMinimo'=> $ViajeMinimo,
            'KmMinimo'=> $KmMinimo,
            'PrecioKM'=> $PrecioKM,
            'Estado'=> $Estado,
              ];
        $this->setOperacion(self::Operacion_Modificacion);                                              //LLAMA AL METODO setOperacion y SETEA LA VARIABLE $operacionState CON UN OBJETO Modificacion() DE LA CLASE OPERACIONES.
        $this->Tarifas = $this->OperacionState->EjecutarOperacion($this->Parametros,self::spABM);      //EJECUTA EL METODO EjecutarOperacion() DEL OBJETO OperacionState (un objeto Modifcacion()) Y LE PASA COMO PARAMETROS LA LISTA DE PARAMETROS Y LA CONSTANTE CON EL NOMBRE DEL STORED PROCEDURE DE ABM. GUARDA LA INFORMACION QUE DEVUELVE EN LA VARIABLE $Tarifas QUE SERA UNA LISTA CON UN SOLO VALOR ($id de la Tarifa modificada).
        return $this->Tarifas;
    }
    public function GetInfoTarifas($TarifaID, $Comision, $AgenciaID,$ViajeMinimo, $KmMinimo, $PrecioKM, $Estado)
    {
        $this->Parametros = [
            'TarifaID'=> $TarifaID,
            'Comision'=> $Comision,
            'AgenciaID'=> $AgenciaID,
            'ViajeMinimo'=> $ViajeMinimo,
            'KmMinimo'=> $KmMinimo,
            'PrecioKM'=> $PrecioKM,
            'Estado'=> $Estado,
              ];

        $this->setOperacion(self::Operacion_GetInfo);                                                   //LLAMA AL METODO setOperacion y SETEA LA VARIABLE $operacionState CON UN OBJETO Getinfo() DE LA CLASE OPERACIONES.
        $this->Tarifas = $this->OperacionState->EjecutarOperacion($this->Parametros,self::spGetInfo);  //EJECUTA EL METODO EjecutarOperacion() DEL OBJETO OperacionState (un objeto GetInfo()) Y LE PASA COMO PARAMETROS LA LISTA DE PARAMETROS Y LA CONSTANTE CON EL NOMBRE DEL STORED PROCEDURE DE GETINFO. GUARDA LA INFORMACION QUE DEVUELVE EN LA VARIABLE $Tarifas QUE SERA UNA LISTA CON USUARIOS CUYOS VALORES SON LOS MISMOS QUE DEVUELVE EL STORED PROCEDURE.
        return $this->Tarifas;                                                                         //SE RETORNA LA LISTA DE TarifaS.
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
$test = new TarifasModelo();
TEST GET INFO
print_r($test->GetInfoTarifas(NULL,NULL,NULL,NULL,NULL,NULL,0));
 */



/*TEST REGISTRAR
if($test->RegistrarTarifa(10,1,10,10,0)!=null) echo 'Tarifa registrado correctamente!';
 */

/*TEST MODIFICACION
if($test->RegistrarTarifa(1,10,1,10,10,0)!=null) echo 'Tarifa modificado correctamente!';
 */

/*TEST ELIMINAR
if($test->EliminarTarifa(4)!=null) echo 'Tarifa eliminado correctamente!';
 */
