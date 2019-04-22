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
$q = mysqli_query($con, "SELECT * from Ifiles WHERE  fid= '$fid' and uid='$uid'");
$q = mysqli_fetch_array($q);
$name= $q['name'];
$lid = $q['lid'];
if($lid == 0)
{
$file='images/'.$fid.$name;
}
else
{
$q = mysqli_query($con, "SELECT * from Ifiles WHERE  fid= '$lid'");
$q = mysqli_fetch_array($q);
$file= 'images/'.$q['fid'].$q['name'];
}
if (file_exists($file)) {
   
    header('Content-Description: File Transfer');
    header('Content-Type: application/force-download');
    header('Content-Disposition: attachment; filename="'.basename($name).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    ob_clean();
    flush();
    readfile($file);
    exit;
}


header('location: home.php');
?>
