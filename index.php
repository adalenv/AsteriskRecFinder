
<form action="" method="GET">
	<input type="text" name="s">
	<input type="submit" name="go" value="Search">
</form>



<?php 

if (isset($_GET['s']) && $_GET[s]!='') {

	$string =$_GET['s'];
	//////////////// search for a file////////////////////
	$files = scandir('/var/spool/asterisk/monitorDONE/FTP');
	$found = array();
	foreach ($files as $key => $file) {
		//echo $file;
	    if (strpos($file, $string) !== false) {
	        array_push($found,$file); 
	    }
	}
	/////////////////////////////////////////////////////////


	//////////////// echo files /////////////////////////////
	foreach ($found as $key => $rec) {
		echo '<a href="?download='.$rec.'">'.$rec.'</a></br>';
	}
	/////////////////////////////////////////////////////////
}



//////////////////////// download file /////////////////
if (isset($_GET['download'])) {
	$from='/var/spool/asterisk/monitorDONE/FTP/'.$_GET['download'];
	$to='rec/'.$_GET['download'];
	copy($from,$to);
	$name=$_GET['download'];
    @header('Content-Type: application/force-download');
    @header("Content-Disposition: attachment; filename=\"" . basename($name) . "\";");
    ob_clean();
    flush();
    readfile("rec/".$name); //showing the path to the server where the file is to be download
    @unlink('rec/'.$name);
    exit;

}
///////////////////////////////////////////////////////


?>


