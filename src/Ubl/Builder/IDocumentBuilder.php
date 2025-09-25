<?php

namespace MyInvoice\Ubl\Builder;

use DateTime;
use MyInvoice\Ubl\Invoice;

/**
 * document builder interface
 **/
interface IDocumentBuilder
{
    /**
     * @param Invoice $invoice Invoice is base model of all documents
     * @return IDocumentBuilder
     */
    public function setDocument(Invoice $invoice);

    /**
     * @param array $issuerKeys LHDN has different issuer's sequence for different CA cert, so this function allow user to customize the sequence
     * @return IDocumentBuilder
     */
    public function setIssuerKeys($issuerKeys);

    /**
     * Create signature and apply into Invoice object
     * 
     * @param string $certFilePath Certificate file path
     * @param string $certPrivateKeyFilePath Private key file path
     * @param string $passphrase Password to decrypt Certificate
     * @return IDocumentBuilder
     */
    public function createSignature($certFilePath, $certPrivateKeyFilePath, $passphrase = null);

    /**
     * Build Invoice object into string
     * 
     * @return string
     */
    public function build();
}
