<?php
	include ("session.php");
  include ("connect.php");
  $link=Connection();

  $result=mysqli_query($link,"SELECT * FROM sensors");
  if(isset($_POST['add_sensor'])){
    if(!empty($_POST['name']) && !empty($_POST['place'])){
        $name = $_POST['name'];
	      $place = $_POST['place'];

	      $query = "INSERT INTO sensors(name,place, user) 
			            VALUES ('".$name."','".$place."','".$userData['username']."');";
        $addResult = mysqli_query($link,$query);
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

    <title>Index</title>

    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="build/css/custom.min.css" rel="stylesheet">
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
                    <img src="images/img.jpg" alt=""><?php echo $userData['username'];?>
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
              <div class="title_left">
              </div>
            </div>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Equipment Management</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <h2>Sensors Table</h2>
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>ID Sensor</th>
                          <th>Name</th>
                          <th>Place</th>
                          <th>User</th>
                        </tr>
                      </thead>
                      <tbody>
                      	<?php 
  							          if($result!==FALSE){
                            while($row = mysqli_fetch_array($result)) {
                              printf("<tr><td> &nbsp;%s </td><td> &nbsp;%s </td><td> &nbsp;%s&nbsp; </td><td> &nbsp;%s&nbsp; </td></tr>", 
                                $row["id"],$row["name"], $row["place"],$row["user"]);
                            }
                            mysqli_free_result($result);
                            mysqli_close($link);
                          }
                        ?>
                      </tbody>
                    </table>
                  </div>
                  <h2>Add sensor</h2>
                  <form class="form-horizontal form-label-left input_mask" method="POST" action="">
                      <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                        <input type="text" class="form-control has-feedback-left" id="name" name="name" placeholder="Name">
                        <span class="fa fa-cogs form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                        <input type="text" class="form-control has-feedback-left" id="place" name="place" placeholder="Place">
                        <span class="fa fa-location-arrow form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="form-group">
                        <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                          <button type="submit" class="btn btn-success" name="add_sensor">Add</button>
                        </div>
                      </div>

                  </form>
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
    <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="build/js/custom.min.js"></script>

    <script>
        $('#datatable-responsive').DataTable();
    </script> 
  </body>
</html>