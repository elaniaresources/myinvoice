<?php

namespace MyInvoice\Service\Document;

use Exception;
use MyInvoice\MyInvoiceClient;
use MyInvoice\Service\AbstractService;

/**
 * Document submission service
 **/
class DocumentSubmissionService extends AbstractService
{
    // ...existing code...

    /**
     * DocumentSubmissionService constructor.
     *
    * @param MyInvoiceClient    $client
     * @param bool              $prodMode
     */
    public function __construct(MyInvoiceClient $client, $prodMode = false)
    {
    $baseUrl = \MyInvoice\Config\ApiUrls::getBaseUrl('documentsubmissions', $prodMode);

        parent::__construct($client, $baseUrl);
    }

    /**
     * This API returns information on documents submitted during a single submission by taxpayer.
     * 
     * @param string    $id         Mandatory: Unique ID of the document submission to retrieve.
     * @param int       $pageNo     Optional: number of the page to retrieve
     * @param int       $pageSize   Optional: number of the documents to retrieve per page. Page size cannot exceed system configured maximum page size for this API [100]
     * 
     * @return array
     */
    public function getSubmission($id, $pageNo = 1, $pageSize = 100)
    {
        $params = [
            'pageNo' => $pageNo,
            'pageSize' => $pageSize,
        ];
        $query = '?' . http_build_query($params);

        $url = $this->getBaseUrl() . '/' . $id . $query;

        $response = $this->getClient()->request('GET', $url);
        return $response;
    }

    /**
     * This API allows taxpayer to submit one or more signed documents to MyInvoice System.
     * 
     * @param array $documents  List of document objects submitted. List should have at least one document. The document should follow the UBL 2.1 schema based on the document type version.
     * 
     * @return array
     */
    public function submitDocument(array $documents = [])
    {
        $url = $this->getBaseUrl();
        $body = [
            'json' => [
                'documents' => $documents,
            ],
        ];

        $response = $this->getClient()->request('POST', $url, $body);
        return $response;
    }
}
