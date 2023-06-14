<?php

namespace App\Enums;

enum InvoiceStatusesEnum:string
{
    case Billed = 'billed';
    case Paid   = 'paid';
    case Void   = 'void';
}
