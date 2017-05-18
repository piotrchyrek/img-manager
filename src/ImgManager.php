<?php
namespace Chyr;

class ImgManager 
{
	public $path;

	public $width;
	public $height;
	public $format;


	function __construct($path) 
	{
		$this->path = $path;
		
		$this->getImageInfo();
	}

	public function getImageInfo()
	{
		list ($this->width, $this->height, $this->format) = getimagesize($this->path);
	}

}
