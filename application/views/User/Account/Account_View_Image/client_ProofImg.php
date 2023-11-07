<?php 
// https://stackoverflow.com/questions/2633908/php-display-image-with-header

$img_path = $_SESSION['ses_path_img']; 
if(!file_exists($img_path))
{
	echo "file not found";
	die();
}
// Strat Check the File Extension is pdf and jpg
$filename = basename($img_path);
$file_extension = strtolower(substr(strrchr($filename,"."),1));

switch( $file_extension ) {
    case "gif": $ctype="image/gif"; break;
    case "png": $ctype="image/png"; break;
    case "jpeg":
    case "jpg": $ctype="image/jpeg"; break;
    case "svg": $ctype="image/svg+xml"; break;
    case 'pdf': $ctype="application/PDF"; break;
    	# code...
    	break;
    default:
}

// header('Content-type: ' . $ctype);
// End of the check extension
$path = $img_path;
// header('Content-type:image/png');
header('Content-type: '. $ctype);
readfile($path);
exit();
?>