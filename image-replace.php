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
$temp_dir = "temp/";
$count =0;
if(!isset($_GET['tname']))
{
$oldmask = umask(0);
mkdir("temp", 0777);
umask($oldmask);
$temp_name=str_replace('(','_',basename($_FILES['file']['name']));
$name=str_replace(')','_',$temp_name);
$name=str_replace(' ','',$name);
$tname = $name;
$temp_file = $temp_dir . $name ;
//$name = $_FILES['file']['name'];
$result=0;
$info = getimagesize($_FILES['file']['tmp_name']);
if ($info === FALSE) {
   die("Unable to determine image type of uploaded file");
}
if (($info[2] !== IMAGETYPE_GIF) && ($info[2] !== IMAGETYPE_JPEG) && ($info[2] !== IMAGETYPE_PNG)) {
   die("Not a gif/jpeg/png");
}if(!move_uploaded_file($_FILES["file"]["tmp_name"], $temp_file)){ die("File could not be uploaded");}
else {exec("chmod 777 ".$temp_file);
$imagetype = pathinfo($temp_file,PATHINFO_EXTENSION);
}
}
else{
//$name = $_GET['fname']; 
$tname = $_GET['tname'];
$count = $_GET['count'];
$imagetype = $_GET['type'];
$temp_file = $temp_dir . $tname ;
$fname = explode(".".$imagetype,$tname);
$name = $fname[0] ."_".$count.".".$imagetype; 
}

exec("python test.py $temp_file",$output,$ret_code);
$hash =  $output[0]; 
$query= mysqli_query($con,"SELECT * from Ifiles WHERE name='$name' and uid='$uid'");
$row = mysqli_num_rows($query);?>
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
if($row != 0)
{
	if($count == 0)
	{
	echo "File Name already exists,do you want to replace?";
	?><td><button class="btn btn-danger"><a href="replace-i.php?fname=<?php echo $name; ?>">yes </a></button><td/>
	   <td><button class="btn btn-success"><a href="image-replace.php?tname=<?php echo $tname?>&count=<?php echo $count+1?>&type=<?php echo $imagetype ?>">no</a></button><td/><?php
}
else{
$count = $count +1;
header('location: image-replace.php?tname='.$tname.'&count='.$count.'&type='.$imagetype);
}
}
else
{
$query= mysqli_query($con,"SELECT * from Ifiles WHERE hash='$hash' and lid=0");
$query1 = mysqli_num_rows($query);
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
		
}
?>

    		    	</div>
    </div>
  </div><!-- /.container-fluid -->
</nav>
</body>
</html>
