<?php
/*
 *	Author: Lolita Douccette
 *	Version: 2016.09.23
 *
 */
class ComicLoader {
	
	private static $comic;
	
	public static function loadComic(Comic $comic, $paths, $iLoader) {
		self::$comic = $comic;
		$content = self::getComic($paths, $iLoader);
		self::$comic->setContent($content);
   		self::$comic->setChapters($paths);
	}
	
	private static function getComic($paths, $iLoader) {
		$files=null;
   		foreach($paths as $path) {
   			$iLoader->setPath($path);
   			$offset = self::$comic->getChapter($path);
   			$files[$offset] = $iLoader->getCollection();
   		}
   		return $files;
	}	
		
}
?>