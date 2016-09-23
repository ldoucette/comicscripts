<?php
/*
 *	Author: Lolita Douccette
 *	Version: 2016.09.23
 *
 */
class Comic {
	
	private $title;
	private $volume;
	private $chapters;
	private $content;
	
	public function __construct($title, $volume) {
		$this->title = $title;
		$this->volume = $volume;
	}
	
	public function getTitle() {
		return $this->title;
	}
	
	public function getVolume() {
		return $this->volume;
	}
	
	public function setContent($content) {
		$this->content = $content;
	}
	
	public function getContent() {
		return $this->content;
	}
	
	public function setChapters($paths) {
		$chapters=null;
		foreach($paths as $path) {
			$chapters[]=$this->getChapter($path);
		}
		$this->chapters = $chapters;
	}
	
	public function getChapter($path) {
		list($p, $chapter) = explode("/", $path);
		return $chapter;
	}
	
	public function getChapters() {
		return $this->chapters;
	}
	
	public function getPages($chapter) {
		return $this->content[$chapter];
	}
	
}

?>
