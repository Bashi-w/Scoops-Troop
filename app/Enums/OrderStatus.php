<?php

namespace App\Enums;

enum OrderStatus: string
{
    case Pending = 'Pending';
    case Delivered = 'Delivered';
    case Cancelled = 'Cancelled';

}


