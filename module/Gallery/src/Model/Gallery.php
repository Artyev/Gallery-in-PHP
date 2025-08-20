<?php

namespace Gallery\Model;

use DomainException;
use Laminas\Filter\StringTrim;
use Laminas\Filter\StripTags;
use Laminas\Filter\ToInt;
use Laminas\InputFilter\InputFilter;
use Laminas\InputFilter\InputFilterAwareInterface;
use Laminas\InputFilter\InputFilterInterface;
use Laminas\Validator\GreaterThan;
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

    public function exchangeArray(array $array): void
    {
        $this->id     = ! empty($array['ID']) ? $array['ID'] : null;
        $this->name = ! empty($array['Name']) ? $array['Name'] : null;
        $this->type  = ! empty($array['Type']) ? $array['Type'] : null;
        $this->size  = ! empty($array['Size']) ? $array['Size'] : null;
        $this->width  = ! empty($array['Width']) ? $array['Width'] : null;
        $this->height  = ! empty($array['Height']) ? $array['Height'] : null;
        $this->uploadtime  = ! empty($array['UploadTime']) ? $array['UploadTime'] : null;
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
