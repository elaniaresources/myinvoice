<?php

namespace MyInvoice\Ubl;

use MyInvoice\Ubl\Constant\UblSpecifications;

/**
 * XML schema
 **/
class XmlSchema
{
    const CBC = '{' . UblSpecifications::CBC . '}';
    const CAC = '{' . UblSpecifications::CAC . '}';
    const EXT = '{' . UblSpecifications::EXT . '}';

    const SIG = '{' . UblSpecifications::SIG . '}';
    const SAC = '{' . UblSpecifications::SAC . '}';
    const SBC = '{' . UblSpecifications::SBC . '}';

    const DS = '{http://www.w3.org/2000/09/xmldsig#}';
    const XADES = '{http://uri.etsi.org/01903/v1.3.2#}';
}
