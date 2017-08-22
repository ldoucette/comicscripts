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
define("FOLDER", "panels" );
define ("COMIC_TITLE", "Alzyon");
define ("VOLUME_TITLE", "The Beginning");

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

   	$chapterNo = (isset($_POST['chapterNo']))?$_POST['chapterNo']:0;

  	$chapter=$chapters[$chapterNo];
    	$pages = $comic->getPages($chapter);

  	echo json_encode(array("chapterNo"=>$chapterNo, "chapter"=>$chapter, "chapters"=>$chapters, "pages"=>$pages));
 ?>
