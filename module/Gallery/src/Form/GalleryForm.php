<?php

namespace Gallery\Form;

use Laminas\Form\Form;
use Laminas\Form\Element;

class GalleryForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('gallery');

        $this->add([
            'name' => 'photo',
            'type' => \Laminas\Form\Element\File::class,
            'options' => ['label' => 'Choose a photo'],
            'attributes' => ['required' => true],
        ]);

        $this->add([
            'name' => 'submit',
            'type' => Element\Submit::class,
            'attributes' => [
                'value' => 'Upload',
                'id' => 'submitbutton',
            ],
        ]);
    }
}