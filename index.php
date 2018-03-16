
<form action="" method="GET">
    <input type="text" name="s">
    <input type="submit" name="go" value="Search">
</form>



<?php 


    $dir="/mnt/hdd/cron";


if (isset($_GET['s']) && $_GET['s']!='') {

    $string =$_GET['s'];

    //////////////// search for a file////////////////////

    function find($dir, $pattern){
    // escape any character in a string that might be used to trick
    // a shell command into executing arbitrary commands
    $dir = escapeshellcmd($dir);
    // execute "find" and return string with found files
    $files = shell_exec("find $dir -name '*$pattern*.gsm' -print");
    // create array from the returned string (trim will strip the last newline)
    $files = explode("\n", trim($files));
    // return array
    return $files;


}

    /////////////////////////////////////////////////////////


    //////////////// echo files /////////////////////////////
  
   $found=find($dir,$string);

    foreach ($found as $key => $rec) {
        echo '<a href="?download='.$rec.'">'.end(explode("/", $rec)).'</a></br>';
    }


    /////////////////////////////////////////////////////////
}



//////////////////////// download file /////////////////
if (isset($_GET['download'])) {
    $from=$_GET['download'];
    $n=explode("/", $_GET['download']);
    $to='rec/'.end($n);
    copy($from,$to);
    $name=$_GET['download'];
    @header('Content-Type: application/force-download');
    @header("Content-Disposition: attachment; filename=\"" . basename($name) . "\";");
    ob_clean();
    flush();
    readfile($to); //showing the path to the server where the file is to be download
    @unlink($to);
    exit;
 
}
///////////////////////////////////////////////////////




?>


