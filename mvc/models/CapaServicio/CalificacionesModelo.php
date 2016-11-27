<?php
namespace app\models\CapaServicio;
use Yii;
use yii\base\Model;
use app\models\CapaServicio\ServicioBD\GetInfo;
use app\models\CapaServicio\ServicioBD\Alta;
use app\models\CapaServicio\ServicioBD\Baja;
use app\models\CapaServicio\ServicioBD\Modificacion;

/**
 * CalificacionModelo short summary.
 *
 * CalificacionModelo description.
 *
 * @version 1.0
 * @author mende
 */
class CalificacionesModelo extends Model
{
    const Operacion_Alta = 0, Operacion_Modificacion=1, Operacion_Baja=2, Operacion_GetInfo=3;  //CONSTANTES QUE SIRVEN PARA UTILIZARLAS COMO REFERENCIA A CADA OPERACION.
    const spABM='Calificacion_ABM', spGetInfo='Calificacion_GetInfo';                                     //NOMBRES DE STORED PROCEDURES QUE SE UTILIZARAN EN EL MODELO.
    private $Operacion=null;                                                                    //VARIABLE AUXILIAR PARA GUARDAR LA CONSTANTE DE OPERACION QUE SE UTILIZARA COMO REFERENCIA.
    private $OperacionState=null;                                                               //VARIABLE QUE GUARDARA EL ESTADO DE LA OPERACION ACTUAL (ALTA, BAJA, MODIFICACION o GETINFO).
    private $Calificaciones=null;                                                                     //VARIABLE QUE SERVIRA PARA GUARDAR LAS PERSONAS QUE DEVUELVA EL METODO GETINFO.
    private $Parametros=null;                                                                   //VARIABLE QUE GUARDARA LOS PARAMETROS DEL STORED PROCEDURE



    public function RegistrarCalificacion($ViajeID,$Quien, $ParaQuien,$Puntaje,$Fecha, $Comentario, $AgenciaID)                                               //ESTE METODO RECIBE UN Lista COMO PARAMETRO, LA Lista DEBE CONTENER LA MISMA CANTIDAD DE PARAMETROS QUE SE UTILIZAN EN EL STORE PROCEDURE CON LOS MISMOS NOMBRES EXCEPTUANDO LOS PARAMETROS (operacion, CalificacionID y @result).
    {
        $this->Parametros = [
                'ViajeID' => $ViajeID,
                'Quien' => $Quien,
                'ParaQuien' => $ParaQuien,
                'Puntaje' => $Puntaje,
                'Fecha' => $Fecha,
                'Comentario' => $Comentario,
                'AgenciaID' => $AgenciaID,
                ];
        $this->setOperacion(self::Operacion_Alta);                                                      //LLAMA AL METODO setOperacion y SETEA LA VARIABLE $operacionState CON UN OBJETO Alta() DE LA CLASE OPERACIONES.
        $this->Calificaciones = $this->OperacionState->EjecutarOperacion($this->Parametros,self::spABM);      //EJECUTA EL METODO EjecutarOperacion() DEL OBJETO OperacionState (un objeto Alta()) Y LE PASA COMO PARAMETROS LA LISTA DE PARAMETROS Y LA CONSTANTE CON EL NOMBRE DEL STORED PROCEDURE DE ABM. GUARDA LA INFORMACION QUE DEVUELVE EN LA VARIABLE $Calificacion QUE SERA UNA LISTA CON UN SOLO VALOR ($id de la Calificacion insertada).
        return $this->Calificaciones;
    }
    public function EliminarCalificacion($CalificacionID)
    {
        $this->Parametros = [
                'CalificacionID' => $CalificacionID,
                'ViajeID' => NULL,
                'Quien' => NULL,
                'ParaQuien' => NULL,
                'Puntaje' => NULL,
                'Fecha' => NULL,
                'Comentario' => NULL,
                'AgenciaID' => NULL,
                ];
        $this->setOperacion(self::Operacion_Baja);                                                    //LLAMA AL METODO setOperacion y SETEA LA VARIABLE $operacionState CON UN OBJETO Baja() DE LA CLASE OPERACIONES.
        $this->Calificaciones = $this->OperacionState->EjecutarOperacion($this->Parametros,self::spABM);    //EJECUTA EL METODO EjecutarOperacion() DEL OBJETO OperacionState (un objeto Baja()) Y LE PASA COMO PARAMETROS LA LISTA DE PARAMETROS Y LA CONSTANTE CON EL NOMBRE DEL STORED PROCEDURE DE ABM. GUARDA LA INFORMACION QUE DEVUELVE EN LA VARIABLE $Calificacion QUE SERA UNA LISTA CON UN SOLO VALOR ($id de la Calificacion eliminada).

        return $this->Calificaciones;
    }
    public function ModificarCalificacion($CalificacionID, $ViajeID,$Quien, $ParaQuien,$Puntaje,$Fecha, $Comentario, $AgenciaID)
    {
        $this->Parametros = [
                'CalificacionID' => $CalificacionID,
                'ViajeID' => $ViajeID,
                'Quien' => $Quien,
                'ParaQuien' => $ParaQuien,
                'Puntaje' => $Puntaje,
                'Fecha' => $Fecha,
                'Comentario' => $Comentario,
                'AgenciaID' => $AgenciaID,
                ];
        $this->setOperacion(self::Operacion_Modificacion);                                              //LLAMA AL METODO setOperacion y SETEA LA VARIABLE $operacionState CON UN OBJETO Modificacion() DE LA CLASE OPERACIONES.
        $this->Calificaciones = $this->OperacionState->EjecutarOperacion($this->Parametros,self::spABM);      //EJECUTA EL METODO EjecutarOperacion() DEL OBJETO OperacionState (un objeto Modifcacion()) Y LE PASA COMO PARAMETROS LA LISTA DE PARAMETROS Y LA CONSTANTE CON EL NOMBRE DEL STORED PROCEDURE DE ABM. GUARDA LA INFORMACION QUE DEVUELVE EN LA VARIABLE $Calificacion QUE SERA UNA LISTA CON UN SOLO VALOR ($id de la Calificacion modificada).
        return $this->Calificaciones;
    }
    public function GetInfoCalificacion($CalificacionID, $ViajeID,$Quien, $ParaQuien,$Puntaje, $AgenciaID)
    {
        $this->Parametros = [
                'CalificacionID' => $CalificacionID,
                'ViajeID' => $ViajeID,
                'Quien' => $Quien,
                'ParaQuien' => $ParaQuien,
                'Puntaje' => $Puntaje,
                'AgenciaID' => $AgenciaID,
                ];
        $this->setOperacion(self::Operacion_GetInfo);                                                   //LLAMA AL METODO setOperacion y SETEA LA VARIABLE $operacionState CON UN OBJETO Getinfo() DE LA CLASE OPERACIONES.
        $this->Calificaciones = $this->OperacionState->EjecutarOperacion($this->Parametros,self::spGetInfo);  //EJECUTA EL METODO EjecutarOperacion() DEL OBJETO OperacionState (un objeto GetInfo()) Y LE PASA COMO PARAMETROS LA LISTA DE PARAMETROS Y LA CONSTANTE CON EL NOMBRE DEL STORED PROCEDURE DE GETINFO. GUARDA LA INFORMACION QUE DEVUELVE EN LA VARIABLE $Personas QUE SERA UNA LISTA CON USUARIOS CUYOS VALORES SON LOS MISMOS QUE DEVUELVE EL STORED PROCEDURE.
        return $this->Calificaciones;                                                                  //SE RETORNA LA LISTA DE PERSONAS.
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