<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
 "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Music Viewer</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link href="viewer.css" type="text/css" rel="stylesheet" />
	</head>
	<body>
		<div id="header">

			<h1>190M Music Playlist Viewer</h1>
			<h2>Search Through Your Playlists and Music</h2>
		</div>
		<?php
		function getSize($size){
            	if($size==FALSE) return "0b";
            	$sign = array("b", "B", "KB", "MB", "GB", "TB", "PB" );
            	$tmpSize=$size;
            	$counter=0;
            	while($tmpSize>1024){
            		$tmpSize=$tmpSize/1024;
            		$counter++;
            	}

            	if($counter<count($sign)){
            		return " ( ".round($tmpSize, 2).$sign[$counter+1]." )";
            	}else{
            		return " ( ".round($tmpSize, 2)."more than PB )";
            	}
            }
        ?>
       <?php
            
            if(isset($_REQUEST["playlist"])){
            	$filename=str_replace("%20","",$_REQUEST["playlist"]);
            	$myfile = file($filename);

				echo "<div id=\"listarea\"><ul id=\"musiclist\"> ";
	       		foreach (file($filename) as $filename)
	       		{
	       			echo "<li class=\"mp3item\"> <a href=\"songs/".basename($filename)."\">".basename($filename)."<k style=\"color:black;\">".getSize(filesize($filename))."</k></a></li>";
	       		}
				echo " </ul></div>";
			}else{
	       		echo "<div id=\"listarea\"><ul id=\"musiclist\"> ";
	       		foreach (glob("songs/*.mp3") as $filename)
	       		{
	       			echo "<li class=\"mp3item\"> <a href=\"songs/".basename($filename)."\">".basename($filename)."<k style=\"color:black;\">".getSize(filesize($filename))."</k></a></li>";
	       		}
	       		foreach (glob("songs/*.txt") as $filename)
	       		{
	       			echo "<li class=\"playlistitem\"> <a href=music.php?playlist=".$filename.">".basename($filename)."</a></li>";
	       		}
	       		echo "</ul></div>";
       	    }
        ?>
		</div>
	</body>
</html>
