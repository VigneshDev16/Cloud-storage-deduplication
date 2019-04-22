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
$q = mysqli_query($con, "SELECT * from file WHERE  fid= '$fid' and uid='$uid'");
$q = mysqli_fetch_array($q);
$name= $q['name'];
$lid = $q['lid'];
if($lid == 0)
{
$file='files/'.$fid.$name;
}
else
{
$q = mysqli_query($con, "SELECT * from file WHERE  fid= '$lid'");
$q = mysqli_fetch_array($q);
$file= 'files/'.$q['fid'].$q['name'];
}
if (file_exists($file)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/force-download');
    header('Content-Disposition: attachment; filename="'.basename($name).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    readfile($file);
    exit;
}


header('location: home.php');
?>
