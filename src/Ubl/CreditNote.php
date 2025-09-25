<?php

namespace MyInvoice\Ubl;

use MyInvoice\Ubl\Constant\InvoiceTypeCodes;

/**
 * Credit note
 **/
class CreditNote extends Invoice
{
    public $xmlTagName = 'Invoice'; //'CreditNote'; // MyInvoice System re-use back same tag name
    protected $invoiceTypeCode = InvoiceTypeCodes::CREDIT_NOTE;

    /**
     * @return CreditNoteLine[]
     */
    public function getCreditNoteLines()
    {
        return $this->invoiceLines;
    }

    /**
     * @param CreditNoteLine[] $creditNoteLines
     * @return CreditNote
     */
    public function setCreditNoteLines($creditNoteLines)
    {
        $this->invoiceLines = $creditNoteLines;
        return $this;
    }
}
