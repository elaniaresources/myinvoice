<?php

namespace MyInvoice\Ubl\Extension;

use InvalidArgumentException;
use Sabre\Xml\Writer;
use MyInvoice\Ubl\ISerializable;
use MyInvoice\Ubl\IValidator;
use MyInvoice\Ubl\XmlSchema;
use MyInvoice\Ubl\Constant\UblAttributes;

/**
 * Signed info transform
 **/
class SignInfoTransform implements ISerializable, IValidator
{
    private $xpath;
    private $attributes = [
        UblAttributes::ALGORITHM => 'http://www.w3.org/TR/1999/REC-xpath-19991116',
    ];

    /**
     * @return string
     */
    public function getXPath()
    {
        return $this->xpath;
    }

    /**
     * @param string $xpath
     * @return SignInfoTransform
     */
    public function setXPath($xpath)
    {
        $this->xpath = $xpath;
        return $this;
    }

    /**
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @param array $attributes
     * @return SignInfoTransform
     */
    public function setAttributes($attributes)
    {
        $this->attributes = array_merge($this->attributes, $attributes);
        return $this;
    }

    /**
     * validate function
     *
     * @throws InvalidArgumentException An error with information about required data that is missing
     */
    public function validate()
    {
    }

    /**
     * The xmlSerialize method is called during xml writing.
     *
     * @param Writer $writer
     * @return void
     */
    public function xmlSerialize(Writer $writer): void
    {
        $this->validate();

        if (!empty($this->xpath)) {
            $writer->write([
                'name' => XmlSchema::DS . 'XPath',
                'value' => $this->xpath,
            ]);
        }
    }

    /**
     * The jsonSerialize method is called during json writing.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        $this->validate();

        $arrays = [];

        if (!empty($this->xpath)) {
            $arrays['XPath'][] = [
                '_' => $this->xpath,
            ];
        }

        return $arrays;
    }
}
