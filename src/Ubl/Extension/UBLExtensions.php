<?php

namespace MyInvoice\Ubl\Extension;

use InvalidArgumentException;
use Sabre\Xml\Writer;
use MyInvoice\Ubl\ISerializable;
use MyInvoice\Ubl\IValidator;
use MyInvoice\Ubl\XmlSchema;

/**
 * UBL extensions
 **/
class UBLExtensions implements ISerializable, IValidator
{
    private $ublExtensionItems = [];

    /**
     * @return UBLExtensionItem[]
     */
    public function getUBLExtensionItems()
    {
        return $this->ublExtensionItems;
    }

    /**
     * @param UBLExtensionItem $ublExtensionItem
     * @return UBLExtensions
     */
    public function setUBLExtensionItem(UBLExtensionItem $ublExtensionItem)
    {
        $this->ublExtensionItems = [$ublExtensionItem];
        return $this;
    }

    /**
     * @param UBLExtensionItem[] $ublExtensionItems
     * @return UBLExtensions
     */
    public function setUBLExtensionItems($ublExtensionItems)
    {
        $this->ublExtensionItems = $ublExtensionItems;
        return $this;
    }

    /**
     * @param UBLExtensionItem $ublExtensionItem
     * @return UBLExtensions
     */
    public function addUBLExtensionItem(UBLExtensionItem $ublExtensionItem)
    {
        $this->ublExtensionItems[] = $ublExtensionItem;
        return $this;
    }

    /**
     * validate function
     *
     * @throws InvalidArgumentException An error with information about required data that is missing
     */
    public function validate()
    {
        if(empty($this->ublExtensionItems)) {
            throw new InvalidArgumentException('Missing UBLExtensions ublExtensionItems');
        }
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

        if (!empty($this->ublExtensionItems)) {
            foreach ($this->ublExtensionItems as $ublExtensionItem) {
                $writer->write([
                    'name' => XmlSchema::EXT . 'UBLExtension',
                    'value' => $ublExtensionItem,
                ]);
            }
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

        if (!empty($this->ublExtensionItems)) {
            foreach ($this->ublExtensionItems as $ublExtensionItem) {
                $arrays['UBLExtension'][] = $ublExtensionItem;
            }
        }

        return $arrays;
    }
}
