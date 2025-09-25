<?php

namespace MyInvoice\Ubl;

use MyInvoice\Ubl\Constant\InvoiceTypeCodes;

/**
 * self billed credit note
 **/
class SelfBilledCreditNote extends CreditNote
{
    public $xmlTagName = 'Invoice'; //'SelfBilledCreditNote'; // MyInvoice System re-use back same tag name
    protected $invoiceTypeCode = InvoiceTypeCodes::SELF_BILLED_CREDIT_NOTE;
}
