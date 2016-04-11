<?php

/**
 * @author MrGreen
 * @copyright 2013
 */
include "db.php";

// retrieving
$result = mssql_query("select Foto from employees where id=12");
$row = mssql_fetch_assoc($result);
header("Content-type: image/png;");
echo $row['Foto'];


/**
 *   function imageresize($outfile,$infile,$neww,$newh,$quality) {

 *       $im=imagecreatefromjpeg($infile);
 *       $im1=imagecreatetruecolor($neww,$newh);
 *       imagecopyresampled($im1,$im,0,0,0,0,$neww,$newh,imagesx($im),imagesy($im));

 *       imagejpeg($im1,$outfile,$quality);
 *       imagedestroy($im);
 *       imagedestroy($im1);
 *       }

 *   imageresize("",$row['binary_file'],400,400,100);
 *  
 */
?>