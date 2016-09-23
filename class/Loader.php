<?php
/*
 *	Author: Lolita Douccette
*	Version: 2016.09.23
*
*/
abstract class Loader {
		
	private $root;
	protected $path;
	
	public function __construct($root) {
		if (file_exists($root)) {
			$this->root = $root;
			$this->setPath($root);
		} 
	}
			
	abstract protected function getCollection();
			
	public function setPath($path) {
		$this->path = $path;
	}
		
}

?>