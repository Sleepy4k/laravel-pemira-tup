<?php

namespace App\Enums;

use App\Traits\Enum;

enum UploadFileType: string
{
    use Enum;

    // Case section started
    case FILE = 'files';
    case IMAGE = 'photos';

    case SETTING = 'photos/settings';

    case CANDIDATE_PHOTO = 'photos/candidates';
    case CANDIDATE_DOCUMENT = 'files/candidates/documents';
    case CANDIDATE_ATTACHMENT = 'files/candidates/attachments';
}
