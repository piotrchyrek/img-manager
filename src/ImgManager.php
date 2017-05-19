<?php
namespace Chyr;

class ImgManager 
{
    private $width;
    private $height;

    private $format;
    private $image;


    public function __construct($path = false) 
    {
        if ($path !== false) {
            $this->openImage($path);
        }     
    }


    public function openImage($path)
    {
        if ($this->getImageInfo($path)) {
            $this->getImageToMemory($path);
        }
    }


    private function getImageInfo($path)
    {
        $imgInfo = getimagesize($path);

        if ($imgInfo !== false) {
            $this->width = $imgInfo[0];
            $this->height = $imgInfo[1];
            $this->format = $imgInfo[2];

            return true;
        }

        return false;
    }


    private function getImageToMemory($path)
    {
        switch ($this->format) 
        {
            case IMAGETYPE_JPEG:
                $this->image = imagecreatefromjpeg($path);
                break;

            case IMAGETYPE_GIF:
                $this->image = imagecreatefromgif($path);
                break;
            
            case IMAGETYPE_PNG:          
                $this->image = imagecreatefrompng($path);
                break;

            default:
                throw new InvalidArgumentException("Unsupported format");
        }
    }

    public function save($name, $compression = 100)
    {
        switch ($this->format) 
        {
            case IMAGETYPE_JPEG:
                $result = imagejpeg($this->image, $name, $compression);
                break;

            case IMAGETYPE_GIF:
                $result = imagegif($this->image, $name);
                break;
            
            case IMAGETYPE_PNG:          
                $result = imagepng($this->image, $name);
                break;

            default:
                throw new InvalidArgumentException("Unsupported format");
        }

        if (!$result) {
            throw new RuntimeException;
        }
    }


    public function getWidth()
    {
        return $this->width;
    }


    public function getHeight()
    {
        return $this->height;
    }

}
