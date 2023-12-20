<?php

namespace App\Enums;

use App\Traits\EnumValues;

enum ContentStatusEnum: string
{
    use EnumValues;

    case DRAFT = 'draft';
    case PUBLISHED = 'published';
}
