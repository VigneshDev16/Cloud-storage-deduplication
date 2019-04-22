 <?php
session_start();
if( !isset($_SESSION['user']) ) {
		header("Location: index.php");
		exit;
	}
	$user = $_SESSION['userName'];
	$uid = $_SESSION['user'];
require_once('dbconnect.php');
$con = dbconnect();
$fid = $_GET['fid'];
$query = mysqli_query($con, "SELECT * from Ifiles WHERE  fid= '$fid' and uid ='$uid'");
$query1 = mysqli_fetch_array($query);
$fname = $query1['name'];
$lid = $query1['lid'];
if($lid!= 0) $query = mysqli_query($con, "SELECT * from Ifiles WHERE  fid= '$lid'");
else $query = mysqli_query($con, "SELECT * from Ifiles WHERE  fid= '$fid' and uid ='$uid'");

$q = mysqli_fetch_array($query);
$name= $q['name'];
$fid = $q['fid'];
$name="images/".$fid.$name;
$fh = fopen($name,'r');
$data = fread($fh,filesize($name));
fclose($fh);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<!-- META TAGS -->
	  <link rel="shortcut icon" href="css/favicon.ico" type="image/x-icon">
	<link rel="icon" href="css/favicon.ico" type="image/x-icon">
	<!--CSS Files-->
	<link rel="stylesheet" href="css/style.css" type=''>
	<!-- CDN'S-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css"/>
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	<!--Fonts-->
	<link href='http://fonts.googleapis.com/css?family=Droid+Sans|Lobster' rel='stylesheet' type='text/css'>
	<title>Project</title>
</head>
<body>
	<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand">Project</a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="home.php">Home<span class="sr-only">(current)</span></a></li>
        <!--<li><a href="#"> Upload Files</a></li>
       	<li><a href="#"> Login</a></li>
       	<li><a href="#">Logged in as <?php echo $user ?></a></li>-->
	<li><a href="#">Logged in as <?php echo $user ?></a></li>
	<li><a href="logout.php?logout"> Logout</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
    <br>
    <div class="panel panel-primary " >
		<div class="panel-heading">
			<h2>Uploaded File Details</h2>
		</div>
			<div class="panel-body">
<table><tr>
<td><label>Image Name:</label></td>
<td><input type="text" value="<?php echo $fname ?>" name="fname" readonly></td></tr><br/><br/>
<td><label>Image :</label></td>
<td><img src="<?php echo $name ?>" style="width:500px;height:500px;"/></td></tr>


    		    	</div>
    </div>
  </div><!-- /.container-fluid -->
</nav>
</body>
</html>
<?php 
 ?>
