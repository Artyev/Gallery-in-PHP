<?php

namespace Gallery\Model;

use DomainException;
use Laminas\Filter\StringTrim;
use Laminas\Filter\StripTags;
use Laminas\Filter\ToInt;
use Laminas\InputFilter\InputFilter;
use Laminas\InputFilter\InputFilterInterface;
use Laminas\Validator\StringLength;

class Gallery
{
    public $id;
    public $name;
    public $type;
    public $size;
    public $width;
    public $height;
    public $uploadtime;

    private $inputFilter;

    public function exchangeArray(array $data): void
    {
        $this->id        = $data['id'] ?? null;
        $this->name      = $data['name'] ?? null;
        $this->type      = $data['type'] ?? null;
        $this->size      = $data['size'] ?? null;
        $this->width     = $data['width'] ?? null;
        $this->height    = $data['height'] ?? null;
        $this->uploadtime = $data['uploadtime'] ?? null;
    }

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new DomainException(sprintf(
            '%s does not allow injection of an alternate input filter',
            __CLASS__
        ));
    }

    public function getInputFilter()
    {
        if ($this->inputFilter) {
            return $this->inputFilter;
        }

        $inputFilter = new InputFilter();

        $inputFilter->add([
            'name' => 'id',
            'required' => true,
            'filters' => [
                ['name' => ToInt::class],
            ],
        ]);

        $inputFilter->add([
            'name' => 'name',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name' => 'type',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name' => 'size',
            'required' => true,
            'filters' => [
                ['name' => ToInt::class],
            ],
            'validators' => [
                [
                    'name' => \Laminas\Validator\NumberComparison::class,
                    'options' => [
                        'min' => 1,
                        'max' => 100000000,
                        'inclusiveMin' => true,
                        'inclusiveMax' => true,
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name' => 'width',
            'required' => true,
            'filters' => [
                ['name' => ToInt::class],
            ],
            'validators' => [
                [
                    'name' => \Laminas\Validator\NumberComparison::class,
                    'options' => [
                        'min' => 1,
                        'max' => 100000,
                        'inclusiveMin' => true,
                        'inclusiveMax' => true,
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name' => 'height',
            'required' => true,
            'filters' => [
                ['name' => ToInt::class],
            ],
            'validators' => [
                [
                    'name' => \Laminas\Validator\NumberComparison::class,
                    'options' => [
                        'min' => 1,
                        'max' => 100000,
                        'inclusiveMin' => true,
                        'inclusiveMax' => true,
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name' => 'uploadtime',
            'required' => false,
        ]);

        $this->inputFilter = $inputFilter;
        return $this->inputFilter;
    }
}
