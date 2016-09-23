<?php 
/*
 *	Author: Lolita Douccette
*	Version: 2016.09.23
*
*/

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

// define the folder name of the comic images
define("FOLDER", "_______" );   
define ("COMIC_TITLE", "_______");
define ("VOLUME_TITLE", "_______");

	function __autoload($classname) {
   		$filename = 'class/' . $classname .".php";
   		include_once($filename);
   	}
   	
   	$dLoader = new DirectoryLoader(FOLDER);
   	$paths = $dLoader->getCollection();
   	
   	$iLoader = new ImageLoader(FOLDER);
   	
   	$comic = new Comic(COMIC_TITLE, VOLUME_TITLE);
   	ComicLoader::loadComic($comic, $paths, $iLoader);
   	$chapters = $comic->getChapters();
	$content = $comic->getContent();
   	$page = (isset($_POST['page']))?$_POST['page']:0;
   	$chapterNo = (isset($_POST['chapter']))?$_POST['chapter']:0;
   	
  	$chapter=$chapters[$chapterNo];
  	$pages = $comic->getPages($chapter);
  	$count = count($pages)-1;
  	$status="current";
  	if ($page<=0) $status="first";
  	if ($page>=$count) $status="last";
 	$current = $pages[$page];
  	
  	// all comic
  	echo json_encode(array("chapters"=>$chapters, "numPanels"=>$count, "panel"=>$current, "status"=>$status));
?>
 