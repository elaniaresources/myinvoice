<?php

namespace MyInvoice\Ubl\Constant;

/**
 * UBL specifications
 **/
class UblSpecifications
{
    const SIGNATURE_ID = 'urn:oasis:names:specification:ubl:signature:Invoice';
    const SIGNATURE_METHOD = 'urn:oasis:names:specification:ubl:dsig:enveloped:xades';

    const CBC = 'urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2';
    const CAC = 'urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2';
    const EXT = 'urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2';
    const SIG = 'urn:oasis:names:specification:ubl:schema:xsd:CommonSignatureComponents-2';
    const SAC = 'urn:oasis:names:specification:ubl:schema:xsd:SignatureAggregateComponents-2';
    const SBC = 'urn:oasis:names:specification:ubl:schema:xsd:SignatureBasicComponents-2';
}
