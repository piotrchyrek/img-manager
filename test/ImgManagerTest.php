<?php

use \Chyr\ImgManager;

class ImgManagerTest extends PHPUnit_Framework_TestCase 
{
	public $obj; 
	public $path;

	protected function setUp()
	{
		$this->path = 'test/in/1.jpg';
		$this->obj = new ImgManager($this->path);
	}


	public function testConstructor()
	{
		$this->assertEquals($this->obj->path, $this->path);
	}


	public function testImageData()
	{		
		$this->assertEquals($this->obj->width, 4160);
		$this->assertEquals($this->obj->height, 2340);
	}
}

