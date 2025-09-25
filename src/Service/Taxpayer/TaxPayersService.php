<?php

namespace MyInvoice\Service\Taxpayer;

use Exception;
use MyInvoice\MyInvoiceClient;
use MyInvoice\Service\AbstractService;

/**
 * Tax payers service
 **/
class TaxPayersService extends AbstractService
{
    // ...existing code...

    /**
     * TaxPayersService constructor.
     *
    * @param MyInvoiceClient    $client
     * @param bool              $prodMode
     */
    public function __construct(MyInvoiceClient $client, $prodMode = false)
    {
    $baseUrl = \MyInvoice\Config\ApiUrls::getBaseUrl('taxpayers', $prodMode);

        parent::__construct($client, $baseUrl);
    }

    /**
     * This API allows taxpayer’s ERP system to retrieve the information for a specific Taxpayer based on 
     * the Base64 formatted string obtained from scanning the respective QR code.
     *
     * @param string $qrCodeText       Decoded Base64 string.
     * 
     * @return array
     */
    public function getTaxPayerFromQrcode($qrCodeText)
    {
        $url = $this->getBaseUrl() . '/qrcodeinfo/' . $qrCodeText;

        $response = $this->getClient()->request('GET', $url);
        return $response;
    }
}
