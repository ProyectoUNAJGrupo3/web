<?php

namespace app\models;
include('OperacionState.php');
/**
 * Operaciones short summary.
 *
 * Operaciones description.
 *
 * @version 1.0
 * @author mende
 */

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
            $this->stringParametros.= ($obj==="")?'""':$obj;
            $this->stringParametros.=($posicionActual==$ultimaPosicion)?',@result':',';
            $posicionActual++;
        }
    }

    private function EjecutarQuery()
    {

        $connection = \Yii::$app->db;
        $model = $connection->createCommand('CALL unaj_proyecto.'.$this->storeProcedureName.'('.$this->stringParametros.');');
        $info = $model->queryAll();

        
        /*$connection = mysqli_connect("192.99.203.134", "unaj_app", "u79l2vak9wh5AZ3219", "unaj_proyecto");
        $model = mysqli_query($connection,'CALL unaj_proyecto.'.$this->storeProcedureName.'('.$this->stringParametros.');') ;
        $info =  mysqli_fetch_array($model);*/
        
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

        $connection = \Yii::$app->db;
        $model = $connection->createCommand('CALL unaj_proyecto.'.$this->storeProcedureName.'('.$this->stringParametros.');');
        $info = $model->queryAll();

        
        /*$connection = mysqli_connect("192.99.203.134", "unaj_app", "u79l2vak9wh5AZ3219", "unaj_proyecto");
        $model = mysqli_query($connection,'CALL unaj_proyecto.'.$this->storeProcedureName.'('.$this->stringParametros.');') ;
        $info =  mysqli_fetch_array($model);*/
        
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

        $connection = \Yii::$app->db;
        $model = $connection->createCommand('CALL unaj_proyecto.'.$this->storeProcedureName.'('.$this->stringParametros.');');
        $info = $model->queryAll();

        
        /*$connection = mysqli_connect("192.99.203.134", "unaj_app", "u79l2vak9wh5AZ3219", "unaj_proyecto");
        $model = mysqli_query($connection,'CALL unaj_proyecto.'.$this->storeProcedureName.'('.$this->stringParametros.');') ;
        $info =  mysqli_fetch_array($model);*/
        
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
        $connection = \Yii::$app->db;
        $model = $connection->createCommand('CALL unaj_proyecto.'.$this->storeProcedureName.'('.$this->stringParametros.');');
        $info = $model->queryAll();
        
        
        /*$connection = mysqli_connect("192.99.203.134", "unaj_app", "u79l2vak9wh5AZ3219", "unaj_proyecto");
        $model = mysqli_query($connection,'CALL unaj_proyecto.'.$this->storeProcedureName.'('.$this->stringParametros.');') ;
        $info =  mysqli_fetch_array($model);*/
        
        return $info;
    }

    public function EjecutarOperacion($parametros, $SP)
    {
        $this->setParametros($parametros);
        $this->storeProcedureName=$SP;
        return $this->EjecutarQuery();
    }
}