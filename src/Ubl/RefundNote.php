<?php

namespace MyInvoice\Ubl;

use MyInvoice\Ubl\Constant\InvoiceTypeCodes;

/**
 * Refund note
 **/
class RefundNote extends Invoice
{
    public $xmlTagName = 'Invoice'; //'RefundNote'; // MyInvoice System re-use back same tag name
    protected $invoiceTypeCode = InvoiceTypeCodes::REFUND_NOTE;
}
