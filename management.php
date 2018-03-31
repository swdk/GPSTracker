<?php




$servername = "127.0.0.1";
$username = "root";
$password = "root";
$dbname = "tracer";

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";

$result = mysqli_query($conn, "SELECT * FROM tracer.record Limit 5");

$lat=array();
$lng=array();
$row_count=0;

while ($row = mysqli_fetch_row($result)){
 	array_push($lat,$row[2]);
 	array_push($lng,$row[3]);
 	$row_count = $row_count +1;
}


?>

<html>
   
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>EM | Empployee Management</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link href="./bower_components/AdminLTE/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
   <link href="./bower_components/AdminLTE/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect.
  -->
   <link href="./bower_components/AdminLTE/dist/css/skins/skin-blue.min.css" rel="stylesheet" type="text/css" />

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

          
</head>





  <body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
    <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>E</b>M</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">Care Management</span>
    </a>

    <!-- Header Navbar -->
          <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
              <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
              <ul class="nav navbar-nav">
                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                  <!-- Menu Toggle Button -->
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <!-- The user image in the navbar-->
                    <img src="./bower_components/AdminLTE/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                    <!-- hidden-xs hides the username on small devices so only the image appears. -->
                    <span class="hidden-xs">Samuel</span>
                  </a>
                  <ul class="dropdown-menu">
                    <!-- The user image in the menu -->
                    <li class="user-header">
                      <img src="./bower_components/AdminLTE/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                      <p>
                        Hello Samuel
                      </p>
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                     @if (Auth::guest())
                        <div class="pull-left">
                          <a href="{{ route('login') }}" class="btn btn-default btn-flat">Login</a>
                        </div>
                     @else
                       <div class="pull-left">
                          <a href="{{ url('profile') }}" class="btn btn-default btn-flat">Profile</a>
                        </div>
                       <div class="pull-right">
                          <a class="btn btn-default btn-flat" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                          Logout
                          </a>
                       </div>
                      @endif
                    </li>
                  </ul>
                </li>
              </ul>
            </div>
          </nav>
        </header>
         <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
         </form>
  <!-- Sidebar -->
          <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="./bower_components/AdminLTE/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Samuel</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- search form (Optional) -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <!-- Optionally, you can add icons to the links -->
        <li ><a href="index.php"><i class="fa fa-link"></i> <span>Dashboard</span></a></li>
        <li class="active"><a href="management.php"><i class="fa fa-link"></i> <span>Trigger Management</span></a></li>

      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
      </h1>
      <ol class="breadcrumb">
        <!-- li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li-->
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    
     </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Footer -->
    <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2017 <a href="#">Company</a>.</strong> All rights reserved.
  </footer>
  
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

 <!-- jQuery 2.1.3 -->
<script src="./bower_components/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js""></script>

<!-- Bootstrap 3.3.2 JS -->
<script src="./bower_components/AdminLTE/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

<!-- AdminLTE App -->
<script src="./bower_components/AdminLTE/dist/js/app.min.js" type="text/javascript"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
</body>
</html>



