<?php

use \Chyr\Image\ImgManager;

class ImgManagerTest extends PHPUnit_Framework_TestCase 
{
	public $obj; 
	public $dir;

	protected function setUp()
    {
    	$this->dir = 'test/in/1.jpg';
		$this->obj = new ImgManager($this->dir);
    }


	public function testConstructor()
	{
		$this->assertEquals($this->obj->dir, $this->dir);
	}


	public function testImageData()
	{		
		$this->assertEquals($this->obj->width, 4160);
		$this->assertEquals($this->obj->height, 2340);
	}
}

