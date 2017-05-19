<?php
use \Chyr\ImgManager;

class ImgManagerTest extends PHPUnit_Framework_TestCase 
{
    public $jpg;
    public $gif;
    public $png;

    public $dir;
    public $dirOut;


    protected function setUp()
    {
        $this->dir = 'test/in/';
        $this->dirOut = 'test/out/';

        $this->jpg = new ImgManager($this->dir.'1.jpg');
        $this->png = new ImgManager($this->dir.'2.png');
        $this->gif = new ImgManager($this->dir.'3.gif');

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


    public function getPrivateProperty($propertyName) {
        $reflector = new ReflectionClass('\Chyr\ImgManager');
        $property = $reflector->getProperty( $propertyName );
        $property->setAccessible( true );
 
        return $property;
    }


    public function testWidthAndHeightOfJPG() 
    {
        $this->assertEquals($this->jpg->getWidth(), 1500);
        $this->assertEquals($this->jpg->getHeight(), 844);
    }

    public function testWidthAndHeightOfPNG() 
    {
        
        $this->assertEquals($this->png->getWidth(), 814);
        $this->assertEquals($this->png->getHeight(), 392);
    }

    public function testWidthAndHeightOfGIF() 
    {
        
        $this->assertEquals($this->gif->getWidth(), 600);
        $this->assertEquals($this->gif->getHeight(), 1067);
    }


    public function testFormats()
    {
        $property = $this->getPrivateProperty('format');

        $this->assertEquals($property->getValue($this->jpg), IMAGETYPE_JPEG);
        $this->assertEquals($property->getValue($this->gif), IMAGETYPE_GIF);
        $this->assertEquals($property->getValue($this->png), IMAGETYPE_PNG);
    }


    public function testIfImageIsSuccesfullyLoadedToMemory()
    {
        $property = $this->getPrivateProperty('image');

        $this->assertFalse(!$property->getValue($this->jpg));
        $this->assertFalse(!$property->getValue($this->gif));
        $this->assertFalse(!$property->getValue($this->png));
    }


    public function testIfImageWasSaved()
    {
        $newFile = $this->dirOut.'1.jpg';
        $this->jpg->save($newFile);
        $this->assertTrue(file_exists($newFile));

        $newFile = $this->dirOut.'2.png';
        $this->png->save($newFile);
        $this->assertTrue(file_exists($newFile));

        $newFile = $this->dirOut.'3.gif';
        $this->gif->save($newFile);
        $this->assertTrue(file_exists($newFile));
    }
}

