<?php

namespace MyInvoice\Ubl;

use MyInvoice\Ubl\Constant\InvoiceTypeCodes;

/**
 * self billed debit note
 **/
class SelfBilledDebitNote extends DebitNote
{
    public $xmlTagName = 'Invoice'; //'SelfBilledDebitNote'; // MyInvoice System re-use back same tag name
    protected $invoiceTypeCode = InvoiceTypeCodes::SELF_BILLED_DEBIT_NOTE;
}
