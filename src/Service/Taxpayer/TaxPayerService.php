<?php

namespace MyInvoice\Service\Taxpayer;

use Exception;
use MyInvoice\MyInvoiceClient;
use MyInvoice\Service\AbstractService;

/**
 * Tax payer service
 **/
class TaxPayerService extends AbstractService
{
    // ...existing code...

    /**
     * TaxPayerService constructor.
     *
    * @param MyInvoiceClient    $client
     * @param bool              $prodMode
     */
    public function __construct(MyInvoiceClient $client, $prodMode = false)
    {
    $baseUrl = \MyInvoice\Config\ApiUrls::getBaseUrl('taxpayer', $prodMode);

        parent::__construct($client, $baseUrl);
    }

    /**
     * This API allows taxpayer's ERP system to validate specific Tax Identification Number (TIN) before 
     * adding this number to an invoice and issuing the invoice.
     *
     * @param string $tin       The Tax Identification Number to get the validity of the tin.
     * @param string $idType    NRIC, Passport number, Business registration number, army number
     * @param string $idValue   The actual value of the ID Type selected. For example, if NRIC selected as ID Type, then pass the NRIC value here.
     * 
     * @return bool
     */
    public function validateTaxPayerTin($tin, $idType, $idValue)
    {
        $params = [
            'idType' => $idType,
            'idValue' => $idValue,
        ];
        $query = '?' . http_build_query($params);

        $url = $this->getBaseUrl() . '/validate/' . $tin . $query;

        $response = $this->getClient()->request('GET', $url);
        // When it is valid, the gateway return empty with statusCode 200
        if($response == null) {
            return '';
        }
        return $response;
    }

    /**
     * This API allows taxpayer's ERP system to search for a specific Tax Identification Number (TIN) 
     * using the supported search parameters. The available search parameters are either 
     * the Taxpayer Name or ID Type and ID Value, or all three parameters combined. 
     * If all parameters are provided then the search would use an AND operator to make sure the result 
     * found matches all search parameters provided.
     *
     * @param string $taxPayerName      The Taxpayer Name.
     * @param string $idType            NRIC, Passport number, Business registration number, army number
     * @param string $idValue           The actual value of the ID Type selected. For example, if NRIC selected as ID Type, then pass the NRIC value here.
     * 
     * @return string
     */
    public function searchTaxPayerTin($taxPayerName = '', $idType = '', $idValue = '')
    {
        $params = [
            'idType' => $idType,
            'idValue' => $idValue,
            'taxpayerName' => $taxPayerName,
        ];
        $query = '?' . http_build_query($params);

        $url = $this->getBaseUrl() . '/search/tin' .  $query;

        $response = $this->getClient()->request('GET', $url);
        return $response;
    }
}
