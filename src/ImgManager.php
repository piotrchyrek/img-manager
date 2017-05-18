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
