<?php
use \Chyr\ImgManager;

class ImgManagerTest extends PHPUnit_Framework_TestCase 
{
    public $obj;

    public $dir;
    public $dirOut;


    protected function setUp()
    {
        $this->dir = 'test/in/';
        $this->dirOut = 'test/out/';

        $this->obj = new ImgManager($this->dir.'1.jpg');

        $this->prepareOutDirectory();
    }

    private function prepareOutDirectory()
    {
        $this->clearDir($this->dirOut);
        mkdir($this->dirOut);
    }

    private function clearDir($path)
    {
        if (is_dir($path)) {

            $amountOfFiles = iterator_count(new FilesystemIterator($path, FilesystemIterator::SKIP_DOTS));

            if ($amountOfFiles > 0) {
                array_map('unlink', glob("$path/*.*"));
            }

            rmdir($path);
        }
    }



    protected static function getMethod($name) 
    {
        $class = new ReflectionClass('MyClass');
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method;
    }


    public function testWidthAndHeightOfJPG() 
    {
        $this->assertEquals($this->obj->getWidth(), 1500);
        $this->assertEquals($this->obj->getHeight(), 844);
    }

    public function testWidthAndHeightOfPNG() 
    {
        $obj = new ImgManager($this->dir.'2.png');
        $this->assertEquals($obj->getWidth(), 814);
        $this->assertEquals($obj->getHeight(), 392);
    }

    public function testWidthAndHeightOfGIF() 
    {
        $obj = new ImgManager($this->dir.'3.gif');
        $this->assertEquals($obj->getWidth(), 600);
        $this->assertEquals($obj->getHeight(), 1067);
    }
}

