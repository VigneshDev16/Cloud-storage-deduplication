<?php
	session_start();
	if( !isset($_SESSION['user']) ) {
		header("Location: index.php");
		exit;
	}
	$user = $_SESSION['userName'];
	$uid = $_SESSION['user'];
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
			<h2>Upload a File</h2>
		</div>
			<div class="panel-body">
    		Please upload your File
			<form action="file-replace.php" enctype="multipart/form-data" method="post"> 
    		 <input type="file" class="input-group" name="file">
    		 <input type="submit" class="btn btn-lg btn-primary">
    		</form>
    	</div>
    </div>
  </div><!-- /.container-fluid -->
</nav>
</body>
</html>
