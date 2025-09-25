<?php

namespace MyInvoice\Ubl\Builder;

use MyInvoice\Ubl\Constant\UblSpecifications;
use MyInvoice\Helper\MyInvoiceHelper;
use MyInvoice\Ubl\Extension\Signature;

/**
 * JSON document builder
 **/
class JsonDocumentBuilder extends AbstractDocumentBuilder
{
    /**
     * {@inheritdoc}
     */
    public function build()
    {
        $document = $this->getDocument();

        $content = json_encode([
            '_D' => 'urn:oasis:names:specification:ubl:schema:xsd:' . $document->xmlTagName . '-2',
            '_A' => UblSpecifications::CAC,
            '_B' => UblSpecifications::CBC,
            // When MyInvoice validate signature it, it will exclude entire ext:UBLExtensions and cac:Signature portion 
            // without remove ext namespace, so we need to add this before signature calculation
            '_E' => UblSpecifications::EXT,
            $document->xmlTagName => [
                $document
            ],
        ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        // $content = json_encode(json_decode($content), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        $content = str_replace(array("\r", "\n"), '', $content);
        if (!mb_check_encoding($content, 'UTF-8')) {
            $content = mb_convert_encoding($content, 'UTF-8', 'auto');
        }

        // XML and JSON has different value for this
        if($this->isSigned) {
            $content = str_replace('"Type": "http://www.w3.org/2000/09/xmldsig#SignatureProperties"', '"Type": "http://uri.etsi.org/01903/v1.3.2#SignedProperties"', $content);
        }

        return $content;
    }

    /**
     * Get Props Digiest Hash
     * 
     * @param Signature $signature Signature object
     * @return string
     */
    protected function getPropsDigestHash(Signature $signature)
    {   
        $content = json_encode(
            $signature->getObject()->getQualifyingProperties(), 
            JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        if (!mb_check_encoding($content, 'UTF-8')) {
            $content = mb_convert_encoding($content, 'UTF-8', 'auto');
        }

    return MyInvoiceHelper::getHash($content, true);
    }
}
