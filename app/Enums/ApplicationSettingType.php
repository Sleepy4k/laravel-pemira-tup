<?php

namespace App\Enums;

use App\Traits\Enum;

enum ApplicationSettingType: string
{
    use Enum;

    // Case section started
    case APP = 'app';
    case SEO = 'seo';
    case VOTING = 'voting';
}
