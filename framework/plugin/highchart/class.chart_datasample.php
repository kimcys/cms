<?php

class chart_datasample 
{

    public static function sample_data_pie_gradient($view=''){
        if($view == ''){
            echo "chart_pie_gradient";
            echo "<br />carta pie gradient";
            echo "<p>Parameter";
            echo "<br />title : <em>String</em> : <em>Tajuk carta pie yang menggambarkan maklumat carta</em>";
            echo "<br />data : <em>Array</em> : <em>Array data - seperti dibawah.key array boleh apa saja.</em>";
            echo "<br />sample : <em>String</em> : <em>Jika value 'Y' - maklumat dan sample data carta akan dipaparkan.</em>";
            echo "<br />id : <em>String</em> : <em>Value id kepada class carta.Abaikan jika hanya 1 sahaja carta yang hendah dipaparkan pada 1 halaman.Jika lebih dari satu,perlu set id yang berbeza setiap kali memanggil function chart_pie_gradient</em>";
            echo "<br />req_table : <em>String</em> : <em>Jika value 'Y' - table akan diaparkan mengikut bentuk data yang diberi.</em>";
            echo "<br />table_pos : <em>Integer</em> : <em>Akan menentukan kedudukan table dan carta.Value 1 dan 2 akan menjadikan kedudukan jadual dan carta berada diatas dan bawah.Value 3 carta dan jadual akan berada bersebelahan.</em>";
            echo "<p>Return";
            echo "<br />Type : Array";
        }else{
            echo "<div align='center'>chart::chart_pie_gradient(title,data,sample,id,req_table,table_pos)</div>";
        }
        $title = "#SAMPLE DATA :: CARTA PIE GRADIENT";
        $data = array(
            array("programme" => 'PhD',"bil" => '150'),
            array("programme" => 'Master',"bil" => '350'),
            array("programme" => 'Bachelor',"bil" => '2500'),
            array("programme" => 'Diploma',"bil" => '3500')
        );
        if($view == ''){
            echo "<pre>";
            print_r($data);
            echo "<pre>";
        }
        return array("title" => $title,"data" => $data);
    }
    
    public static function sample_data_spiderwebv2($view=''){
        if($view == ''){
            echo "chart_spiderwebv2";
            echo "<br />carta spider web (arial) version 2";
            echo "<p>Parameter";
            echo "<br />title : <em>String</em> : <em>Tajuk carta spider web yang menggambarkan maklumat carta</em>";
            echo "<br />data : <em>Array</em> : <em>Array data - seperti dibawah.key array boleh apa saja.</em>";
            echo "<br />sample : <em>String</em> : <em>Jika value 'Y' - maklumat dan sample data carta akan dipaparkan.</em>";
            echo "<br />id : <em>String</em> : <em>Value id kepada class carta.Abaikan jika hanya 1 sahaja carta yang hendah dipaparkan pada 1 halaman.Jika lebih dari satu,perlu set id yang berbeza setiap kali memanggil function chart_spiderwebv2</em>";
            echo "<br />req_table : <em>String</em> : <em>Jika value 'Y' - table akan diaparkan mengikut bentuk data yang diberi.</em>";
            echo "<br />table_pos : <em>Integer</em> : <em>Akan menentukan kedudukan table dan carta.Value 1 dan 2 akan menjadikan kedudukan jadual dan carta berada diatas dan bawah.Value 3 carta dan jadual akan berada bersebelahan.</em>";
            echo "<p>Return";
            echo "<br />Type : Array";
        }else{
            echo "<div align='center'>chart::chart_spiderwebv2(title,data,sample,id,req_table,table_pos)</div>";
        }
        $title = "#SAMPLE DATA :: CARTA SPIDER WEB (ARIAL)";
        $data = array(
            array("category" => 'PERUNTUKAN',"JUALAN" => '1000',"MARKETING" => '800',"PEMBANGUNAN" => '700',"SOKONGAN PENGGUNA" => '400',"TEKNOLOGI MAKLUMAT" => '900',"PENTADBIRAN" => '900'),
            array("category" => 'PERBELANJAAN',"JUALAN" => '800',"MARKETING" => '400',"PEMBANGUNAN" => '300',"SOKONGAN PENGGUNA" => '900',"TEKNOLOGI MAKLUMAT" => '700',"PENTADBIRAN" => '1000')
//            array("category" => 'SIMPANAN',"JUALAN" => '987',"MARKETING" => '867',"PEMBANGUNAN" => '567',"SOKONGAN PENGGUNA" => '556',"TEKNOLOGI MAKLUMAT" => '234',"PENTADBIRAN" => '1231')
        );
        if($view == ''){
            echo "<pre>";
            print_r($data);
            echo "<pre>";
        }

        return array("title" => $title,"data" => $data);
    }
    
    public static function sample_data_stacked_bar($jenis,$view=''){
        if($view == ''){
            if($jenis == '1'){
                echo "chart_stacked_bar";
                echo "<br />carta bar melintang";
                echo "<p>Parameter";
                echo "<br />title : <em>String</em> : <em>Tajuk carta bar yang menggambarkan maklumat carta</em>";
                echo "<br />subtitle : <em>String</em> : <em>Sub tajuk yang berada di paksi X</em>";
                echo "<br />data : <em>Array</em> : <em>Array data - seperti dibawah.key array boleh apa saja.</em>";
                echo "<br />sample : <em>String</em> : <em>Jika value 'Y' - maklumat dan sample data carta akan dipaparkan.</em>";
                echo "<br />id : <em>String</em> : <em>Value id kepada class carta.Abaikan jika hanya 1 sahaja carta yang hendah dipaparkan pada 1 halaman.Jika lebih dari satu,perlu set id yang berbeza setiap kali memanggil function chart_stacked_bar</em>";
                echo "<br />req_table : <em>String</em> : <em>Jika value 'Y' - table akan diaparkan mengikut bentuk data yang diberi.</em>";
                echo "<br />table_pos : <em>Integer</em> : <em>Akan menentukan kedudukan table dan carta.Value 1 dan 2 akan menjadikan kedudukan jadual dan carta berada diatas dan bawah.Value 3 carta dan jadual akan berada bersebelahan.</em>";
                echo "<p>Return";
                echo "<br />Type : Array";
            }else{
                echo "chart_stacked_bar2";
                echo "<br />carta bar menegak";
                echo "<p>Parameter";
                echo "<br />title : <em>String</em> : <em>Tajuk carta bar yang menggambarkan maklumat carta</em>";
                echo "<br />subtitle : <em>String</em> : <em>Sub tajuk yang berada di paksi Y</em>";
                echo "<br />data : <em>Array</em> : <em>Array data - seperti dibawah.key array boleh apa saja.</em>";
                echo "<br />sample : <em>String</em> : <em>Jika value 'Y' - maklumat dan sample data carta akan dipaparkan.</em>";
                echo "<br />id : <em>String</em> : <em>Value id kepada class carta.Abaikan jika hanya 1 sahaja carta yang hendah dipaparkan pada 1 halaman.Jika lebih dari satu,perlu set id yang berbeza setiap kali memanggil function chart_stacked_bar2</em>";
                echo "<br />req_table : <em>String</em> : <em>Jika value 'Y' - table akan diaparkan mengikut bentuk data yang diberi.</em>";
                echo "<br />table_pos : <em>Integer</em> : <em>Akan menentukan kedudukan table dan carta.Value 1 dan 2 akan menjadikan kedudukan jadual dan carta berada diatas dan bawah.Value 3 carta dan jadual akan berada bersebelahan.</em>";
                echo "<p>Return";
                echo "<br />Type : Array";
            }
        }else{
            if($jenis == '1'){
            echo "<div align='center'>chart::chart_stacked_bar(title,subtitle,data,sample,id,req_table,table_pos)</div>";
            }else{
            echo "<div align='center'>chart::chart_stacked_bar2(title,subtitle,data,sample,id,req_table,table_pos)</div>";    
            }
        }
        $title = "#SAMPLE DATA :: STACKED BAR";
        $subtitle = "BILANGAN PENCAPAIAN PROGRAM UNIVERSITI";
        $data = array(
            array("category" => 'PRASISWAZAH',"PHD" => '',"MASTER" => '',"BACELOR" => '250',"DIPLOMA" => '350'),
            array("category" => 'PRASISWAZAH INT',"PHD" => '',"MASTER" => '',"BACELOR" => '500',"DIPLOMA" => '150'),
            array("category" => 'PASCASISWAZAH',"PHD" => '230',"MASTER" => '450',"BACELOR" => '',"DIPLOMA" => ''),
            array("category" => 'PASCASISWAZAH INT',"PHD" => '75',"MASTER" => '110',"BACELOR" => '',"DIPLOMA" => '')
        );
        if($view == ''){
            echo "<pre>";
            print_r($data);
            echo "<pre>";
        }

        return array("title" => $title,"subtitle" => $subtitle,"data" => $data);
    }
    
    public static function sample_data_defined_table($view=''){
        if($view == ''){
            echo "chart_defined_table";
            echo "<br />carta bar ikut jadual";
            echo "<p>Parameter";
            echo "<br />title : <em>String</em> : <em>Tajuk carta bar yang menggambarkan maklumat carta</em>";
            echo "<br />data : <em>Array</em> : <em>Array data - seperti dibawah.key array boleh apa saja.</em>";
            echo '<br />stslink : <em>String</em> : <em>Path address untuk drill data.Cth : chart.php?id= .Biarkan id=  kerana value id tersebut akan diwakili oleh data table.</em>';
            echo "<br />sample : <em>String</em> : <em>Jika value 'Y' - maklumat dan sample data carta akan dipaparkan.</em>";
            echo "<br />table_pos : <em>String</em> : <em>Akan menentukan kedudukan table dan carta.Value 1 akan menjadikan carta diatas dan table dibawah.Value 2 jadual diatas dan carta dibawah.Value 3 carta dan jadual akan berada bersebelahan.</em>";
            echo "<br />id : <em>String</em> : <em>Value id kepada class carta.Abaikan jika hanya 1 sahaja carta yang hendah dipaparkan pada 1 halaman.Jika lebih dari satu,perlu set id yang berbeza setiap kali memanggil function chart_defined_table</em>";
            echo "<p>Return";
            echo "<br />Type : Array";
        }else{
            echo "<div align='center'>chart::chart_defined_table(title,data,stslink,sample,table_pos,id)</div>";
        }
        $title = "#SAMPLE DATA :: CARTA BAR BERJADUAL";
        $data = array(
                array("id"=>'1',"KATEGORI"=>'Perkembangan Sahsiah,sosio-emosi dan kerohanian',"TAHUN 2012"=>'12',"TAHUN 2013"=>'25',"TAHUN 2014"=>'30',"TAHUN 2015"=>'6',"TAHUN 2016"=>'8'),
                array("id"=>'5',"KATEGORI"=>'Perkembangan Bahasa,Komunikasi dan Literasi',"TAHUN 2012"=>'10',"TAHUN 2013"=>'10',"TAHUN 2014"=>'15',"TAHUN 2015"=>'6',"TAHUN 2016"=>'9'),
                array("id"=>'8',"KATEGORI"=>'Perkembangan Matematik dan Pemikiran Logik',"TAHUN 2012"=>'4',"TAHUN 2013"=>'8',"TAHUN 2014"=>'5',"TAHUN 2015"=>'7',"TAHUN 2016"=>'9')
            );
        if($view == ''){
            echo "<pre>";
            print_r($data);
            echo "<pre>";
        }

        return array("title" => $title,"data" => $data);
    }
    
    public static function sample_data_line_labels($view=''){
        if($view == ''){
            echo "chart_line_labels";
            echo "<br />carta baris berlabel";
            echo "<p>Parameter";
            echo "<br />title : <em>String</em> : <em>Tajuk carta bar yang menggambarkan maklumat carta</em>";
            echo "<br />subtitle : <em>String</em> : <em>Sub tajuk yang berada dibawah tajuk</em>";
            echo "<br />title_y : <em>String</em> : <em>Sub tajuk yang berada di paksi Y</em>";
            echo "<br />data : <em>Array</em> : <em>Array data - seperti dibawah.key array boleh apa saja.</em>";
            echo "<br />sample : <em>String</em> : <em>Jika value 'Y' - maklumat dan sample data carta akan dipaparkan.</em>";
            echo "<br />id : <em>String</em> : <em>Value id kepada class carta.Abaikan jika hanya 1 sahaja carta yang hendah dipaparkan pada 1 halaman.Jika lebih dari satu,perlu set id yang berbeza setiap kali memanggil function chart_line_labels</em>";
            echo "<br />req_table : <em>String</em> : <em>Jika value 'Y' - table akan diaparkan mengikut bentuk data yang diberi.</em>";
            echo "<br />table_pos : <em>Integer</em> : <em>Akan menentukan kedudukan table dan carta.Value 1 dan 2 akan menjadikan kedudukan jadual dan carta berada diatas dan bawah.Value 3 carta dan jadual akan berada bersebelahan.</em>";
            echo "<p>Return";
            echo "<br />Type : Array";
        }else{
            echo "<div align='center'>chart::chart_line_labels(title,subtitle,title_y,data,sample,id,req_table,table_pos)</div>";
        }
        $title = "#SAMPLE DATA :: CARTA BARIS BERLABEL";
        $title_y = "Nilai Penjanaan";
        $subtitle = "PENJANAAN PENDAPATAN JINM TAHUN 2016";
        $data = array(
            array("cat" => 'JINM',"SUKU 1" => '34',"SUKU 2" => '44',"SUKU 3" => '45',"SUKU 4" => '49'),
            array("cat" => 'CiRNET',"SUKU 1" => '27',"SUKU 2" => '38',"SUKU 3" => '25',"SUKU 4" => '10')
        );
        if($view == ''){
            echo "<pre>";
            print_r($data);
            echo "<pre>";
        }

        return array("title" => $title,"subtitle" => $subtitle,"title_y" => $title_y,"data" => $data);
    }
    
    public static function sample_data_donut($view = ''){
        if($view == ''){
            echo "chart_donut";
            echo "<br />carta donut 3D";
            echo "<p>Parameter";
            echo "<br />title : <em>String</em> : <em>Tajuk carta donut yang menggambarkan maklumat carta</em>";
            echo "<br />subtitle : <em>String</em> : <em>Sub tajuk yang berada di bawah tajuk utama</em>";
            echo "<br />data : <em>Array</em> : <em>Array data - seperti dibawah.key array boleh apa saja.</em>";
            echo "<br />sample : <em>String</em> : <em>Jika value 'Y' - maklumat dan sample data carta akan dipaparkan.</em>";
            echo "<br />id : <em>String</em> : <em>Value id kepada class carta.Abaikan jika hanya 1 sahaja carta yang hendah dipaparkan pada 1 halaman.Jika lebih dari satu,perlu set id yang berbeza setiap kali memanggil function chart_donut</em>";
            echo "<br />req_table : <em>String</em> : <em>Jika value 'Y' - table akan diaparkan mengikut bentuk data yang diberi.</em>";
            echo "<br />table_pos : <em>Integer</em> : <em>Akan menentukan kedudukan table dan carta.Value 1 dan 2 akan menjadikan kedudukan jadual dan carta berada diatas dan bawah.Value 3 carta dan jadual akan berada bersebelahan.</em>";
            echo "<p>Return";
            echo "<br />Type : Array";
        }else{
            echo "<div align='center'>chart::chart_donut(title,subtitle,data,sample,id,req_table,table_pos)</div>";
        }
        $title = "#SAMPLE DATA :: CARTA DONUT";
        $subtitle = "BILANGAN PELAJAR UPM";
        $data = array(
            array("programme" => 'PhD',"bil" => '150'),
            array("programme" => 'Master',"bil" => '350'),
            array("programme" => 'Bachelor',"bil" => '2500'),
            array("programme" => 'Diploma',"bil" => '3500')
        );
        if($view == ''){
            echo "<pre>";
            print_r($data);
            echo "<pre>";
        }
        return array("title" => $title,"subtitle" => $subtitle,"data" => $data);
    }
    
}
