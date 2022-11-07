<?php

class FwSemak{
    
    public static function semak($semak='',$save='',$update=''){
        if (is_array($semak)){
            if ($save){
                $add = 1;
            }
            
            if ($update){
                $edit = $update;
            }
            return array("add"=>@$add,"edit"=>$update,"semak"=>$semak);
        }
    }
    
    public static function alert_semak($v){
        if ($v){
            return "parsley-error";
        }
    }        
    
}

?>