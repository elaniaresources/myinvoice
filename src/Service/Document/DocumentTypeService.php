<?php

namespace MyInvoice\Service\Document;

use Exception;
use MyInvoice\MyInvoiceClient;
use MyInvoice\Service\AbstractService;

/**
 * Document type service
 **/
class DocumentTypeService extends AbstractService
{
    // ...existing code...

    /**
     * DocumentTypeService constructor.
     *
    * @param MyInvoiceClient    $client
     * @param bool              $prodMode
     */
    public function __construct(MyInvoiceClient $client, $prodMode = false)
    {
    $baseUrl = \MyInvoice\Config\ApiUrls::getBaseUrl('documenttypes', $prodMode);

        parent::__construct($client, $baseUrl);
    }

    /**
     * This API allows taxpayer's systems to retrieve list of document types published by the MyInvoice System.
     * 
     * @return array
     */
    public function getAllDocumentTypes()
    {
        $response = $this->getClient()->request('GET', $this->getBaseUrl());
        return $response;
    }

    /**
     * This API allows taxpayer's ERP system to retrieve the details of single document type that contains structure definitions of the document.
     * 
     * @param string $id    Unique ID of existing document type
     * 
     * @return array
     */
    public function getDocumentType($id)
    {
        $url = $this->getBaseUrl() . '/' . $id;
        
        $response = $this->getClient()->request('GET', $url);
        return $response;
    }

    /**
     * This API allows taxpayer's ERP system to retrieve the details of document type version that contains structure definitions of the documents.
     * 
     * @param string $id            Unique ID of existing document type
     * @param string $versionId     Unique ID of existing document type version that is published or deactivated
     * 
     * @return array
     */
    public function getDocumentTypeVersion($id, $versionId)
    {
        $url = $this->getBaseUrl() . '/' . $id . '/versions/' . $versionId;

        $response = $this->getClient()->request('GET', $url);
        return $response;
    }
}
