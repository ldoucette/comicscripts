<?php
/*
 *	Author: Lolita Douccette
 *	Version: 2016.09.23
 *
 */
class ImageLoader extends Loader {
	
	private $imageType;
	
	public function getCollection() {
	
		$fileCollection=null;
		$files = scandir($this->path);
		foreach ($files as $file)  {
			if ($this->isImage($file))
				$fileCollection[]= $this->path . "/" . $file;
		}
		return $fileCollection;
	}
    
    private function isImage($file) {
    	if(@is_array(getimagesize($this->path . "/" . $file))){
    		return true;
    	} else {
    		return false;
    	}
    }
		
}
?>