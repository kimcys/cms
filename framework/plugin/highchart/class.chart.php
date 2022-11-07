
<?php
include 'chart_config.php';
require_once 'class.chart_func.php';
require_once 'class.chart_datasample.php';

class chart 
{
    
    public static function chart_preview_all(){
        chart::chart_pie_gradient(@$title7,'1',"Y");
        chart::chart_donut(@$title, @$subtitle, '1', "Y");
        chart::chart_stacked_bar(@$title, @$subtitle, '1', "Y");
        chart::chart_stacked_bar2(@$title, @$subtitle, '1', "Y");
        chart::chart_spiderwebv2(@$title, '1', "Y");
        chart::chart_line_labels(@$title, @$subtitle, @$title_y, '1', "Y");
        chart::chart_defined_table(@$title, '1', @$stslink, "Y");
    }

    public static function chart_pie_gradient($title,$data,$sample='',$id='id1',$req_table='',$table_pos='',$height='400'){
        global $jquery_version;
        if($sample == 'Y'){
            if($data != '1'){
                $data_sample = chart_datasample::sample_data_pie_gradient();
                $title = $data_sample['title'];
                $data = $data_sample['data'];
            }else{
                $data_sample = chart_datasample::sample_data_pie_gradient('N');
                $title = $data_sample['title'];
                $data = $data_sample['data'];
            }
        }
        $get_data = chart_func::tune_dataset_piechart($data);
        if($jquery_version == '1'){
        ?>
            <script type="text/javascript">
                $(function () {

                    // Radialize the colors
                    Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function (color) {
                        return {
                            radialGradient: {
                                cx: 0.5,
                                cy: 0.3,
                                r: 0.7
                            },
                            stops: [
                                [0, color],
                                [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
                            ]
                        };
                    });

                    // Build the chart
                    $('#container-pie_gradient<?php echo $id; ?>').highcharts({
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false,
                            type: 'pie'
                        },
                        title: {
                            text: '<?php echo $title; ?>'
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: true,
                                    format: '<b>{point.name}</b>: {point.percentage:.1f} % ( {point.y} )',
                                    style: {
                                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                                    },
                                    connectorColor: 'silver'
                                }
                            }
                        },
                        series: [{
                            name: 'Score',
                            data: <?php echo $get_data; ?>
                        }]
                    });
                });
            </script>
            <?php
            }elseif($jquery_version == '2'){
                ?>
                    <script type="text/javascript">
                        $(function () {
                            // Radialize the colors
                            Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function (color) {
                                return {
                                    radialGradient: {
                                        cx: 0.5,
                                        cy: 0.3,
                                        r: 0.7
                                    },
                                    stops: [
                                        [0, color],
                                        [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
                                    ]
                                };
                            });
                            var chart = new Highcharts.Chart({
                                chart: {
                                    plotBackgroundColor: null,
                                    plotBorderWidth: null,
                                    plotShadow: false,
                                    type: 'pie',
                                    renderTo: 'container-pie_gradient<?php echo $id; ?>'
                                },
                                title: {
                                    text: '<?php echo $title; ?>'
                                },
                                tooltip: {
                                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                                },
                                plotOptions: {
                                    pie: {
                                        allowPointSelect: true,
                                        cursor: 'pointer',
                                        dataLabels: {
                                            enabled: true,
                                            format: '<b>{point.name}</b>: {point.percentage:.1f} % ( {point.y} )',
                                            style: {
                                                color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                                            },
                                            connectorColor: 'silver'
                                        }
                                    }
                                },
                                series: [{
                                    name: 'Score',
                                    data: <?php echo $get_data; ?>
                                }]
                            });
                        });
                    </script>
                <?php
            }
        if($req_table == 'Y'){
            if($table_pos == '3'){
                $col = "col-md-6";
            }else{
                $col = "col-md-12";
            }
            ?>
            <div class="<?php echo $col; ?>">
                <div id="container-pie_gradient<?php echo $id; ?>" style="min-width: 310px; height: <?php echo $height; ?>px; max-width: 600px; margin: 0 auto"></div>
            </div>
            <div class="<?php echo $col; ?>">
                <?php chart::table_chart($data,"container-pie_gradient$id"); ?>
            </div>
            <?php
            
        }else{
            ?>
                <div id="container-pie_gradient<?php echo $id; ?>" style="min-width: 310px; height: <?php echo $height; ?>px; max-width: 600px; margin: 0 auto"></div>
            <?php
        }
    }
    
    public static function chart_stacked_bar($title,$subtitle,$data,$sample='',$id='id1',$req_table='',$table_pos=''){
        global $jquery_version;
        if($sample == 'Y'){
            if($data != '1'){
                $data_sample = chart_datasample::sample_data_stacked_bar('1');
                $title = $data_sample['title'];
                $subtitle = $data_sample['subtitle'];
                $data = $data_sample['data'];
            }else{
                $data_sample = chart_datasample::sample_data_stacked_bar('1','N');
                $title = $data_sample['title'];
                $subtitle = $data_sample['subtitle'];
                $data = $data_sample['data'];
            }
        }
        $get_data = chart_func::tune_dataset_stackedbar($data);
        $data_cat = $get_data['data_cat'];
        $data_list = $get_data['data_list'];
        if($jquery_version == '1'){
        ?>
            <script type="text/javascript">
                $(function () {
                    $('#container-stacked_bar<?php echo $id; ?>').highcharts({
                        chart: {
                            type: 'bar'
                        },
                        title: {
                            text: '<?php echo $title; ?>'
                        },
                        xAxis: {
                            categories: <?php echo $data_cat; ?>
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: '<?php echo $subtitle; ?>'
                            },
                            stackLabels: {
                                enabled: true,
                                style: {
                                    fontWeight: 'bold',
                                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                                }
                            }
                        },
                        legend: {
                            reversed: true
                        },
                        plotOptions: {
                            series: {
                                stacking: 'normal'
                            }
                        },
                        series: <?php echo $data_list; ?>
                    });
                });
            </script>
            <?php
            }elseif($jquery_version == '2'){
                ?>
                    <script type="text/javascript">
                        $(function () {
                            var chart = new Highcharts.Chart({
                                chart: {
                                    type: 'bar',
                                    renderTo: 'container-stacked_bar<?php echo $id; ?>'
                                },
                                title: {
                                    text: '<?php echo $title; ?>'
                                },
                                xAxis: {
                                    categories: <?php echo $data_cat; ?>
                                },
                                yAxis: {
                                    min: 0,
                                    title: {
                                        text: '<?php echo $subtitle; ?>'
                                    },
                                    stackLabels: {
                                        enabled: true,
                                        style: {
                                            fontWeight: 'bold',
                                            color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                                        }
                                    }
                                },
                                legend: {
                                    reversed: true
                                },
                                plotOptions: {
                                    series: {
                                        stacking: 'normal'
                                    }
                                },
                                series: <?php echo $data_list; ?>
                            });
                        });
                    </script>
                <?php
            }
            if($req_table == 'Y'){
                if($table_pos == '3'){
                    $col = "col-md-6";
                }else{
                    $col = "col-md-12";
                }
                ?>
                <div class="<?php echo $col; ?>">
                    <div id="container-stacked_bar<?php echo $id; ?>"></div>
                </div>
                <div class="<?php echo $col; ?>">
                    <?php chart::table_chart($data,"container-stacked_bar$id"); ?>
                </div>
                <?php

            }else{
            ?>
                <div id="container-stacked_bar<?php echo $id; ?>"></div>
        <?php
            }
    }
    
    public static function chart_stacked_bar2($title, $subtitle,$data,$sample='',$id='id1',$req_table='',$table_pos=''){
        global $jquery_version;
        if($sample == 'Y'){
            if($data != '1'){
                $data_sample = chart_datasample::sample_data_stacked_bar('2');
                $title = $data_sample['title'];
                $subtitle = $data_sample['subtitle'];
                $data = $data_sample['data'];
            }else{
                $data_sample = chart_datasample::sample_data_stacked_bar('2','N');
                $title = $data_sample['title'];
                $subtitle = $data_sample['subtitle'];
                $data = $data_sample['data'];
            }
        }
        $get_data = chart_func::tune_dataset_stackedbar($data);
        $data_cat = $get_data['data_cat'];
        $data_list = $get_data['data_list'];
                if($jquery_version == '1'){
        ?>
            <script type="text/javascript">
            $(function () {
                $('#container-stacked_bar2<?php echo $id; ?>').highcharts({

                    chart: {
                        type: 'column'
                    },

                    title: {
                        text: '<?php echo $title; ?>'
                    },

                    xAxis: {
                        categories: <?php echo $data_cat; ?>
                    },

                    yAxis: {
                        allowDecimals: false,
                        min: 0,
                        title: {
                            text: '<?php echo $subtitle; ?>'
                        },
                        stackLabels: {
                            enabled: true,
                            style: {
                                fontWeight: 'bold',
                                color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                            }
                        }
                    },

                    tooltip: {
                        formatter: function () {
                            return '<b>' + this.x + '</b><br/>' +
                                this.series.name + ': ' + this.y + '<br/>' +
                                'Total: ' + this.point.stackTotal;
                        }
                    },

                    plotOptions: {
                        column: {
                            stacking: 'normal'
                        }
                    },

                    series: <?php echo $data_list; ?>
                });
            });
            </script>
            <?php
            }elseif($jquery_version == '2'){
                ?>
                    <script type="text/javascript">
                        $(function () {
                            var chart = new Highcharts.Chart({
                                chart: {
                                    type: 'column',
                                    renderTo: 'container-stacked_bar2<?php echo $id; ?>'
                                },
                                title: {
                                    text: '<?php echo $title; ?>'
                                },
                                xAxis: {
                                    categories: <?php echo $data_cat; ?>
                                },
                                yAxis: {
                                    allowDecimals: false,
                                    min: 0,
                                    title: {
                                        text: '<?php echo $subtitle; ?>'
                                    },
                                    stackLabels: {
                                        enabled: true,
                                        style: {
                                            fontWeight: 'bold',
                                            color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                                        }
                                    }
                                },
                                tooltip: {
                                    formatter: function () {
                                        return '<b>' + this.x + '</b><br/>' +
                                            this.series.name + ': ' + this.y + '<br/>' +
                                            'Total: ' + this.point.stackTotal;
                                    }
                                },
                                plotOptions: {
                                    column: {
                                        stacking: 'normal'
                                    }
                                },
                                series: <?php echo $data_list; ?>
                            });
                        });
                    </script>
                <?php
            }
            if($req_table == 'Y'){
                if($table_pos == '3'){
                    $col = "col-md-6";
                }else{
                    $col = "col-md-12";
                }
                ?>
                <div class="<?php echo $col; ?>">
                    <div id="container-stacked_bar2<?php echo $id; ?>"></div>
                </div>
                <div class="<?php echo $col; ?>">
                    <?php chart::table_chart($data,"container-stacked_bar2$id"); ?>
                </div>
                <?php

            }else{
            ?>
                <div id="container-stacked_bar2<?php echo $id; ?>"></div>
            <?php
            }
    }
    
    public static function chart_spiderweb($title,$category,$data1,$data2){
        //echo "XXXXX";
        ?>
            <script type="text/javascript">
                $(function () {

                    $('#chart-spiderweb').highcharts({

                        chart: {
                            polar: true,
                            type: 'line'
                        },

                        title: {
                            text: '<?php echo $title; ?>',
                            x: -80
                        },

                        pane: {
                            size: '80%'
                        },

                        xAxis: {
                            categories: [<?php echo $category; ?>],
                            tickmarkPlacement: 'on',
                            lineWidth: 0
                        },

                        yAxis: {
                            gridLineInterpolation: 'polygon',
                            lineWidth: 0,
                            min: 0
                        },

                        tooltip: {
                            shared: true,
                            pointFormat: '<span style="color:{series.color}">{series.name}: <b>{point.y:,.0f}</b><br/>'
                        },

                        legend: {
                            align: 'right',
                            verticalAlign: 'top',
                            y: 70,
                            layout: 'vertical'
                        },

                        series: [{
                            name: 'KAJISELIDIK ANAKXXX',
                            data: [<?php echo $data1; ?>],
                            pointPlacement: 'on'
                        }, {
                            name: 'KAJISELIDIK PARENT',
                            data: [<?php echo $data2; ?>],
                            pointPlacement: 'on'
                        }]

                    });
                });
            </script>
            <!-- Start Content -->
            <div id="content">
                <div class="container">
                    <div class="page-content">
                    <!-- Divider -->
                    <!--<div class="hr1" style="margin-bottom:45px;"></div>-->
<!--                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="classic-title"><span>DO MAPPING</span></h4>
                            </div>
                        </div>-->
                        <div class="row">
                            <div class="col-md-5">
                                <div id="chart-spiderweb"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php 
    }
    
    public static function chart_spiderwebv2($title,$data,$sample='',$id='id1',$req_table='',$table_pos=''){
        global $jquery_version;
        if($sample == 'Y'){
            if($data != '1'){
                $data_sample = chart_datasample::sample_data_spiderwebv2();
                $title = $data_sample['title'];
                $data = $data_sample['data'];
            }else{
                $data_sample = chart_datasample::sample_data_spiderwebv2('N');
                $title = $data_sample['title'];
                $data = $data_sample['data'];
            }
        }
        $get_data = chart_func::tune_dataset_spiderweb($data);
        $data_cat = $get_data['data_cat'];
        $data_list = $get_data['data_list'];
        if($jquery_version == '1'){
        ?>
            <script type="text/javascript">
            $(function () {

                $('#container-spiderwebv2<?php echo $id; ?>').highcharts({

                    chart: {
                        polar: true,
                        type: 'line'
                    },

                    title: {
                        text: '<?php echo $title; ?>',
                        x: -80
                    },

                    pane: {
                        size: '80%'
                    },

                    xAxis: {
                        categories: <?php echo $data_cat; ?>,
                        tickmarkPlacement: 'on',
                        lineWidth: 0
                    },

                    yAxis: {
                        gridLineInterpolation: 'polygon',
                        lineWidth: 0,
                        min: 0
                    },

                    tooltip: {
                        shared: true,
                        pointFormat: '<span style="color:{series.color}">{series.name}: <b>{point.y:,.0f}</b><br/>'
                    },

                    legend: {
                        align: 'right',
                        verticalAlign: 'top',
                        y: 70,
                        layout: 'vertical'
                    },

                    series: <?php echo $data_list; ?>

                });
            });
            </script>
            <?php 
            }elseif($jquery_version == '2'){
                ?>
                    <script type="text/javascript">
                        $(function () {
                            var chart = new Highcharts.Chart({
                                chart: {
                                    polar: true,
                                    type: 'line',
                                    renderTo: 'container-spiderwebv2<?php echo $id; ?>'
                                },
                                title: {
                                    text: '<?php echo $title; ?>',
                                    x: -80
                                },
                                pane: {
                                    size: '80%'
                                },

                                xAxis: {
                                    categories: <?php echo $data_cat; ?>,
                                    tickmarkPlacement: 'on',
                                    lineWidth: 0
                                },

                                yAxis: {
                                    gridLineInterpolation: 'polygon',
                                    lineWidth: 0,
                                    min: 0
                                },

                                tooltip: {
                                    shared: true,
                                    pointFormat: '<span style="color:{series.color}">{series.name}: <b>{point.y:,.0f}</b><br/>'
                                },

                                legend: {
                                    align: 'right',
                                    verticalAlign: 'top',
                                    y: 70,
                                    layout: 'vertical'
                                },

                                series: <?php echo $data_list; ?>

                            });
                        });
                    </script>
                <?php
            }
            if($req_table == 'Y'){
                if($table_pos == '3'){
                    $col = "col-md-6";
                }else{
                    $col = "col-md-12";
                }
                ?>
                <div class="<?php echo $col; ?>">
                    <div id="container-spiderwebv2<?php echo $id; ?>" style="min-width: 400px; max-width: 600px; height: 400px; margin: 0 auto"></div>
                </div>
                <div class="<?php echo $col; ?>">
                    <?php chart::table_chart($data,"container-spiderwebv2$id"); ?>
                </div>
                <?php

            }else{
            ?>
                <div id="container-spiderwebv2<?php echo $id; ?>" style="min-width: 400px; max-width: 600px; height: 400px; margin: 0 auto"></div>
            <?php
            }
            
    }
    
    public static function chart_defined_table($title,$data,$stslink='',$sample='',$table_pos='1',$id='id1'){
        global $jquery_version;
        if($sample == 'Y'){
            if($data != '1'){
                $data_sample = chart_datasample::sample_data_defined_table();
                $title = $data_sample['title'];
                $data = $data_sample['data'];
            }else{
                $data_sample = chart_datasample::sample_data_defined_table('N');
                $title = $data_sample['title'];
                $data = $data_sample['data'];
            }
        }
        $get_data = chart_func::tune_dataset_defined_table($data);
        $data_cat = $get_data['data_cat'];
        $data_list = $get_data['data_list'];
        if($jquery_version == '1'){
        ?>
            <script type="text/javascript">
                $(function () {
                    $('#chart-defined_table<?php echo $id; ?>').highcharts({
                        data: {
                            table: 'datatable-defined_table'
                        },
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: '<?php echo $title; ?>'
                        },
                        yAxis: {
                            allowDecimals: false,
                            min: 0,
                            title: {
                                text: 'Units'
                            }
                        },
                        plotOptions: {
                            series: {
                                borderWidth: 0,
                                dataLabels: {
                                    enabled: true,
                                    format: '{point.y}'
                                }
                            }
                        },
                        tooltip: {
                            formatter: function () {
                                return '<b>' + this.series.name + '</b><br/>' +
                                    this.point.y + ' ' + this.point.name.toLowerCase();
                            }
                        }
                    });
                });
            </script>
            <?php
            }elseif($jquery_version == '2'){
                ?>
                    <script type="text/javascript">
                        $(function () {
                            var chart = new Highcharts.Chart({
                                data: {
                                    table: 'datatable-defined_table'
                                },
                                chart: {
                                    type: 'column',
                                    renderTo: 'chart-defined_table<?php echo $id; ?>'
                                },
                                title: {
                                    text: '<?php echo $title; ?>'
                                },
                                yAxis: {
                                    allowDecimals: false,
                                    min: 0,
                                    title: {
                                        text: 'Units'
                                    }
                                },
                                tooltip: {
                                    formatter: function () {
                                        return '<b>' + this.series.name + '</b><br/>' +
                                            this.point.y + ' ' + this.point.name.toLowerCase();
                                    }
                                }
                            });
                        });
                    </script>
                <?php
            }
            if($table_pos == '3'){
                $col = "col-md-6";
            }else{
                $col = "col-md-12";
            }
//            echo "X".$col."X";
            ?>
            <!-- Start Content -->
            <div id="content">
                <div class="container">
                    <div class="page-content">
                        <div class="row">
                                <?php
                                if($table_pos == '1'){
                                    ?>
                                    <div class="<?php echo $col; ?>">
                                        <div id="chart-defined_table<?php echo $id; ?>"></div>
                                    </div>
                                    <?php
                                }
                                ?>
                                <div class="<?php echo $col; ?>">
                                    <table id="datatable-defined_table" border="1" width="100%" class="table table-bordered table-condensed table-hover">
                                        <thead>
                                            <tr>
                                                <?php 
                                                    $bil_cat = COUNT($data_cat);
                                                    for($x=0 ; $x<$bil_cat ; $x++){
                                                        ?>
                                                            <th <?php if($x != '0'){ echo "align='center'"; }?>><?php echo $data_cat[$x]; ?></th>
                                                        <?php
                                                    }
                                                ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if(is_array($data_list)){
                                                foreach ($data_list as $row => $values){
                                                    $bil_list = COUNT($values);
                        //                            $bil_list = $bil_list - 1;
                                                    ?>
                                                        <tr>
                                                            <?php
                                                                for($y=1 ; $y<$bil_list ; $y++){
                                                                    ?>
                                                                        <td <?php if($y != '1'){ echo "align='center'"; } ?> ><?php if($y == '1'){ if($stslink != ''){ ?><a href="<?php echo $stslink.$values[0]; ?>" ><?php } } ?><?php echo $values[$y]; ?><?php if($y == '1'){ if($stslink != ''){ echo "</a>"; } } ?></td>
                                                                    <?php
                                                                }
                                                            ?>
                                                        </tr>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    </div>
                                <?php
                                if($table_pos == '2'){
                                    ?>
                                    <div class="<?php echo $col; ?>">
                                        <div id="chart-defined_table<?php echo $id; ?>"></div>
                                    </div>
                                    <?php
                                }elseif($table_pos == '3'){
                                    ?>
                                    <div class="<?php echo $col; ?>">
                                        <div id="chart-defined_table<?php echo $id; ?>"></div>
                                    </div>
                                    <?php
                                }
                                ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php
    }
    
    public static function chart_line_labels($title,$subtitle,$title_y,$data,$sample='',$id='id1',$req_table='',$table_pos='',$height='400'){
        global $jquery_version;
        if($sample == 'Y'){
            if($data != '1'){
                $data_sample = chart_datasample::sample_data_line_labels();
                $title = $data_sample['title'];
                $subtitle = $data_sample['subtitle'];
                $title_y = $data_sample['title_y'];
                $data = $data_sample['data'];
            }else{
                $data_sample = chart_datasample::sample_data_line_labels('N');
                $title = $data_sample['title'];
                $subtitle = $data_sample['subtitle'];
                $title_y = $data_sample['title_y'];
                $data = $data_sample['data'];
            }
        }
        $get_data = chart_func::tune_dataset_line_labels($data);
        $data_cat = $get_data['data_cat'];
        $data_list = $get_data['data_list'];
        if($jquery_version == '1'){
        ?>
            <script type="text/javascript">
                $(function () {
                    $('#chart-line_labels<?php echo $id; ?>').highcharts({
                        chart: {
                            type: 'line'
                        },
                        title: {
                            text: '<?php echo $title; ?>'
                        },
                        subtitle: {
                            text: '<?php echo $subtitle; ?>'
                        },
                        xAxis: {
                            categories: <?php echo $data_cat; ?>
                        },
                        yAxis: {
                            title: {
                                text: '<?php echo $title_y; ?>'
                            }
                        },
                        plotOptions: {
                            line: {
                                dataLabels: {
                                    enabled: true
                                },
                                enableMouseTracking: false
                            }
                        },
                        series: <?php echo $data_list; ?>
                    });
                });
            </script>
            <?php
            }elseif($jquery_version == '2'){
                ?>
                    <script type="text/javascript">
                        $(function () {
                            var chart = new Highcharts.Chart({
                                chart: {
                                    type: 'line',
                                    renderTo: 'chart-line_labels<?php echo $id; ?>'
                                },
                                title: {
                                    text: '<?php echo $title; ?>'
                                },
                                subtitle: {
                                    text: '<?php echo $subtitle; ?>'
                                },
                                xAxis: {
                                    categories: <?php echo $data_cat; ?>
                                },
                                yAxis: {
                                    title: {
                                        text: '<?php echo $title_y; ?>'
                                    }
                                },
                                plotOptions: {
                                    line: {
                                        dataLabels: {
                                            enabled: true
                                        },
                                        enableMouseTracking: false
                                    }
                                },
                                series: <?php echo $data_list; ?>

                            });
                        });
                    </script>
                <?php
            }
            if($req_table == 'Y'){
                if($table_pos == '3'){
                    $col = "col-md-6";
                }else{
                    $col = "col-md-12";
                }
                ?>
                <div class="<?php echo $col; ?>">
                    <div id="chart-line_labels<?php echo $id; ?>" style="min-width: auto; height: <?php echo $height; ?>px; margin: 0 auto"></div>
                </div>
                <div class="<?php echo $col; ?>">
                    <?php chart::table_chart($data,"chart-line_labels$id"); ?>
                </div>
                <?php

            }else{
                ?>
                    <div id="chart-line_labels<?php echo $id; ?>" style="min-width: auto; height: <?php echo $height; ?>px; margin: 0 auto"></div>
                <?php
            }
            ?>
        <?php
    }
    
    public static function chart_dual_barnline(){
        ?>
            <script type="text/javascript">
                $(function () {
                    $('#containerx23').highcharts({
                        chart: {
                            zoomType: 'xy'
                        },
                        title: {
                            text: 'Average Monthly Temperature and Rainfall in Tokyo'
                        },
                        subtitle: {
                            text: 'Source: WorldClimate.com'
                        },
                        xAxis: [{
                            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                                'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                            crosshair: true
                        }],
                        yAxis: [{ // Primary yAxis
                            labels: {
                                format: '{value}Â°C',
                                style: {
                                    color: Highcharts.getOptions().colors[1]
                                }
                            },
                            title: {
                                text: 'Temperature',
                                style: {
                                    color: Highcharts.getOptions().colors[1]
                                }
                            }
                        }, { // Secondary yAxis
                            title: {
                                text: 'Rainfall',
                                style: {
                                    color: Highcharts.getOptions().colors[0]
                                }
                            },
                            labels: {
                                format: '{value} mm',
                                style: {
                                    color: Highcharts.getOptions().colors[0]
                                }
                            },
                            opposite: true
                        }],
                        tooltip: {
                            shared: true
                        },
                        legend: {
                            layout: 'vertical',
                            align: 'left',
                            x: 120,
                            verticalAlign: 'top',
                            y: 100,
                            floating: true,
                            backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
                        },
                        series: [{
                            name: 'RainfallXXX',
                            type: 'column',
                            yAxis: 1,
                            data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4],
                            tooltip: {
                                valueSuffix: ' mm'
                            }

                        }, {
                            name: 'TemperatureZZZ',
                            type: 'spline',
                            data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6],
                            tooltip: {
                                valueSuffix: 'Â°C'
                            }
                        }]
                    });
                });
            </script>

            <div id="containerx23" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
        <?php
    }
    
    public static function chart_donut($title,$subtitle,$data,$sample='',$id='id1',$req_table='',$table_pos=''){
        global $jquery_version;
        if($sample == 'Y'){
            if($data != '1'){
                $data_sample = chart_datasample::sample_data_donut();
                $title = $data_sample['title'];
                $subtitle = $data_sample['subtitle'];
                $data = $data_sample['data'];
            }else{
                $data_sample = chart_datasample::sample_data_donut('N');
                $title = $data_sample['title'];
                $subtitle = $data_sample['subtitle'];
                $data = $data_sample['data'];
            }
        }
        $get_data = chart_func::tune_dataset_donut($data);
        if($jquery_version == '1'){
        ?>
            <script type="text/javascript">
                $(function () {
                    $('#container-donut<?php echo $id; ?>').highcharts({
                        chart: {
                            type: 'pie',
                            options3d: {
                                enabled: true,
                                alpha: 45
                            }
                        },
                        title: {
                            text: '<?php echo $title; ?>'
                        },
                        subtitle: {
                            text: '<?php echo $subtitle; ?>'
                        },
                        plotOptions: {
                            pie: {
                                innerSize: 100,
                                depth: 45,
                                dataLabels: {
                                    enabled: true,
                                    format: '<b>{point.name}</b>: {point.percentage:.1f} % ( {point.y} )',
                                    style: {
                                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                                    },
                                    connectorColor: 'silver'
                                }
                            }
                        },
                        series: [{
                            name: '-',
                            data: <?php echo $get_data; ?>
                        }]
                    });
                });
            </script>
            <?php
        }elseif($jquery_version == '2'){
            ?>
                <script type="text/javascript">
                    $(function () {
                        
                        var chart = new Highcharts.Chart({
                            chart: {
                                type: 'pie',
                                options3d: {
                                    enabled: true,
                                    alpha: 45
                                },
                                renderTo: 'container-donut<?php echo $id; ?>'
                            },
                            title: {
                                text: '<?php echo $title; ?>'
                            },
                            tooltip: {
                                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                            },
                            plotOptions: {
                                pie: {
                                    innerSize: 100,
                                    depth: 45,
                                    dataLabels: {
                                        enabled: true,
                                        format: '<b>{point.name}</b>: {point.percentage:.1f} % ( {point.y} )',
                                        style: {
                                            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                                        },
                                        connectorColor: 'silver'
                                    }
                                }
                            },
                            series: [{
                                name: '-',
                                data: <?php echo $get_data; ?>
                            }]
                        });
                    });
                </script>    
            <?php
        }
            if($req_table == 'Y'){
                if($table_pos == '3'){
                    $col = "col-md-6";
                }else{
                    $col = "col-md-12";
                }
                ?>
                <div class="<?php echo $col; ?>">
                    <div id="container-donut<?php echo $id; ?>" style="height: 400px"></div>
                </div>
                <div class="<?php echo $col; ?>">
                    <?php chart::table_chart($data,"container-donut$id"); ?>
                </div>
                <?php

            }else{
                ?>
                    <div id="container-donut<?php echo $id; ?>" style="height: 400px"></div>
                <?php
            }
            ?>
            
        <?php
    }
    
    public static function table_chart($data,$id){
        $get_data = chart_func::tune_dataset_table_view($data);
        $data_cat = $get_data['data_cat'];
        $data_list = $get_data['data_list'];

            ?>
            <!-- Start Content -->
            <div class="page-content">
                <div class="row">
                    <table id="<?php echo $id; ?>" border="1" width="100%" class="table table-bordered table-condensed table-hover">
                        <thead>
                            <tr>
                                <?php 
                                    $bil_cat = COUNT($data_cat);
                                    for($x=0 ; $x<$bil_cat ; $x++){
                                        ?>
                                            <th <?php if($x != '0'){ echo "align='center'"; }?>><?php echo $data_cat[$x]; ?></th>
                                        <?php
                                    }
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if(is_array($data_list)){
                                foreach ($data_list as $row => $values){
                                    $bil_list = COUNT($values);
        //                            $bil_list = $bil_list - 1;
                                    ?>
                                        <tr>
                                            <?php
                                                for($y=0 ; $y<$bil_list ; $y++){
                                                    ?>
                                                        <td <?php if($y != '0'){ echo "align='center'"; } ?> ><?php echo $values[$y]; ?></td>
                                                    <?php
                                                }
                                            ?>
                                        </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>               
        <?php
    }
    
}
