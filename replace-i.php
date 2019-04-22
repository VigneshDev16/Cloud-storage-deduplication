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
$fname = $_GET['fname'];
$q = mysqli_query($con, "SELECT * from Ifiles WHERE  name= '$fname' and uid='$uid'");
$q = mysqli_fetch_array($q);
$name= $q['name'];
$lid = $q['lid'];
$fid = $q['fid'];
$query = mysqli_query($con,"DELETE FROM Ifiles WHERE name = '$fname' and uid='$uid'");
$q = mysqli_query($con, "SELECT * from file WHERE  lid= '$fid'");
$count = 0;
if($result = mysqli_fetch_assoc($q))
{	
$count = $result['fid'];
$fname = $result['name'];
exec("cp images/".$fid.$name." images/".$count.$fname);
exec("chmod 777 images/".$count.$fname);
mysqli_query($con,"UPDATE Ifiles set lid = 0 where fid='$count'");
mysqli_query($con,"UPDATE Ifiles set lid ='$count' where lid='$fid'");	
}
$query = mysqli_query($con,"SELECT * FROM Ifiles WHERE name = '$name'and fid='$fid' and uid='$uid'");
$r = mysqli_num_rows($query);
if($r == 0 && $lid == 0)
{
	unlink($_SERVER['DOCUMENT_ROOT'] .'/files/'.$fid.$name);
}
$temp_dir = "temp/";
$temp_file = $temp_dir . $name ;
exec("python test.py $temp_file",$output,$ret_code);
$hash =  $output[0]; 
$query= mysqli_query($con,"SELECT * from Ifiles WHERE hash='$hash' and lid=0");
$query1 = mysqli_num_rows($query);

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
<?php
if($query1 == NULL)
	{
		$result = 0;
	}
else
	{
	//echo $result=mysqli_fetch_assoc($query);
	while($record=mysqli_fetch_assoc($query))
		{
			$q = $record['name'];
			$fid = $record['fid'];
			$q = "images/".$fid.$q;
			$result = exec("python imgcmp.py $q $temp_file", $output , $ret_code );
			if($result == 1)
				{
					echo "We will not insert";
					echo "We Will change your Path";
					mysqli_query($con,"INSERT INTO Ifiles values ('','$name','$hash','$fid','$uid')");
					exec("chmod 777 ".$temp_file);
					unlink($_SERVER['DOCUMENT_ROOT'].'/'.$temp_file);
					break;
				}
		}
	}
	if($result == 0)
		{
			mysqli_query($con,"INSERT INTO Ifiles values ('','$name','$hash','0','$uid')");
			$fid = mysqli_insert_id($con);
			exec("cp ".$temp_file." images/".$fid.$name);
			exec("chmod 777 images/".$fid.$name);
			exec("chmod 777 ".$temp_file);
			unlink($_SERVER['DOCUMENT_ROOT'] .'/'. $temp_file);
			echo "uploaded";
		}
		rmdir("temp");
		
			?>
 		    	</div>
    </div>
  </div><!-- /.container-fluid -->
</nav>
</body>
</html>

