<?php

namespace MyInvoice\Helper;

/**
 * Helper class
 **/
class MyInvoiceHelper
{
    /**
     * Static function helper
     * 
     * @param string $name Function name
     * @param array $arguments Function parameters
     * 
     * @return mixed
     */
    public static function __callStatic($name, $arguments) {
        switch ($name) {
            case 'getSubmitDocument':
                return self::getInternalSubmitDocument($arguments);
            default:
                break;
        }
    }

    /**
     * Static function helper
     * 
     * @param string $content Content
     * @param bool $binary Indicate whether result should be in binary
     * 
     * @return string
     */
    public static function getHash($content, $binary = false)
    {
        return hash('sha256', $content, $binary);
    }
    
    /**
     * Get SubmitDocument array required by MyInvoice API gateway
     *
     * @param array $arguments
     * 
     * @return array
     */
    private static function getInternalSubmitDocument($arguments)
    {
        // Only $codeNumber and $content
        if (sizeof($arguments) == 2) {
            $codeNumber = $arguments[0];
            $content = $arguments[1];
            $format = (self::isJson($content)) ? 'json' : 'xml';
        } else {
            $format = $arguments[0];
            $codeNumber = $arguments[1];
            $content = $arguments[2];
        }

        $document = base64_encode($content);
        $documentHash = self::getHash($content);

        return [
            'format' => $format,
            'document' => $document,
            'codeNumber' => $codeNumber,
            'documentHash' => $documentHash,
        ];
    }

    /**
     * Check whether content is json format
     * 
     * @param string $string Content
     * 
     * @return bool
     */
    public static function isJson($string) {
        json_decode($string);
        return json_last_error() === JSON_ERROR_NONE;
    }
}
