
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



////////////////// delete cache /////////////////////////
if (!isset($_GET['download'])){
$recs = scandir('rec');
foreach ($recs as $key => $rec) {
	
	if($rec=='.' || $rec=='..'){

	} else {
			if(file_exists ('rec/'.$rec)){
				unlink('rec/'.$rec);	
			}
	}
}}
/////////////////////////////////////////////////////////


//////////////////////// download file /////////////////
if (isset($_GET['download'])) {
	$from='/var/spool/asterisk/monitorDONE/FTP/'.$_GET['download'];
	$to='rec/'.$_GET['download'];
	echo $from;
	copy($from,$to);
	header("Location: rec/".$_GET['download']);
	unlink("rec/".$GET['download']);
}
///////////////////////////////////////////////////////

?>


