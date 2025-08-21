<?php

namespace Gallery\Form;

use Laminas\Form\Element\Hidden;
use Laminas\Form\Element\Number;
use Laminas\Form\Element\Submit;
use Laminas\Form\Element\Text;
use Laminas\Form\Form;

class GalleryForm extends Form
{
    public function __construct($name = null)
    {
        // We will ignore the name provided to the constructor
        parent::__construct('gallery');

        $this->add([
            'name' => 'id',
            'type' => Hidden::class,
        ]);
        $this->add([
            'name' => 'name',
            'type' => Text::class,
            'options' => [
                'label' => 'Name',
            ],
        ]);
        $this->add([
            'name' => 'type',
            'type' => Text::class,
            'options' => [
                'label' => 'Type',
            ],
        ]);
        $this->add([
            'name' => 'size',
            'type' => Number::class,
            'options' => [
                'label' => 'Size',
            ],
        ]);
        $this->add([
            'name' => 'width',
            'type' => Number::class,
            'options' => [
                'label' => 'Width',
            ],
        ]);
        $this->add([
            'name' => 'height',
            'type' => Number::class,
            'options' => [
                'label' => 'Height',
            ],
        ]);
        $this->add([
            'name' => 'uploadtime',
            'type' => Hidden::class,
        ]);
        $this->add([
            'name' => 'submit',
            'type' => Submit::class,
            'attributes' => [
                'value' => 'Go',
                'id'    => 'submitbutton',
            ],
        ]);
    }
}
