<?php
class CtrlPersona{ 

    /** 
     *  cargar Objeto 
     * @param array $param
     * @return Persona
    */
    
    private function cargarObjeto($param){
        $obj = null;
           
        if( array_key_exists('nrodni',$param) and array_key_exists('ap',$param)and array_key_exists('nom',$param)and array_key_exists('fnac',$param)and array_key_exists('tel',$param)and array_key_exists('domi',$param)){
            $obj = new Persona();
            $obj->setear($param['nrodni'], $param['ap'],$param['nom'],$param['fnac'],$param['tel'],$param['domi']);
        }
        return $obj;
    }
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return Persona
     */
    private function cargarObjetoConClave($param){
        $obj = null;
        
        if( isset($param['nrodni']) ){
            $obj = new Persona();
            $obj->setear($param['nrodni'], null, null, null, null, null);
        }
        return $obj;
    }

    /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
     * @param array $param
     * @return boolean
     */
    
    private function seteadosCamposClaves($param){
        $resp = false;
        if (isset($param['nrodni']))
            $resp = true;
        return $resp;
    }

    /**
     * 
     * @param array $param
     * @return boolean
     */
    public function alta($param){
        $resp = false;
        $param['nrodni'] =null;
        $elObjtTabla = $this->cargarObjeto($param);
        if ($elObjtTabla!=null and $elObjtTabla->insertar()){
            $resp = true;
        }
        return $resp;
    }
    /**
     * permite eliminar un objeto 
     * @param array $param
     * @return boolean
     */
    public function baja($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $elObjtPersona = $this->cargarObjetoConClave($param);
            if ($elObjtPersona!=null and $elObjtPersona->eliminar()){
                $resp = true;
            }
        }
        
        return $resp;
    }
    
    /**
     * permite modificar un objeto
     * @param array $param
     * @return boolean
     */
    public function modificacion($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $elObjtTabla = $this->cargarObjeto($param);
            if($elObjtTabla!=null and $elObjtTabla->modificar()){
                $resp = true;
            }
        }
        return $resp;
    }

    /**
     * permite buscar un objeto
     * @param array $param
     * @return array
     */

     
    public function buscar($param){
        $where = " true ";
        if ($param<>NULL){
            if  (isset($param['NroDni']))
                $where.=" and NroDni =".$param['NroDni'];
            if  (isset($param['Nombre']))
                 $where.=" and Nombre ='".$param['Nombre']."'";
        }
        $arreglo = Persona::listar($where);  
        return $arreglo;
    }
    
    /**
     * no soy una funcion, soy un monstruo
     * @param array $param
     * @return persona
     */

    public function buscarPorDni($dni){
        $obj = Persona::listar('NroDni='.$dni);
        foreach($obj as $o){
        }
        return $o;
    }



}
?>