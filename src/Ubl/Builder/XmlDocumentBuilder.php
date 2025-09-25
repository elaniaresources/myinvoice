<?php

namespace MyInvoice\Ubl\Builder;

use DOMDocument;
use Sabre\Xml\Service;
use MyInvoice\Ubl\Constant\UblSpecifications;
use MyInvoice\Helper\MyInvoiceHelper;
use MyInvoice\Ubl\Extension\Signature;

/**
 * XML document builder
 **/
class XmlDocumentBuilder extends AbstractDocumentBuilder
{
    /**
     * {@inheritdoc}
     */
    public function build()
    {
        $document = $this->getDocument();
        $xmlService = new Service();

        $xmlService->namespaceMap = [
            'urn:oasis:names:specification:ubl:schema:xsd:' . $document->xmlTagName . '-2' => '',
            UblSpecifications::CBC => 'cbc',
            UblSpecifications::CAC => 'cac',
            // When MyInvoice validate signature it, it will exclude entire ext:UBLExtensions and cac:Signature portion 
            // without remove ext namespace, so we need to add this before signature calculation
            UblSpecifications::EXT => 'ext',
        ];

        $content = $xmlService->write($document->xmlTagName, [
            $document
        ]);

        $content = str_replace("<?xml version=\"1.0\"?>\n", '', $content);

        $xml = new DOMDocument('1.0', 'UTF-8');
        $xml->preserveWhiteSpace = false;
        $xml->formatOutput = false;
        $xml->loadXML($content);

        $content = $xml->C14N();

        if (!mb_check_encoding($content, 'UTF-8')) {
            $content = mb_convert_encoding($content, 'UTF-8', 'auto');
        }
        $content = str_replace(array("\n", "\t", "\r"), '', $content);
        $content = $this->replaceCommonAttributes($content);
        
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
        $service = new Service();
        $service->namespaceMap = [
            'http://uri.etsi.org/01903/v1.3.2#' => 'xades',
            'http://www.w3.org/2000/09/xmldsig#' => 'ds',
        ];

        $content = $service->write('{http://uri.etsi.org/01903/v1.3.2#}root', $signature->getObject()->getQualifyingProperties());

        $xml = new DOMDocument('1.0', 'UTF-8');
        $xml->preserveWhiteSpace = false;
        $xml->formatOutput = false;
        $xml->loadXML($content);
        
        $content = $xml->C14N();

        if (!mb_check_encoding($content, 'UTF-8')) {
            $content = mb_convert_encoding($content, 'UTF-8', 'auto');
        }
        $content = str_replace(array("\n", "\t", "\r"), '', $content);
        $content = str_replace("<?xml version=\"1.0\"?>", '', $content);
        $content = str_replace("<xades:root xmlns:ds=\"http://www.w3.org/2000/09/xmldsig#\" xmlns:xades=\"http://uri.etsi.org/01903/v1.3.2#\">", '', $content);
        $content = str_replace("</xades:root>", '', $content);
        $content = $this->replaceCommonAttributes($content);

    return MyInvoiceHelper::getHash($content, true);
    }

    /**
     * Replace common XML attributes to meet LHDN requirement
     * 
     * @param string $content XML raw content
     * @return string
     */
    private function replaceCommonAttributes($content)
    {
        $content = str_replace("<xades:SignedProperties Id=\"id-xades-signed-props\">", "<xades:SignedProperties Id=\"id-xades-signed-props\" xmlns:xades=\"http://uri.etsi.org/01903/v1.3.2#\">", $content);
        $content = str_replace("<ds:DigestMethod Algorithm=\"http://www.w3.org/2001/04/xmlenc#sha256\"></ds:DigestMethod>","<ds:DigestMethod Algorithm=\"http://www.w3.org/2001/04/xmlenc#sha256\" xmlns:ds=\"http://www.w3.org/2000/09/xmldsig#\"></ds:DigestMethod>", $content);
        $content = str_replace("<ds:X509SerialNumber>","<ds:X509SerialNumber xmlns:ds=\"http://www.w3.org/2000/09/xmldsig#\">", $content);
        $content = str_replace("<ds:X509IssuerName>","<ds:X509IssuerName xmlns:ds=\"http://www.w3.org/2000/09/xmldsig#\">", $content);
        $content = str_replace("<ds:DigestValue>","<ds:DigestValue xmlns:ds=\"http://www.w3.org/2000/09/xmldsig#\">", $content);

        return $content;
    }
}
