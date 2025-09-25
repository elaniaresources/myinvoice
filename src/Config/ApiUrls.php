<?php
namespace MyInvoice\Config;

class ApiUrls
{
    public const SANDBOX_API_BASE_URLS = [
        'documentsubmissions' => 'https://preprod-api.myinvois.hasil.gov.my/api/v1.0/documentsubmissions',
        'documenttypes' => 'https://preprod-api.myinvois.hasil.gov.my/api/v1.0/documenttypes',
        'documents' => 'https://preprod-api.myinvois.hasil.gov.my/api/v1.0/documents',
        'taxpayer' => 'https://preprod-api.myinvois.hasil.gov.my/api/v1.0/taxpayer',
        'taxpayers' => 'https://preprod-api.myinvois.hasil.gov.my/api/v1.0/taxpayers',
        'notifications' => 'https://preprod-api.myinvois.hasil.gov.my/api/v1.0/notifications',
    'identity' => 'https://preprod-api.myinvois.hasil.gov.my/connect/token',
    'portal' => 'https://preprod.myinvois.hasil.gov.my',
    ];
    public const PROD_API_BASE_URLS = [
        'documentsubmissions' => 'https://api.myinvois.hasil.gov.my/api/v1.0/documentsubmissions',
        'documenttypes' => 'https://api.myinvois.hasil.gov.my/api/v1.0/documenttypes',
        'documents' => 'https://api.myinvois.hasil.gov.my/api/v1.0/documents',
        'taxpayer' => 'https://api.myinvois.hasil.gov.my/api/v1.0/taxpayer',
        'taxpayers' => 'https://api.myinvois.hasil.gov.my/api/v1.0/taxpayers',
        'notifications' => 'https://api.myinvois.hasil.gov.my/api/v1.0/notifications',
    'identity' => 'https://api.myinvois.hasil.gov.my/connect/token',
    'portal' => 'https://myinvois.hasil.gov.my',
    ];

    public static function getBaseUrl(string $service, bool $prodMode = false): string
    {
        $urls = $prodMode ? self::PROD_API_BASE_URLS : self::SANDBOX_API_BASE_URLS;
        return $urls[$service] ?? '';
    }
}
