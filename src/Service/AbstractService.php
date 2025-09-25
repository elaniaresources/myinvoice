<?php

namespace MyInvoice\Service;

use Exception;
use MyInvoice\MyInvoiceClient;

/**
 * Abstract class for service component
 **/
abstract class AbstractService
{
    /**
     * Base URL
     *
     * @var string
     */
    private $baseUrl = '';

    /**
    * MyInvoiceClient object
     * 
    * @var MyInvoiceClient
     */
    private $client;

    /**
     * AbstractService constructor.
     *
    * @param MyInvoiceClient    $client
     * @param string            $baseUrl
     */
    public function __construct(MyInvoiceClient $client, $baseUrl)
    {
        $this->client = $client;
        $this->baseUrl = $baseUrl;
    }

    /**
     * @return string
     */
    protected function getBaseUrl()
    {
        return $this->baseUrl;
    }

    /**
     * @return mixed
     */
    protected function getClient()
    {
        return $this->client;
    }
}
