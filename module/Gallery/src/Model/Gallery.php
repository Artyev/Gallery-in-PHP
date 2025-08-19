<?php

namespace Gallery\Model;

class Gallery
{
    public $id;
    public $name;
    public $type;
    public $size;
    public $width;
    public $height;
    public $uploadtime;

    public function exchangeArray(array $array): void
    {
        $this->id     = ! empty($array['id']) ? $array['id'] : null;
        $this->name = ! empty($array['name']) ? $array['name'] : null;
        $this->type  = ! empty($array['type']) ? $array['type'] : null;
        $this->size  = ! empty($array['size']) ? $array['size'] : null;
        $this->width  = ! empty($array['width']) ? $array['width'] : null;
        $this->height  = ! empty($array['height']) ? $array['height'] : null;
        $this->uploadtime  = ! empty($array['uploadtime']) ? $array['uploadtime'] : null;
    }
}
