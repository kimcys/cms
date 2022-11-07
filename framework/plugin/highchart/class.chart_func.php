<?php

class chart_func
{

    public static function tune_data($data,$case,$coloum=''){
        $x = 0;
        $res = '';
        $max_rowdata = count($data);
        switch($case) {
                case 1:
                    if(is_array($data)){
                        foreach ($data as $row => $values){
                            extract($values);
                            $x++;
                            if($x == $max_rowdata){
                                $inline = "{ name: '".$varname."', y: ".$var1." }";
                            }else{
                                $inline = "{ name: '".$varname."', y: ".$var1." },";
                            }
                            $res = $res.$inline;
                        }
                    }
                    break;
                case 2:
                    if(is_array($data)){
                        foreach ($data as $row => $values){
                            extract($values);
                            $x++;
                            if($x == $max_rowdata){
                                $categori = "'$varname'";
                                $dataset = "{ name: '".$varname."', data: [$var1, $var2, $var3, $var4, $var5] }";
                            }else{
                                $categori = "'$varname',";
                                $dataset = "{ name: '".$varname."', data: [$var1, $var2, $var3, $var4, $var5] }";
                            }
                            $rescat = $rescat.$categori;
                            $resdata = $resdata.$dataset;
                        }
                    }
                    $res = array("categori"=>$rescat,""=>'');
                    break;
                default:
                    break;
        }
        
        return $res;
    }
    
    public static function tune_dataset_stackedbar($data){
        if(is_array($data)){
            //vertical array
            $output = chart_func::array_flip($data);
            //dapatkan key array
            $key_array = array();
            if(is_array($output)){
                foreach ($output as $row_key => $values_key){
                    array_push($key_array, $row_key);
                }
            }
            $bil_key = COUNT($key_array);
            //dapatkan list category
            $catlist = array();
            $a = 0;
            foreach ($output as $rowcatlist => $valuescatlist){
                $a++;
                if($a == '1'){
                    extract($valuescatlist);
                    foreach ($valuescatlist as $rowcatlistx => $valuescatlistx){
                        $catlist[] = $valuescatlist[$rowcatlistx];
                    }
                }
            }
            //dapat list data
            $b = 0;
            foreach ($output as $rowdatalist => $valuesdatalist){
                $b++;
                if($b != '1'){
                    $dataliner = array();
                    foreach ($valuesdatalist as $rowdatalistx => $valuesdatalistx){
                        for($x=1 ; $x<$bil_key ; $x++){
                            if($rowdatalist == $key_array[$x]){
                                $dataliner[] = $valuesdatalistx;
                            }
                        }

                    }
                    $data_grid[] = array("name" => $rowdatalist, "data" => $dataliner, "stack" => 'male');
                }

            }
            $catlistx = json_encode($catlist,true);
            $data_gridx = json_encode($data_grid,JSON_NUMERIC_CHECK);
            return array("data_cat" => $catlistx,"data_list" => $data_gridx);
        }else{
            return array("data_cat" => '',"data_list" => '');
        }
    }
    
    public static function tune_dataset_piechart($data){
        $data_gridx = '';
        $x = 0;
        $newarray = array();
        $bil_val = COUNT($data);
        if(is_array($data)){
            foreach ($data as $rowdata => $valuesdata){
                $newarray[] = array_values($valuesdata);
            }
            
            foreach ($newarray as $rowdatalist => $valuesdatalist){
                $x++;
                if($x == '1'){
                    $data_grid[] = array("name" => $valuesdatalist[0], "y" => $valuesdatalist[1] ,"sliced" => 'true', "selected" => 'true');
                }else{
                    $data_grid[] = array("name" => $valuesdatalist[0], "y" => $valuesdatalist[1]);
                }
                    
            }
            $data_gridx = json_encode($data_grid,JSON_NUMERIC_CHECK);
            return @$data_gridx;
        }else{
            return $data_gridx;
        }
    }
    
    public static function tune_dataset_spiderweb($data){
        if(is_array($data)){
            //vertical array
            $output = chart_func::array_flip($data);
            //dapatkan key array
//            echo "<pre>";
//            print_r($output);
//            echo "</pre>";
            $a = 0;
            $catlist = array();
            if(is_array($output)){
                foreach ($output as $rowcatlist => $valuescatlist){
                    $a++;
                    if($a != '1'){
                        array_push($catlist, $rowcatlist);
                    }
                }
            }
//            echo "<pre>";
//            print_r($catlist);
//            echo "</pre>";
            //dapat list data
            
            foreach ($data as $rowkl => $valueskl){
                $nkey[] = array_values($valueskl);
            }
            foreach ($output as $rowk => $valuesk){
                $tkey[] = array_values($valuesk);
            }

            $data_grid = array();
            $b = 0;
            foreach ($nkey as $rowx => $valuesx){
//                extract($valuesx);
                $dataliner = array();
                foreach ($tkey as $rowk => $valuesk){
                    if($rowk != '0'){
                        $dataliner[] = $valuesk[$b];
                    }
                }
                $data_grid[] = array("name" => $valuesx['0'], "data" => @$dataliner, "pointPlacement" => 'on');
                $b++;
            }
//            echo "<pre>";
//            print_r($data_grid);
//            echo "</pre>";
            $catlistx = json_encode($catlist,true);
            $data_gridx = json_encode($data_grid,JSON_NUMERIC_CHECK);
            return array("data_cat" => $catlistx,"data_list" => $data_gridx);
        }else{
            return array("data_cat" => '',"data_list" => '');
        }
    }
    
    public static function tune_dataset_defined_table($data){
        if(is_array($data)){
            $output = chart_func::array_flip($data);
//            echo "<pre>";
//            print_r($output);
//            echo "</pre>";
            //dapatkan key array
            $key_array = array();
            $a = 0;
            if(is_array($output)){
                foreach ($output as $row_key => $values_key){
                    if($a != '0'){
                        array_push($key_array, $row_key);
                    }
                    $a++;
                }
            }
            $bil_key = COUNT($key_array);
//            echo "<pre>";
//            print_r($key_array);
//            echo "</pre>";
            foreach ($data as $rowkl => $valueskl){
                $data_gridx[] = array_values($valueskl);
            }
//            echo "<pre>";
//            print_r($data_gridx);
//            echo "</pre>";
            return array("data_cat" => $key_array,"data_list" => $data_gridx);
        }else{
            return array("data_cat" => '',"data_list" => '');
        }
    }
    
    public static function tune_dataset_table_view($data){
        if(is_array($data)){
            $output = chart_func::array_flip($data);
//            echo "<pre>";
//            print_r($output);
//            echo "</pre>";
            //dapatkan key array
            $key_array = array();
            $a = 0;
            if(is_array($output)){
                foreach ($output as $row_key => $values_key){
                        array_push($key_array, $row_key);
                    $a++;
                }
            }
            $bil_key = COUNT($key_array);
//            echo "<pre>";
//            print_r($key_array);
//            echo "</pre>";
            foreach ($data as $rowkl => $valueskl){
                $data_gridx[] = array_values($valueskl);
            }
//            echo "<pre>";
//            print_r($data_gridx);
//            echo "</pre>";
            return array("data_cat" => $key_array,"data_list" => $data_gridx);
        }else{
            return array("data_cat" => '',"data_list" => '');
        }
    }
    
    public static function tune_dataset_line_labels($data){
        if(is_array($data)){
            $output = chart_func::array_flip($data);
//            echo "<pre>";
//            print_r($output);
//            echo "<pre>";
            $a = 0;
            $catlist = array();
            if(is_array($output)){
                foreach ($output as $rowcatlist => $valuescatlist){
                    $a++;
                    if($a != '1'){
                        array_push($catlist, $rowcatlist);
                    }
                }
            }
//            echo "<pre>";
//            print_r($catlist);
//            echo "<pre>";
            foreach ($data as $rowkl => $valueskl){
                $nkey[] = array_values($valueskl);
            }
            foreach ($output as $rowk => $valuesk){
                $tkey[] = array_values($valuesk);
            }

            $data_grid = array();
            $b = 0;
            foreach ($nkey as $rowx => $valuesx){
//                extract($valuesx);
                $dataliner = array();
                foreach ($tkey as $rowk => $valuesk){
                    if($rowk != '0'){
                        $dataliner[] = $valuesk[$b];
                    }
                }
                $data_grid[] = array("name" => $valuesx['0'], "data" => @$dataliner, "pointPlacement" => 'on');
                $b++;
            }
//            echo "<pre>";
//            print_r($data_grid);
//            echo "<pre>";
            $catlistx = json_encode($catlist,true);
            $data_gridx = json_encode($data_grid,JSON_NUMERIC_CHECK);
            return array("data_cat" => $catlistx,"data_list" => $data_gridx);
        }else{
            return array("data_cat" => '',"data_list" => '');
        }
    }
    
    public static function tune_dataset_donut($data){
        $data_gridx = '';
        $x = 0;
        $newarray = array();
        $bil_val = COUNT($data);
        if(is_array($data)){
            foreach ($data as $rowdata => $valuesdata){
                $newarray[] = array_values($valuesdata);
            }
            
            foreach ($newarray as $rowdatalist => $valuesdatalist){
                $x++;
                if($x == '1'){
                    $data_grid[] = array("name" => $valuesdatalist[0], "y" => $valuesdatalist[1]);
                }else{
                    $data_grid[] = array("name" => $valuesdatalist[0], "y" => $valuesdatalist[1]);
                }
                    
            }
            $data_gridx = json_encode($data_grid,JSON_NUMERIC_CHECK);
            return @$data_gridx;
        }else{
            return $data_gridx;
        }
    }

    public static function array_flip($arr){
        $out = array();

        foreach ($arr as $key => $subarr)
        {
                foreach ($subarr as $subkey => $subvalue)
                {
                     $out[$subkey][$key] = $subvalue;
                }
        }

        return $out;
    }
    
}
