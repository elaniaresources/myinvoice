<?php

namespace MyInvoice\Ubl;

use MyInvoice\Ubl\Constant\InvoiceTypeCodes;

/**
 * self billed invoice
 **/
class SelfBilledInvoice extends Invoice
{
    public $xmlTagName = 'Invoice'; //'SelfBilledInvoice'; // MyInvoice System re-use back same tag name
    protected $invoiceTypeCode = InvoiceTypeCodes::SELF_BILLED_INVOICE;
}
