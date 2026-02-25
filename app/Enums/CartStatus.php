<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use Illuminate\Contracts\Support\Htmlable;

enum CartStatus: string
{
    case OPEN = 'open';
    case CLOSE = 'close';
}
