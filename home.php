<?php
	session_start();
	
	require_once('dbconnect.php');
	$con = dbconnect();
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
	<!-- CDN'S-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css"/>
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	<!--Fonts-->
	<link href='http://fonts.googleapis.com/css?family=Droid+Sans|Lobster' rel='stylesheet' type='text/css'>
	<title>Project</title>
</head>
<body>
	<div class="container-fluid">
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
      <a class="navbar-brand" href="#">Project</a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="home.php">Home<span class="sr-only">(current)</span></a></li>
       	<li><a href="#">Logged in as <?php echo $user ?></a></li>
	<li><a href="logout.php?logout"> Logout</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  <!-- /.container-fluid -->
</nav>	
	<div class="jumbotron">
		<h1>Upload Files</h1>
		<p>	
			<button class="btn btn-primary btn-lg"> <a href="file.php" style="color:white;"> Upload A File </a></button> 
			<button class="btn btn-danger btn-lg"> <a href="image.php" style="color:white;">Upload A Image </a></button>
	       </p>
	</div>
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h2>My Files and Images</h2>
		</div>
		<div class="panel-body">
			
			<?php
				if($query = mysqli_query($con, "SELECT * FROM file where uid ='$uid'"))
					{echo "<h3>Text Files </h3><table>";
				//$r = mysqli_num_rows($query);
				while($result = mysqli_fetch_assoc($query))
				{	echo "<tr>";
					echo "<td>".$result['name']."<td/>"; ?> 
					<td><button class="btn btn-danger"><a href="delete.php?fid=<?php echo $result['fid']; ?>">Delete </a></button><td/>
					<td><button class="btn btn-success"><a href="view.php?fid=<?php echo $result['fid']; ?>">View</a></button><td/>
					<td><button class="btn btn-default"><a href="file_download.php?fid=<?php echo $result['fid']; ?>">Download </a></button><td/><tr/><table/>
					 <?php
				}
}
				if($query = mysqli_query($con, "SELECT * FROM Ifiles where uid ='$uid'"))
				{
				echo "<h3>Image Files </h3><table>";	
				while($result = mysqli_fetch_assoc($query))
				{	echo "<tr>";
					echo "<td>".$result['name']."<td/>"; ?> 
					<td><button class="btn btn-danger"><a href="delete-i.php?fid=<?php echo $result['fid']; ?>">Delete </a></button><td/>
					<td><button class="btn btn-success"><a href="view_image.php?fid=<?php echo $result['fid']; ?>">View</a></button><td/>
					<td><button class="btn btn-default"><a href="image_download.php?fid=<?php echo $result['fid']; ?>">Download </a></button><br><td/><tr/><table/>
					 <?php
				}
}
			?>
		</div>
	</div>	
	</div>
	<!--Google JQuery-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</body>
</html>
