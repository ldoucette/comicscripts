<?php
/*
 *	Author: Lolita Douccette
 *	Version: 2016.09.23
 *
 */
class DirectoryLoader extends Loader {
	
	public function getCollection() {
		$iterator = new DirectoryIterator($this->path);
		$paths = null;
		foreach ($iterator as $fileinfo) {
			$sub = null;
			if ($fileinfo->isDir() && !$fileinfo->isDot()) {
				$paths[] = $this->path . "/" . $fileinfo->getFilename();
			}
		}

		return $paths;
	}
	
	public function getCurrentPath() {
		$this->path = getcwd();
	}
	
	private function generatePaths($count) {
		$count--;
		$paths=null;
		if ($count==1)
			return $paths;
		else {
		}
	}

	public function isDirectory() {
		$pathCollection = null;
		foreach ($dir as $file) {
			if ($file->isDir() && !$file->isDot()) {
				$pathCollection[] = $file->getFilename();
			}
		}
		
	}
}
?>