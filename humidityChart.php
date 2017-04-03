<?php
  include ("session.php");
  include ("connect.php");

  $link=Connection();

  $strDate = "Today";
  $groupBy = "HOUR";
  $currentDate = date('Y-m-d'); 
  $startDate = $currentDate;
  $startTRP = date('F d, Y');
  $endDate = $currentDate;
  $endTRP = date('F d, Y');

  if(isset($_GET["startDate"]) && isset($_GET["endDate"])){
    $startDate = $_REQUEST["startDate"];
    $startTRP = date('F d, Y',strtotime($startDate));
    $endDate = $_REQUEST["endDate"];
    $endTRP = date('F d, Y',strtotime($endDate));
  }

  if(date("N",strtotime($currentDate))==1){
		$weekStartDate = $currentDate;
		$weekEndDate = date('Y-m-d',strtotime("next Sunday", strtotime($currentDate)));
	} elseif (date("N",strtotime($currentDate))==7) {
		$weekStartDate = date('Y-m-d',strtotime("last Monday", strtotime($currentDate)));
		$weekEndDate = $currentDate;
	}else{
		$weekStartDate = date('Y-m-d',strtotime("last Monday", strtotime($currentDate)));
  	$weekEndDate = date('Y-m-d',strtotime("next Sunday", strtotime($currentDate)));
	}

  $current = new DateTime($currentDate);
  $start = new DateTime($startDate);
  $end = new DateTime($endDate);
  $startWeek = new DateTime($weekStartDate);
  $endWeek = new DateTime($weekEndDate);
  $startMonth = new DateTime(date('Y-m-1'));
  $endMonth = new DateTime(date('Y-m-t'));
  $startLastMonth = new DateTime(date('Y-m-1',strtotime("-1 month")));
  $endLastMonth = new DateTime(date('Y-m-t',strtotime("-1 month")));
  $startYear = new DateTime(date('Y-1-1'));
  $endYear = new DateTime(date('Y-12-31'));

  $numStart = $start->diff($current)->format("%a");
  $numEnd = $end->diff($current)->format("%a");
  $numStartWeek = $start->diff($startWeek)->format("%a");
  $numEndWeek = $end->diff($endWeek)->format("%a");
  $numStartMonth = $start->diff($startMonth)->format("%a");
  $numEndMonth = $end->diff($endMonth)->format("%a");
  $numStartLastMonth = $start->diff($startLastMonth)->format("%a");
  $numEndLastMonth = $end->diff($endLastMonth)->format("%a");
  $numStartYear = $start->diff($startYear)->format("%a");
  $numEndYear = $end->diff($endYear)->format("%a");  

  if ($numStart==0 && $numEnd==0) {
    $strDate = "Today";
    $groupBy = "HOUR";
  }else if ($numStart==1 && $numEnd==1) {
    $strDate = "Yesterday";
    $groupBy = "HOUR";
  }else if ($numStartWeek==0 && $numEndWeek==0) {
    $strDate = "This Week";
    $groupBy = "DAY";
  }else if ($numStartMonth==0 && $numEndMonth==0) {
    $strDate = "This Month";
    $groupBy = "DAY";
  }else if($numStartLastMonth==0 && $numEndLastMonth==0){
    $strDate = "Last Month";
    $groupBy = "DAY";
  }else if($numStartYear==0 && $numEndYear==0){
    $strDate = "This Year";
    $groupBy = "MONTH";
  }else{
    $strDate = "Custom";
    $groupBy = "DAY";
  }

  $resultMax=mysqli_query($link,"SELECT ROUND(MAX(`humidity`),1) AS `max` FROM `templog` 
    WHERE DATE(`timeStamp`) BETWEEN '".$startDate."' AND '".$endDate."'");
  $resultMin=mysqli_query($link,"SELECT ROUND(MIN(`humidity`),1) AS `min` FROM `templog` 
    WHERE DATE(`timeStamp`) BETWEEN '".$startDate."' AND '".$endDate."'");
  $resultAVG=mysqli_query($link,"SELECT ROUND(AVG(`humidity`),1) AS `avg` FROM `templog` 
    WHERE DATE(`timeStamp`) BETWEEN '".$startDate."' AND '".$endDate."'");

  $data = array();
  $result=mysqli_query($link,"SELECT (UNIX_TIMESTAMP(CONVERT_TZ(`timeStamp`, '+00:00', @@global.time_zone))*1000) AS t, ROUND(MAX(`humidity`),2) AS avg FROM templog 
    WHERE DATE(`timeStamp`) BETWEEN '".$startDate."' AND '".$endDate."' 
    GROUP BY YEAR(`timeStamp`), ".$groupBy."(`timeStamp`)");
  if($result!=FALSE){
    while($row = mysqli_fetch_array($result)) {
        $r[0] = $row['t'];
        $r[1] = $row["avg"]; 
        array_push($data,$r);
    }   
  }
?>

  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Humidity page</title>

    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <link href="build/css/custom.min.css" rel="stylesheet">
    <script src="https://code.highcharts.com/highcharts.js"></script>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">      
        <div class="col-md-3 left_col menu_fixed">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.php" class="site_title"><i class="fa fa-paw"></i> <span>IoT</span></a>
            </div>
            <div class="clearfix"></div>
            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="images/img.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo $userData['username']; ?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->
            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu">
                  <li><a href="index.php"><i class="fa fa-home"></i> Home </a></li>               
                  <li><a href="showData.php"><i class="fa fa-table"></i>Data Table</a></li>               
                  <li><a><i class="fa fa-bar-chart-o"></i> Data Presentation <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="temperatureChart.php">Temperature</a></li>
                      <li><a href="humidityChart.php">Humidity</a></li>
                      <li><a href="moistureChart.php">Moisture</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->           
          </div>
        </div>
        <!-- top navigation -->
        <div class="top_nav navbar-fixed-top">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="images/img.jpg" alt=""><?php echo $userData['username']; ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;">Help</a></li>
                    <li><a href="userAccount.php?logoutSubmit=1"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->     
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <br/>
              <br/>
              <!-- top tiles -->
              <div class="row tile_count">
                <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
                  <div class="count_top"><i class="fa fa-line-chart blue"></i> Data</div>
                  <div class="count blue"><?php echo $strDate; ?></div>
                </div>
                <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
                  <span class="count_top"><i class="fa fa-arrow-up green"></i> Maximum</span>
                  <div class="count green">
                    <?php
                      if($resultMax!==FALSE){
                        $rowMax = mysqli_fetch_array($resultMax);
                        if($rowMax['max'] == null)
                          echo 0;
                        else
                          echo $rowMax['max'];
                        mysqli_free_result($resultMax);
                      }else
                      echo 0;
                    ?>
                  </div>
                </div>
                <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
                  <span class="count_top"><i class="fa fa-arrow-down red"></i> Minimum</span>
                  <div class="count red">
                    <?php
                      if($resultMin!==FALSE){
                        $rowMin = mysqli_fetch_array($resultMin);
                        if($rowMin['min'] == null)
                          echo 0;
                        else
                          echo $rowMin['min'];
                        mysqli_free_result($resultMin);
                      }else
                      echo 0;
                    ?>
                  </div>
                </div>
                <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
                  <span class="count_top"><i class="fa fa-plus-square-o"></i> Average</span>
                  <div class="count">
                    <?php
                      if($resultAVG!==FALSE){
                        $rowAVG = mysqli_fetch_array($resultAVG);
                        if($rowAVG['avg'] == null)
                          echo 0;
                        else
                          echo $rowAVG['avg'];
                        mysqli_free_result($resultAVG);
                      }else
                      echo 0;
                    ?>
                  </div>
                </div>
              </div>
            </div>
            <!-- /top tiles -->
          </div>
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_content">
                <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="dashboard_graph x_panel">
                      <div class="row x_title">
                        <div class="col-md-6">
                          <h3>Humidity Chart</h3>
                        </div>
                        <div class="col-md-6">
                          <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                            <span></span> <b class="caret"></b>
                          </div>
                        </div>
                      </div>
                      <div class="x_content">
                        <div class="demo-container" style="height:450px">
                          <div id="placeholder3xx3" class="demo-placeholder" style="width: 100%; height:400px;">
                            
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /page content -->
      <!-- footer content -->
      <footer>
        <div class="pull-right">
        </div>
        <div class="clearfix"></div>
      </footer>
      <!-- /footer content -->
    </div>
  </div>

  <script src="vendors/jquery/dist/jquery.min.js"></script>
  <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="vendors/DateJS/build/date.js"></script>
  <script src="vendors/moment/min/moment.min.js"></script>
  <script src="vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
  <script src="build/js/custom.min.js"></script>

  <script type="text/javascript">
   $(document).ready(function() {
    var startDate = '<?php echo $startTRP ?>';
    var endDate = '<?php echo $endTRP ?>';
    $('#reportrange').daterangepicker(
    {
      startDate: moment().subtract(1, 'days'),
      endDate: moment(),
      minDate: '01/01/2016',
      maxDate: '12/31/2030',
      dateLimit: {
        days: 60
      },
      showDropdowns: true,
      showWeekNumbers: true,
      timePicker: false,
      timePickerIncrement: 1,
      timePicker12Hour: true,
      ranges: {
        'Select Day!':[moment().subtract(1, 'days'),moment()],
        'Today': [moment(), moment()],
        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'This Week': [moment().startOf('isoweek'), moment().endOf('isoweek')],
        'This Month': [moment().startOf('month'), moment().endOf('month')],
        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
        'This Year': [moment().startOf('year'), moment().endOf('year')]
      },
      opens: 'left',
      buttonClasses: ['btn btn-default'],
      applyClass: 'btn-small btn-primary',
      cancelClass: 'btn-small',
      format: 'MM/DD/YYYY',
      separator: ' to ',
      locale: {
        applyLabel: 'Submit',
        fromLabel: 'From',
        toLabel: 'To',
        customRangeLabel: 'Custom',
        daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
        monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        firstDay: 1
      }
    },
    function(start, end) {
      console.log("Callback has been called!");
      $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
      window.location.href="humidityChart.php?startDate="+start.format('YYYY-M-D')+"&endDate="+end.format('YYYY-M-D');
    }
    );
    $('#reportrange span').html(startDate + ' - ' + endDate);
  });

  $(function(){
    Highcharts.chart('placeholder3xx3', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Average Humidity'
    },
    global: {
        useUTC: false
    },
    xAxis: {
        type: 'datetime',
        tickPixelInterval: 150,
        maxZoom: 20 * 1000
    },
    yAxis: {
        title: {
            text: 'Humidity (%)'
        },
        labels: {
            formatter: function () {
                return this.value;
            }
        }
    },
    tooltip: {
        crosshairs: true,
        shared: true
    },
    plotOptions: {
        spline: {
            marker: {
                radius: 4,
                lineColor: '#666666',
                lineWidth: 1
            }
        }
    },
    series: [{
        name: 'Ho Chi Minh',
        data: <?php print json_encode($data, JSON_NUMERIC_CHECK); ?>
    }]
  });
});

</script>
</body>
</html>