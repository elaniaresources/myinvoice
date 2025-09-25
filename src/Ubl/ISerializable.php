<?php

namespace MyInvoice\Ubl;

use JsonSerializable;
use Sabre\Xml\XmlSerializable;

/**
 * ISerializable interface
 **/
interface ISerializable extends XmlSerializable, JsonSerializable
{
}
