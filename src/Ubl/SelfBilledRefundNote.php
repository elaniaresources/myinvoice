<?php

namespace MyInvoice\Ubl;

use MyInvoice\Ubl\Constant\InvoiceTypeCodes;

/**
 * self billed refund note
 **/
class SelfBilledRefundNote extends Invoice
{
    public $xmlTagName = 'Invoice'; //'SelfBilledRefundNote'; // MyInvoice System re-use back same tag name
    protected $invoiceTypeCode = InvoiceTypeCodes::SELF_BILLED_REFUND_NOTE;
}
