<?php

namespace MyInvoice\Service\Notification;

use Exception;
use DateTime;
use MyInvoice\MyInvoiceClient;
use MyInvoice\Service\AbstractService;

/**
 * Notification service
 **/
class NotificationService extends AbstractService
{
    // ...existing code...

    /**
     * NotificationService constructor.
     *
     * @param MyInvoiceClient    $client
     * @param bool              $prodMode
     */
    public function __construct(MyInvoiceClient $client, $prodMode = false)
    {
    $baseUrl = \MyInvoice\Config\ApiUrls::getBaseUrl('notifications', $prodMode);

        parent::__construct($client, $baseUrl);
    }

    /**
     * This API allows ERP system to query for previously sent notifications.
     * 
     * @param DateTime|string   $dateFrom   Optional: start date and time for notifications to retrieve based on the date sent
     * @param DateTime|string   $dateTo     Optional: end date and time for notifications to retrieve based on the date sent
     * @param string            $type       Optional: type of notifications to retrieve specified as ID of the type
     * @param string            $language   Optional: used to get notifications only if they were sent out in a specific language
     * @param string            $status     Optional: used to get notifications of certain status only, e.g., only those that were not delivered. Values: pending, batched, delivered, error
     * @param int               $pageNo     Optional: number of the page to retrieve. Typically this parameter value is derived from initial parameter less call when caller learns total amount of page of certain size
     * @param int               $pageSize   Optional: number of the packages to retrieve per page. Page size cannot exceed system configured maximum page size for this API which is 100
     * 
     * @return array
     */
    public function getNotifications($dateFrom = null, $dateTo = null, $type = null, $language = null, $status = null,
        $pageNo = 1, $pageSize = 20)
    {
        $dateFromString = ($dateFrom instanceof DateTime) ? $dateFrom->format('Y-m-d\TH:i:s\Z') : $dateFrom;
        $dateToString = ($dateTo instanceof DateTime) ? $dateTo->format('Y-m-d\TH:i:s\Z') : $dateTo;

        $params = [
            'dateFrom' => $dateFromString,
            'dateTo' => $dateToString,
            'type' => $type,
            'language' => $language,
            'status' => $status,
            'pageNo' => $pageNo,
            'pageSize' => $pageSize,
        ];
        $query = '?' . http_build_query($params);

        $url = $this->getBaseUrl() . '/taxpayer' . $query;

        $response = $this->getClient()->request('GET', $url);
        return $response;
    }
}
