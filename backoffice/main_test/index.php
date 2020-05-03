<?php 

    require(dirname(__FILE__).'/../check.php');

?>

<!doctype html>

<html lang="en" dir="ltr">



<head>

    <?php 

    require(dirname(__FILE__).'/../template/head.php');

?>



    <!-- Custom scroll bar css-->

    <link href="/office69/assets/plugins/scroll-bar/jquery.mCustomScrollbar.css" rel="stylesheet">

    <!-- Sidebar Accordions css -->

    <link href="/office69/assets/plugins/accordion1/css/dark-easy-responsive-tabs.css" rel="stylesheet">

    <!-- Morris  Charts css-->

    <link href="/office69/assets/plugins/morris/morris.css" rel="stylesheet"/>

    
    





<body class="app sidebar-mini rtl">







    <div class="page">

        <div class="page-main">

            <?php 
            
            require(dirname(__FILE__).'/../template/menuside.php'); 
            
            require(dirname(__FILE__).'/../class/database.php');



            $mysqli = new DB();

            $topup = $mysqli->query("SELECT sum(topup_amount) as value,count(*) as count_today FROM slot_topup WHERE  topup_amount > 0 AND DATE(topup_datetime) LIKE ?",date('Y-m-d'))->fetchArray();

            /*$user = $mysqli->query("SELECT count(*) as count_today FROM sa_member WHERE DATE(member_vip_date) LIKE ?",date('Y-m-d'))->fetchArray();

            $bonus = $mysqli->query("SELECT count(topup_bonus) as bonus_today FROM sa_topup WHERE DATE(topup_datetime) LIKE ? AND topup_bonus <> 0",date('Y-m-d'))->fetchArray();

            */



            $withdraw = $mysqli->query("SELECT sum(wd_amount) as value,count(*) as count_today FROM slot_withdraw WHERE DATE(wd_datetime) LIKE ? AND wd_status = 1",date('Y-m-d'))->fetchArray();
            
            
            
            ?>
        <!-- app-content-->

            <div class="container content-area">

                <div class="side-app">



                    <!-- page-header -->

                    <div class="page-header">

                        <ol class="breadcrumb">

                            <!-- breadcrumb -->

                            <li class="breadcrumb-item">Home</li>

                            <li class="breadcrumb-item active" aria-current="page">Summary (Today)</li>

                        </ol><!-- End breadcrumb -->

                    </div>

                    <!-- End page-header -->

                    <?php if($_SESSION['admin']['admin_level'] == 99){ ?>

                    <div class="row">

                        <div class="col-xl-4 col-lg-6 col-md-12 col-sm-12">

                            <div class="card card-counter bg-gradient-secondary ">

                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-4">

                                            <i class="fa fa fa-plus-circle mt-3 mb-0 text-white-transparent"></i>

                                        </div>

                                        <div class="col-8 text-center">

                                            <div class="mt-4 mb-0 text-white">

                                                <h2 class="mb-0">
                                                        <span id="value_topup">0</span>
                                                </h2>

                                                <p class="text-white mt-1">ยอดฝาก</p>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div><!-- col end -->

                        <div class="col-xl-4 col-lg-6 col-md-12 col-sm-12">

                            <div class="card card-counter bg-gradient-danger">

                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-4">

                                            <i class="fa fa-minus-circle mt-3 mb-0 text-white-transparent"></i>

                                        </div>

                                        <div class="col-8 text-center">

                                            <div class="mt-4 mb-0 text-white">

                                                <h2 class="mb-0">
                                                
                                                <span id="value_withdraw">0</span>
                                                
                                                </h2>

                                                <p class="text-white mt-1">ยอดถอน</p>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div><!-- col end -->

                        <div class="col-xl-4 col-lg-6 col-md-12 col-sm-12">

                            <div class="card card-counter bg-gradient-success">

                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-4">

                                            <i class="fa fa-money mt-3 mb-0 text-white-transparent"></i>

                                        </div>

                                        <div class="col-8 text-center">

                                            <div class="mt-4 mb-0 text-white">

                                                <h2 class="mb-0" >
                                                
                                                <span id="profit">0</span>
                                                
                                                </h2>

                                                <p class="text-white mt-1">กำไร</p>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div><!-- col end -->

                    </div>

                    <?php } ?>





                    <div class="row">

                        <div class="col-xl-6 col-md-12">

                            <div class="card card-img-holder">

                                <div class="card-body">

                                    <div class="clearfix">

                                        <div class="float-left">

                                            <p class="text-muted mb-1">รายการฝาก</p>

                                            <h1 class="mb-0 text-dark mainvalue" id="count_today_topup">0</h1>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-xl-6 col-md-12">

                            <div class="card card-img-holder">

                                <div class="card-body">

                                    <div class="clearfix">

                                        <div class="float-left">

                                            <p class="text-muted mb-1">รายการถอน (<?php echo gmdate('i:s',$withdraw_time['avgdiff']);?>)</p>

                                            <h1 class="mb-0 text-dark mainvalue">
                                                <span id="count_today_withdraw" name="count_today_withdraw">0</span>
                                            </h1>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>





                    <?php if($_SESSION['admin']['admin_level'] == 99){ ?>

                    <div class="row">

                        <div class="col-12">

                            <div class="card">

                                <div class="card-header">

                                    <h3 class="card-title">สรุป7วันย้อนหลัง</h3>

                                </div>

                                <div class="card-body">

                                    <div id="echart2" class="chartsh chart-dropshadow"></div>

                                </div>

                            </div>

                        </div>

                        <div class="col-12">

                            <div class="card">

                                <div class="card-header custom-header">

                                    <div>

                                        <h3 class="card-title">Topup</h3>

                                        <h6 class="card-subtitle">แยกยอดฝากย้อนหลัง 7 วัน</h6>

                                    </div>

                                </div>

                                <div class="card-body">

                                    <div id="echart1" class="chartsh chart-dropshadow"></div>

                                    <div class="text-center mt-3">

                                        <span class="dot-label bg-secondary"></span><span

                                            class="mr-3 text-dark">SCB</span>

                                        <span class="dot-label bg-warning"></span><span

                                            class="mr-3 text-dark">Wallet</span>

                                    </div>

                                </div>

                            </div>

                        </div>



                    </div>

                    <?php

                    } 

                    ?>











                </div>

                <!--End side app-->

            </div>

            <!-- End app-content-->

            <?php 

        	require(dirname(__FILE__).'/../template/footer.php');

    	?>



        </div>

    </div>

    <!-- End Page -->



    <!-- Back to top -->

    <a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>



    <?php 

        	require(dirname(__FILE__).'/../template/js.php');

    	?>



    <!-- Custom scroll bar js-->

    <script src="/office69/assets/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js"></script>

    <!-- Sidebar Accordions js -->

    <script src="/office69/assets/plugins/accordion1/js/easyResponsiveTabs.js"></script>

    <!-- ECharts js -->

    <script src="/office69/assets/plugins/echarts/echarts.js"></script>

    <!-- Custom-charts js-->

    <script src="/office69/assets/js-dark/index4.js"></script>

    <!-- Custom js-->

    <script src="/office69/assets/js-dark/custom.js" type="text/javascript"></script>


    




    <?php if($_SESSION['admin']['admin_level'] == 99){ ?>

    <script>

     <?php

    // topup

    $topup_g = $mysqli->query('SELECT SUM(topup_amount) As Total, DATE_FORMAT(topup_datetime, "%Y-%m-%d") As Datetime

    FROM slot_topup WHERE topup_amount > 0

    Group By YEAR(topup_datetime),Month(topup_datetime),Day(topup_datetime)

    ORDER BY topup_datetime DESC

    LIMIT 7')->fetchAll(); 

    $arr = 6;

    foreach($topup_g as $result){

        $topup_each[$arr]['datetime'] = $result['Datetime'];

        $topup_each[$arr]['value'] = (int)$result['Total'];

        $arr--;

    }

    // withdraw

    $withdraw_g = $mysqli->query('SELECT SUM(wd_amount) As Total, DATE_FORMAT(wd_datetime, "%Y-%m-%d") As Datetime

    FROM slot_withdraw

    WHERE wd_status = 1

    Group By YEAR(wd_datetime),Month(wd_datetime),Day(wd_datetime)

    ORDER BY wd_datetime DESC

    LIMIT 7')->fetchAll(); 

    $arr = 6;

    foreach($withdraw_g as $result){

        $wd_each[$arr]['datetime'] = $result['Datetime'];

        $wd_each[$arr]['value'] = (int)$result['Total'];

        $arr--;

    }

     //wallet

    $wallet_g = $mysqli->query("SELECT SUM(topup_amount) As Total, DATE_FORMAT(topup_datetime, '%Y-%m-%d') As Datetime

    FROM slot_topup

    WHERE topup_type = 'wallet'

    Group By YEAR(topup_datetime),Month(topup_datetime),Day(topup_datetime)

    ORDER BY topup_datetime DESC

    LIMIT 7")->fetchAll(); 

    $arr = 6;

    foreach($wallet_g as $result){

        $wallet_each[$arr]['datetime'] = $result['Datetime'];

        $wallet_each[$arr]['value'] = (int)$result['Total'];

        $arr--;

    }

    

    //bank

    $bank = $mysqli->query("SELECT SUM(topup_amount) As Total, DATE_FORMAT(topup_datetime, '%Y-%m-%d') As Datetime

    FROM slot_topup

    WHERE topup_type NOT IN ('wallet','free') AND topup_amount > 0

    Group By YEAR(topup_datetime),Month(topup_datetime),Day(topup_datetime)

    ORDER BY topup_datetime DESC

    LIMIT 7")->fetchAll(); 

    $arr = 6;

    foreach($bank as $result){

        $bank_each[$arr]['datetime'] = $result['Datetime'];

        $bank_each[$arr]['value'] = (int)$result['Total'];

        $arr--;

    }



    sort($wd_each);

    sort($topup_each);

    sort($wallet_each);

    sort($bank_each);

?>

      /*echart1*/

    var chartdata = [

        {

        name: 'Wallet',

        type: 'bar',

        data: [<?php foreach($wallet_each as $key => $result){ echo $result['value'].(($key != (count($wallet_each)-1) )?',':'');} ?>]

        },

        {

        name: 'BANK',

        type: 'bar',

        data: [<?php foreach($bank_each as $key => $result){ echo $result['value'].(($key != (count($bank_each)-1) )?',':'');} ?>]

        }

    ];



    var chart = document.getElementById('echart1');

    var barChart = echarts.init(chart);



    var option = {

        grid: {

        top: '5',

        right: '0',

        bottom: '25',

        left: '25',

        },

        xAxis: {

        data: [<?php foreach($topup_each as $key => $result){ echo '\''.$result['datetime'].'\''.(($key != (count($topup_each)-1) )?',':'');} ?>],

        axisLine: {

            lineStyle: {

            color: 'rgba(255,255,255,0.05)'

            }

        },

        axisLabel: {

            fontSize: 10,

            color: '#546172'

        }

        },

        tooltip: {

        show: true,

        showContent: true,

        alwaysShowContent: true,

        triggerOn: 'mousemove',

        trigger: 'axis',

        axisPointer: {

            label: {

            show: false,

            }

        }



        },

        yAxis: {

        splitLine: {

            lineStyle: {

            color: 'rgba(255,255,255,0.05)'

            }

        },

        axisLine: {

            lineStyle: {

            color: 'rgba(255,255,255,0.05)'

            }

        },

        axisLabel: {

            fontSize: 10,

            color: '#546172'

        }

        },

        series: chartdata,

        color: ['#ffca4a', '#9258f1']

    };



    barChart.setOption(option);



    /*--echart-1---*/

   

    /*-----echart 2-----*/

    var chartdata2 = [{

        name: 'ยอดฝาก',

        type: 'line',

        smooth: true,

        data: [<?php foreach($topup_each as $key => $result){ echo $result['value'].(($key != (count($topup_each)-1) )?',':'');} ?>],

        color: ['#3cbf2d']

        },

        {

        name: 'ยอดถอน',

        type: 'line',

        smooth: true,

        size: 10,

        data: [<?php foreach($wd_each as $key => $result){ echo $result['value'].(($key != (count($wd_each)-1) )?',':'');} ?>],

        color: ['#f33540']

        }

    ];



    var chart2 = document.getElementById('echart2');

    var barChart2 = echarts.init(chart2);



    var option2 = {

        grid: {

        top: '5',

        right: '0',

        bottom: '25',

        left: '25',

        },

        xAxis: {

        data: [<?php foreach($topup_each as $key => $result){ echo '\''.$result['datetime'].'\''.(($key != (count($topup_each)-1) )?',':'');} ?>],

        axisLine: {

            lineStyle: {

            color: 'rgba(255,255,255,0.05)'

            }

        },

        axisLabel: {

            fontSize: 10,

            color: '#546172'

        }

        },

        tooltip: {

        show: true,

        showContent: true,

        alwaysShowContent: true,

        triggerOn: 'mousemove',

        trigger: 'axis',

        axisPointer: {

            label: {

            show: false,

            }

        }



        },

        yAxis: {

        splitLine: {

            lineStyle: {

            color: 'rgba(255,255,255,0.05)'

            }

        },

        axisLine: {

            lineStyle: {

            color: 'rgba(255,255,255,0.05)'

            }

        },

        axisLabel: {

            fontSize: 10,

            color: '#546172'

        }

        },

        series: chartdata2

    };

    barChart2.setOption(option2);

    </script>

    <?php }

    $mysqli->close();

    ?>

    <script>
    
    function show_data() {
            $.get("api/show_data.php", {
            }, function (data) {

                

                $('#value_topup').text(data.value_topup);
                $('#value_withdraw').text(data.value_withdraw);
                $('#count_today_topup').text(data.count_today_topup);
                $('#count_today_withdraw').val(data.count_today_withdraw);
                $('#profit').text(data.value_topup);

               

            });
        };

        show_data();

        setInterval(function () {

            show_data();

        }, 10000);
    
    </script>

</body>



</html>