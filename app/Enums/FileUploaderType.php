<?php

namespace App\Enums;

use App\Traits\Enum;

enum FileUploaderType: string
{
    use Enum;

    // Case section started
    case SETTING = 'setting';
    case CANDIDATE_PHOTO = 'candidate_photo';
    case CANDIDATE_RESUME = 'candidate_resume';
}
