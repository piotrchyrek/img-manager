<?php
namespace Chyr\Image;

class ImgManager 
{
	public $dir;

	public $width;
	public $height;
	public $format;


	function __construct($dir) {
		$this->dir = $dir;
		
		$this->getImageInfo();
	}

	public function getImageInfo()
	{
		list ($this->width, $this->height, $this->format) = getimagesize($this->dir);
	}

}
