<?php

namespace MyInvoice\Service\Identity;

use Exception;
use MyInvoice\MyInvoiceClient;
use MyInvoice\Service\AbstractService;

/**
 * Identity service
 **/
class IdentityService extends AbstractService
{
    // ...existing code...

    /**
     * IdentityService constructor.
     *
     * @param MyInvoiceClient    $client
     * @param bool              $prodMode
     */
    public function __construct(MyInvoiceClient $client, $prodMode = false)
    {
    $baseUrl = \MyInvoice\Config\ApiUrls::getBaseUrl('identity', $prodMode);

        parent::__construct($client, $baseUrl);
    }

    /**
     * Set token if you have it
     *
     * @param string $token
     *
     * @return array
     */
    public function setAccessToken($token)
    {
        $headers = $this->getClient()->getOption('headers');
        if(!$headers) {
            $headers = [];
        }
        $headers = array_merge($headers, [
            'Authorization' => 'Bearer ' . $token,
        ]);

        return $this->getClient()->setOption('headers', $headers);
    }

    /**
     * Extract auth token from client
     *
     * @return null|string
     */
    public function getAccessToken()
    {
        $authHeader = $this->getClient()->getOption('headers');

        if (!$authHeader) {
            return null;
        }

        if(!array_key_exists('Authorization', $authHeader)) {
            return null;
        }

        return substr($authHeader['Authorization'], 7);
    }

    /**
     * This should be the Tax Identification Number (TIN) of the taxpayer the intermediary is presenting
     *
     * @param string $onbehalfof
     *
     * @return array
     */
    public function setOnbehalfof($onbehalfof)
    {
        $headers = $this->getClient()->getOption('headers');
        if(!$headers) {
            $headers = [];
        }
        $headers = array_merge($headers, [
            'onbehalfof' => $onbehalfof,
        ]);

        return $this->getClient()->setOption('headers', $headers);
    }

    /**
     * This API is used to authenticate the ERP system associated with a specific taxpayer calling and issue access token which allows ERP system to access those protected APIs.
     * 
     * @param string|null   $onbehalfof     Optional: Used by intermediary system to set (TIN) of the taxpayer the intermediary is presenting
     * @param string        $grantType      Optional: OAuth grant type
     * @param string        $scope          Optional: OAuth scope
     * 
     * @return array
     */
    public function login($onbehalfof = null,  $grantType = 'client_credentials', $scope = 'InvoicingAPI')
    {
        if(!empty($onbehalfof)) {
            $this->setOnbehalfof($onbehalfof);
        }

        $body = [
            'form_params' => [
                'client_id' => $this->getClient()->getClientId(),
                'client_secret' => $this->getClient()->getClientSecret(),
                'grant_type' => $grantType,
                'scope' => $scope,
            ],
        ];

        $response = $this->getClient()->request('POST', $this->getBaseUrl(), $body);

        if (is_array($response) && !array_key_exists('access_token', $response)) {
            throw new Exception('access_token not found!');
        }

        $this->setAccessToken($response['access_token']);

        return $response;
    }
}
